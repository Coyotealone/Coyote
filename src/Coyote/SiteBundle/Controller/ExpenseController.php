<?php

namespace Coyote\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

use Coyote\SiteBundle\Entity\User;
use Coyote\SiteBundle\Entity\Expense;
use Coyote\SiteBundle\Entity\Site;
use Coyote\SiteBundle\Entity\Currency;
use Coyote\SiteBundle\Entity\Data;

use Doctrine\ORM\EntityRepository;

use Coyote\SiteBundle\Form\ExpenseType;


/**
 * Main controller.
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
            return $this->render('CoyoteSiteBundle:Expense:index.html.twig');
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
        if ($user == "anon.")
        {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        if (!$this->getUser()->getUserfees())
        {
            return $this->redirect($this->generateUrl('main_menu'));
        }
        else
        {
            $currency = $em->getRepository('CoyoteSiteBundle:Currency')->findAllOrderByCode();
            $business = $em->getRepository('CoyoteSiteBundle:Business')->findAllOrderByName();
            $fee = $em->getRepository('CoyoteSiteBundle:Fee')->findAll();
            return $this->render('CoyoteSiteBundle:Expense:create.html.twig',
                array('currency' => $currency, 'business' => $business, 'fee' => $fee));
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
        if (!$this->getUser()->getUserfees())
        {
            return $this->redirect($this->generateUrl('main_menu'));
        }
        else
        {
            $count_expense = 0;
            $em = $this->getDoctrine()->getManager();
            $request = Request::createFromGlobals();
            $data_request = $request->request->all();
            for($i=0;$i<6;$i++)
            {
                if (!empty($data_request['article'.$i]) && !empty($data_request['date'.$i])
                    && !empty($data_request['devise'.$i]) && !empty($data_request['qte'.$i])
                && !empty($data_request['site'.$i]) && !empty($data_request['ttc'.$i]))
                {
                    $expense = $em->getRepository('CoyoteSiteBundle:Expense')->saveExpense($this->getUser(),
                        $data_request, $i);
                    $em->persist($expense);
                    $em->flush();
                    $count_expense ++;
                }
            }
            if ($count_expense >= 1 )
            {
                if ($count_expense > 1)
                {
                    $message = 'expense.flash.save_multiple';
                    $session->set('countExpense', $count_expense);
                }
                else
                {
                    $message = 'expense.flash.save';
                }
            }
            else
            {
                $message = 'expense.flash.no_save';
            }
            $this->get('session')->getFlashBag()->set('save_expense', $message);
            return $this->redirect($this->generateUrl('expense_create'));
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
        if (!$this->getUser()->getUserfees())
        {
            return $this->redirect($this->generateUrl('main_menu'));
        }
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CoyoteSiteBundle:Expense')->find($id);
        if (!$entity)
        {
            throw $this->createNotFoundException('Unable to find Expense entity.');
        }
        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('CoyoteSiteBundle:Expense:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
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
        if (!$this->getUser()->getUserfees())
            return $this->redirect($this->generateUrl('main_menu'));
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoyoteSiteBundle:Expense')->find($id);

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
            /*if(is_numeric($date))
            {
                $date = $em->getRepository('CoyoteSiteBundle:Expense')->formDate($date);
                $entity->setDate($date);
            }*/
            $site = $em->getRepository('CoyoteSiteBundle:Site')->findOneById(9);
            $entity->setSite($site);
            $taux = $entity->getFee()->getRate();
            $ttc = $entity->getAmountTTC();
            $tva = $em->getRepository('CoyoteSiteBundle:Expense')->calculTVA($taux, $ttc);
            $entity->setAmountTVA($tva);

            $em->flush();

            return $this->redirect($this->generateUrl('expense_edit', array('id' => $id)));
        }

        return $this->render('CoyoteSiteBundle:Expense:edit.html.twig', array(
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
        if(!$this->getUser()->getUserfees())
            return $this->redirect($this->generateUrl('main_menu'));
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CoyoteSiteBundle:Expense')->find($id);

            if (!$entity) {
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
        	if (array_key_exists('id_start', $_GET) && array_key_exists('id_end', $_GET))
        	{
	        	if (!empty($_GET['id_start'] && !empty($_GET['id_end'])))
	        	{
		            $em = $this->getDoctrine()->getManager();
		            $id_start = $_GET['id_start'];
		            $id_end = $_GET['id_end'];
		            if (empty($id_start) && empty($id_end))
		            {
		                $message = 'expense.flash.no_update';
		                $this->get('session')->getFlashBag()->set('updatestatus', $message);
		                return $this->render('CoyoteSiteBundle:Expense:updatestatus.html.twig');
		            }
		            else
		            {
		                if($id_end > $id_start)
		                {
		                    for($i = $id_start; $i<=$id_end; $i++)
		                    {
		                        $data_expense = $em->getRepository('CoyoteSiteBundle:Expense')->find($i);
		                        if($data_expense != null)
		                        {
		                            $data_expense->setStatus(1);
		                            $em->persist($data_expense);
		                        }
		                        $em->flush();
		                    }
		                    $message = 'expense.flash.update';
		                    $this->get('session')->getFlashBag()->set('updatestatus', $message);
		                }
		                if($id_start > $id_end)
		                {
		                    for($i = $id_end; $i<=$id_start; $i++)
		                    {
		                        $data_expense = $em->getRepository('CoyoteSiteBundle:Expense')->find($i);
		                        $data_expense->setStatus(1);
		                        $em->persist($data_expense);
		                        $em->flush();
		                    }
		                    $message = 'expense.flash.update';
		                    alert($message);
		                    $this->get('session')->getFlashBag()->set('updatestatus', $message);
		                }
		                else
		                {
		                	return $this->render('CoyoteSiteBundle:Expense:updatestatus.html.twig');
		                }
		            }
	        	}
	        	else
	        	{
	        		return $this->render('CoyoteSiteBundle:Expense:updatestatus.html.twig');
	        	}
        	}
        	else 
        	{
        		return $this->render('CoyoteSiteBundle:Expense:updatestatus.html.twig');
        	}
        }
        else
        {
            return $this->render('CoyoteSiteBundle:Expense:updatestatus.html.twig');
        }
    }

    /**
     * Function to show Expense save by user about a month and a year.
     * @param integer $page
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
	public function getExpensesAction($page)
	{
		if (!$this->getUser()->getUserfees())
		{
			return $this->redirect($this->generateUrl('main_menu'));
		}
		if (!empty($_GET['month']) && empty(!$_GET['year']))
		{
			$em = $this->getDoctrine()->getManager();
			$date = $_GET['year'].'-'.$_GET['month'].'%';
			$request = $this->getRequest();
			$session = $request->getSession();
			$session->set('year_expense', $_GET['year']);
			$session->set('month_expense', $_GET['month']);
			$maxItems = 10;
			$expenses = $this->getDoctrine()->getRepository('CoyoteSiteBundle:Expense')
				->getListExpenseUser($this->getUser(), $date, $page, $maxItems);
			$entities = $em->getRepository('CoyoteSiteBundle:Expense')->findExpense($date,
					$this->getUser());
			$expenses_count = count($expenses);
			$pagination = array(
					'page' => $page,
					'route' => 'absence',
					'pages_count' => ceil($expenses_count / $maxItems),
					'route_params' => array()
			);
		
			return $this->render('CoyoteSiteBundle:Expense:show.html.twig', array(
					'data' => $entities,
					'pagination' => $pagination));
		}
		else
		{
			$data = new Data();
			return $this->render('CoyoteSiteBundle:Expense:indexshow.html.twig', array('month' => date('n'),
					'year' => date('Y'), 'tab_mois' => $data->getTabMonth(), 'tab_num_mois' => $data->getTabNumMonth(),
					'tab_annee' => $data->getTabYear(), 'tab_num_annee' => $data->getTabNumYear()));
		}
	}

	/**
	 * Function to download Expense in PDF by user about a month and a year.
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function getprintExpensesAction()
	{
		$em = $this->getDoctrine()->getManager();
		if (!empty($_GET['year']) && !empty($_GET['month']))
		{
			$date = $_GET['year'].'-'.$_GET['month'].'%';
			$data_expense = $em->getRepository('CoyoteSiteBundle:Expense')->findExpense($date,
					$this->getUser());
			$data_user = $em->getRepository('CoyoteSiteBundle:User')->find($this->getUser());
			$page = $this->render('CoyoteSiteBundle:Expense:print.html.twig', array('data' => $data_expense));
			$filename = $data_user->getName()."_expense".date("Ymd-His").".pdf";
			$html = $page->getContent();
			$html2pdf = new \Html2Pdf_Html2Pdf('P', 'A4', 'fr');
			$html2pdf->pdf->SetDisplayMode('real');
			$html2pdf->writeHTML($html);
			$html2pdf->Output($filename, 'D');
			return $this->redirect($this->generateUrl('expense_printexpenses'));
		}
		else
		{
			$data = new Data();
			return $this->render('CoyoteSiteBundle:Expense:indexprint.html.twig', array('month' => date('n'),
					'year' => date('Y'), 'tab_mois' => $data->getTabMonth(), 'tab_num_mois' => $data->getTabNumMonth(),
					'tab_annee' => $data->getTabYear(), 'tab_num_annee' => $data->getTabNumYear()));
			
		}
	}
	
}

