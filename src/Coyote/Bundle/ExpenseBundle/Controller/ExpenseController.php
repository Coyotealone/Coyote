<?php

namespace Coyote\Bundle\ExpenseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

use Coyote\ExpenseBundle\Entity\Expense;

use Coyote\ExpenseBundle\Form\ExpenseType;

/**
 * Expense controller.
 *
 */
class ExpenseController extends Controller
{
    /**
     * Function to redirect to new Expense.
     * @access public
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function getIndexAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        if ($user == "anon.")
        {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        if ($this->get('security.context')->isGranted('ROLE_TRADE'))
        {
            return $this->render('CoyoteFrontBundle:Expense:index.html.twig');
        }
        else
        {
            return $this->redirect($this->generateUrl('main_menu'));
        }
    }

    /**
     * Creates a new Expense entity.
     * @access public
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function putcreateExpenseAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $sites = null;
        if ($user == "anon.")
        {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        $listRoles = $user->getRoles();
        $sites = $em->getRepository('CoyoteExpenseBundle:Site')->getSitesaboutRoles($listRoles);

        if (!empty($sites))
        {
            $currency = $em->getRepository('CoyoteExpenseBundle:Currency')->findAllOrderByCode();
            $business = $em->getRepository('CoyoteExpenseBundle:Business')->findAllOrderByName();
            $fee = $em->getRepository('CoyoteExpenseBundle:Fee')->findAll();

            return $this->render('CoyoteFrontBundle:Expense:create.html.twig',
                array('currency' => $currency, 'business' => $business, 'fee' => $fee, 'sites' => $sites));
        }
        else
        {
	        return $this->redirect($this->generateUrl('main_menu'));
        }
    }

    /**
     * Function to save Expense.
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function putExpensesAction()
    {
        $session = new Session();
        $user = $this->get('security.context')->getToken()->getUser();
        if ($user == "anon.")
        {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        if ($this->get('security.context')->isGranted('ROLE_TRADE_GILIBERT') ||
        	$this->get('security.context')->isGranted('ROLE_TRADE_PICHON'))
        {
            $em = $this->getDoctrine()->getManager();
            $request = $this->getRequest();
            $data_request = $request->request->all();
            $count_expense = $em->getRepository('CoyoteExpenseBundle:Expense')->createExpense($this->getUser(),
                                $data_request);
            $message = $em->getRepository('CoyoteExpenseBundle:Expense')->getMessagePutExpense($count_expense);
            if ($count_expense > 1)
            {
                $session->set('countExpense', $count_expense);
            }
            $this->get('session')->getFlashBag()->set('save_expense', $message);
            return $this->redirect($this->generateUrl('expense_create'));
        }
        else
        {
            return $this->redirect($this->generateUrl('main_menu'));
        }
    }

    /**
     * Displays a form to edit an existing Expense entity.
     * @access public
     * @param mixed $id The entity id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function posteditExpenseAction($id)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        if ($user == "anon.")
        {
            return $this->redirect($this->generateUrl('main_menu'));
        }
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CoyoteExpenseBundle:Expense')->find($id);
        if (!$entity)
        {
            throw $this->createNotFoundException('Unable to find Expense entity.');
        }
        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('CoyoteFrontBundle:Expense:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),));
    }

    /**
    * Creates a form to edit a Expense entity.
    * @access private
    * @param Expense $entity The entity
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Expense $entity)
    {
        $form = $this->createForm(new ExpenseType(), $entity, array(
            'action' => $this->generateUrl('expense_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));
        return $form;
    }

    /**
     * Creates a form to delete a Expense entity by id.
     * @access private
     * @param mixed $id The entity id
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('expense_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
     * Edits an existing Expense entity.
     * @access public
     * @param Request $request
     * @param mixed $id The entity id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function postupdateExpenseAction(Request $request, $id)
    {
        if (!$this->get('security.context')->isGranted('ROLE_TRADE'))
            return $this->redirect($this->generateUrl('main_menu'));
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CoyoteExpenseBundle:Expense')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Expense entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid())
        {
            $date = $entity->getDate();
            $entity->setDate($date);
            if ($this->get('security.context')->isGranted('ROLE_TRADE_PICHON'))
            {
            	$site = $em->getRepository('CoyoteExpenseBundle:Site')->findOneById(9);
            }
            if ($this->get('security.context')->isGranted('ROLE_TRADE_GILIBERT'))
            {
	            $site = $em->getRepository('CoyoteExpenseBundle:Site')->findOneById(11);
            }
            $entity->setSite($site);
            $taux = $entity->getFee()->getRate();
            $ttc = $entity->getAmountTTC();
            $tva = $em->getRepository('CoyoteExpenseBundle:Expense')->calculTVA($taux, $ttc);
            $entity->setAmountTVA($tva);

            $em->flush();

            return $this->redirect($this->generateUrl('expense_edit', array('id' => $id)));
        }

        return $this->render('CoyoteFrontBundle:Expense:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Expense entity.
     * @access public
     * @param Request $request
     * @param mixed $id The entity id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteExpenseAction(Request $request, $id)
    {
        if (!$this->get('security.context')->isGranted('ROLE_TRADE'))
            return $this->redirect($this->generateUrl('main_menu'));
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CoyoteExpenseBundle:Expense')->find($id);
            if (!$entity)
            {
                throw $this->createNotFoundException('Unable to find Expense entity.');
            }
            $em->remove($entity);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('expense_index'));
    }

    /**
     * Function to update status by Expense id.
     * @access public
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function poststatusExpensesAction()
    {
        if ($this->get('security.context')->isGranted('ROLE_ADMIN'))
        {
        	if (filter_input(INPUT_GET, 'id_start', FILTER_UNSAFE_RAW) && !empty(filter_input(INPUT_GET, 'id_end', FILTER_UNSAFE_RAW)))
        	{
	            $em = $this->getDoctrine()->getManager();
	            $id_start = filter_input(INPUT_GET, 'id_start', FILTER_UNSAFE_RAW);
	            $id_end = filter_input(INPUT_GET, 'id_end', FILTER_UNSAFE_RAW);
	            if (empty($id_start) && empty($id_end))
	            {
	                $message = 'expense.flash.no_update';
	                $this->get('session')->getFlashBag()->set('updatestatus', $message);
	            }
	            else
	            {
    	            $message = $em->getRepository('CoyoteExpenseBundle:Expense')->postStatusExpense($id_start, $id_end);
	                $this->get('session')->getFlashBag()->set('updatestatus', $message);
	            }
	            return $this->render('CoyoteFrontBundle:Expense:updatestatus.html.twig');
        	}
        	else
        	{
        		return $this->render('CoyoteFrontBundle:Expense:updatestatus.html.twig');
        	}
        }
        else
        {
            return $this->render('CoyoteFrontBundle:Expense:updatestatus.html.twig');
        }
    }

    /**
     * Function to show Expense save by user about a month and a year.
     * @param integer $page
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
	public function getExpensesAction($page)
	{
    	$doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();

		$user = $this->get('security.context')->getToken()->getUser();
        if ($user == "anon.")
        {
			return $this->redirect($this->generateUrl('main_menu'));
		}
		if (filter_input(INPUT_GET, 'month') && filter_input(INPUT_GET, 'year'))
		{
			$date = filter_input(INPUT_GET, 'year').'-'.filter_input(INPUT_GET, 'month').'%';
			$request = $this->getRequest();
			$session = $request->getSession();
			$session->set('year_expense', filter_input(INPUT_GET, 'year'));
			$session->set('month_expense', filter_input(INPUT_GET, 'month'));
			$maxItems = 10;
			$expenses = $this->getDoctrine()->getRepository('CoyoteExpenseBundle:Expense')
				->getListAboutUserDate($this->getUser(), $date, $page, $maxItems);
			$entities = $em->getRepository('CoyoteExpenseBundle:Expense')->findAllByDateUser($date,
					$this->getUser());
			$expenses_count = count($expenses);
			$pagination = array(
					'page' => $page,
					'route' => 'absence',
					'pages_count' => ceil($expenses_count / $maxItems),
					'route_params' => array()
			);

			return $this->render('CoyoteFrontBundle:Expense:show.html.twig', array(
					'data' => $entities,
					'pagination' => $pagination));
		}
		else
		{
    		$tab_month = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findMonth();
            $tab_num_month = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findNumMonth();
            $tab_year = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findYear();
            $tab_num_year = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findNumYear();
			return $this->render('CoyoteFrontBundle:Expense:indexshow.html.twig', array('month' => date('n'),
					'year' => date('Y'), 'tab_mois' => $tab_month, 'tab_num_mois' => $tab_num_month,
					'tab_annee' => $tab_year, 'tab_num_annee' => $tab_num_year));
		}
	}

	/**
	 * Function to download Expense in PDF by user about a month and a year.
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function getprintExpensesAction()
	{
		$em = $this->getDoctrine()->getManager();
		if (filter_input(INPUT_GET, 'year') && filter_input(INPUT_GET, 'month'))
		{
			$date = filter_input(INPUT_GET, 'year').'-'.filter_input(INPUT_GET, 'month').'%';
			$data_expense = $em->getRepository('CoyoteExpenseBundle:Expense')->findAllByDateUser($date,
					$this->getUser());
			$data_user = $em->getRepository('ApplicationSonataUserBundle:User')->find($this->getUser());
			$page = $this->render('CoyoteFrontBundle:Expense:print.html.twig', array('data' => $data_expense));
			$filename = $data_user->getUsername()."_expense".date("Ymd-His").".pdf";
			$html = $page->getContent();
			$html2pdf = new \Html2Pdf_Html2Pdf('P', 'A4', 'fr');
			$html2pdf->pdf->SetDisplayMode('real');
			$html2pdf->writeHTML($html);
			$html2pdf->Output($filename, 'D');
			return $this->redirect($this->generateUrl('expense_printexpenses'));
		}
		else
		{
    		$tab_month = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findMonth();
            $tab_num_month = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findNumMonth();
            $tab_year = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findYear();
            $tab_num_year = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findNumYear();
			return $this->render('CoyoteFrontBundle:Expense:indexprint.html.twig', array('month' => date('n'),
					'year' => date('Y'), 'tab_mois' => $tab_month, 'tab_num_mois' => $tab_num_month,
					'tab_annee' => $tab_year, 'tab_num_annee' => $tab_num_year));

		}
	}

}

