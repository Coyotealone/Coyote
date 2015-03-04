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

use Coyote\SiteBundle\Form\UserType;
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
    public function indexAction()
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
    public function createAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $session = new Session();
        if ($user == "anon.")
        {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        if ($session->get('userfeesid') == null)
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
     * Function to show index page to show Expense save.
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function indexshowAction()
    {
        $session = new Session();
        if ($session->get('userfeesid') == null)
        {
            return $this->redirect($this->generateUrl('main_menu'));
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
     * Function to show Expense save by User.
     * @access public
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function showAction()
    {
        $session = new Session();
        $user = $this->get('security.context')->getToken()->getUser();
        if ($user == "anon.")
        {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        if ($session->get('userfeesid') == null)
        {
            return $this->redirect($this->generateUrl('main_menu'));
        }
        if (array_key_exists('year', $_GET))
        {
            $year = $_GET['year'];
        }
        if (array_key_exists('month', $_GET))
        {
            $month = $_GET['month'];
        }
        if (empty($year) && empty($month))
        {
            return $this->redirect($this->generateUrl('expense_indexshow'));
        }
        else
        {
            $session->set('year_expense', $year);
            $session->set('month_expense', $month);
            return $this->redirect($this->generateUrl('expense_showparameters', array('year' => $year,
                'month' => $month)));
        }
    }

    /**
     * Function to show Expense save.
     * @access public
     * @param string $year
     * @param string $month
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function showparametersAction($year, $month)
    {
        $session = new Session();
        $user = $this->get('security.context')->getToken()->getUser();
        if ($user == "anon.")
        {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        if ($session->get('userfeesid') == null)
        {
            return $this->redirect($this->generateUrl('main_menu'));
        }
        if (empty($year) && empty($month))
        {
            return $this->redirect($this->generateUrl('expense_indexshow'));
        }
        else
        {
            $em = $this->getDoctrine()->getManager();
            $date = $year.'-'.$month.'%';
            $data_expense = $em->getRepository('CoyoteSiteBundle:Expense')->findExpense($date,
                $session->get('userfeesid'));
            return $this->render('CoyoteSiteBundle:Expense:show.html.twig', array('data' => $data_expense));
        }
    }

    /**
     * Function to save Expense.
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function saveAction()
    {
        $session = new Session();
        $user = $this->get('security.context')->getToken()->getUser();
        if ($user == "anon.")
        {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        if ($session->get('userfeesid') == null)
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
                    $user_fee_id = $session->get('userfeesid');
                    $expense = $em->getRepository('CoyoteSiteBundle:Expense')->saveExpense($user_fee_id,
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
    public function editAction($id)
    {
        $session = new Session();
        if ($session->get('userfeesid') == null)
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
    public function updateAction(Request $request, $id)
    {
        $session = new Session();
        if($session->get('userfeesid') == null)
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
            if(is_numeric($date))
            {
                $date = $em->getRepository('CoyoteSiteBundle:Expense')->formDate($date);
                $entity->setDate($date);
            }
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
    public function deleteAction(Request $request, $id)
    {
        $session = new Session();
        if($session->get('userfeesid') == null)
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
     * index to print expense.
     *
     * @access public
     * @return printAction
     */
    public function indexprintAction()
    {
        $data = new Data();
        /** show view */
        return $this->render('CoyoteSiteBundle:Expense:indexprint.html.twig', array('month' => date('n'),
            'year' => date('Y'), 'tab_mois' => $data->getTabMonth(), 'tab_num_mois' => $data->getTabNumMonth(),
            'tab_annee' => $data->getTabYear(), 'tab_num_annee' => $data->getTabNumYear()));
    }

    /**
     * print expense PDF
     *
     * @access public
     * @return PDF
     */
    public function printAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        /** @var $em object doctrine request */
        $em = $this->getDoctrine()->getManager();
        $request = Request::createFromGlobals();
        /** @var $year string yyyy */
        $year = $_GET['year'];
        /** @var $month string mm */
        $month = $_GET['month'];
        /** check $year and $month */
        if(empty($year) && empty($month))
        {
            /** redirect ExpenseController:indexprintAction */
            return $this->redirect($this->generateUrl('expense_indexprint'));
        }
        else
        {
            /** @var $date string mm/yyyy */
            $date = $year.'-'.$month.'%';
            /** @var $data_expense entity Expense */
            $data_expense = $em->getRepository('CoyoteSiteBundle:Expense')->findExpense($date,
                $session->get('userfeesid'));
            /** @var $data_user entity User */
            $data_user = $em->getRepository('CoyoteSiteBundle:User')->find($session->get('userid'));
            /** @var $page view Expense:print */
            $page = $this->render('CoyoteSiteBundle:Expense:print.html.twig', array('data' => $data_expense));
            /** @var $filename string filename PDF */
            $filename = $data_user->getName()."_expense".date("Ymd-His").".pdf";
            /** prepare pdf */
            $html = $page->getContent();
            $html2pdf = new \Html2Pdf_Html2Pdf('P', 'A4', 'fr');
            $html2pdf->pdf->SetDisplayMode('real');
            $html2pdf->writeHTML($html);
            /** download pdf */
            $html2pdf->Output($filename, 'D');
            return new Response('PDF réalisé');
        }
    }


    /**
     * indexupdatestatusAction function.
     * index to update status expense
     *
     * @access public
     * @return void
     */
    public function indexupdatestatusAction()
    {
        if($this->get('security.context')->isGranted('ROLE_ADMIN'))
            /** show view updatestatus */
            return $this->render('CoyoteSiteBundle:Expense:updatestatus.html.twig');
        else
            /** redirect MainController:indexAction */
            return $this->redirect($this->generateUrl('main_menu'));
    }


    /**
     * updatestatusAction function.
     * update status by expense id
     *
     * @access public
     * @return void
     */
    public function updatestatusAction()
    {
        if($this->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            $em = $this->getDoctrine()->getManager();
            $id_start = $_GET['id_start'];
            $id_end = $_GET['id_end'];
            /** check $year and $month */
            if(empty($id_start) && empty($id_end))
            {
                $message = 'expense.flash.no_update';
                $this->get('session')->getFlashBag()->set('updatestatus', $message);
                /** redirect ExpenseController:indexprintAction */
                return $this->redirect($this->generateUrl('expense_indexupdatestatus'));
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
                        /** persist $expense */
                            $em->persist($data_expense);
                        }
                        /** add data in db */
                        $em->flush();
                    }
                    $message = 'expense.flash.update';
                    //alert($message);
                    $this->get('session')->getFlashBag()->set('updatestatus', $message);
                }
                if($id_start > $id_end)
                {
                    for($i = $id_end; $i<=$id_start; $i++)
                    {
                        $data_expense = $em->getRepository('CoyoteSiteBundle:Expense')->find($i);
                        $data_expense->setStatus(1);
                        /** persist $expense */
                        $em->persist($data_expense);
                        /** add data in db */
                        $em->flush();
                    }
                    $message = 'expense.flash.update';
                    alert($message);
                    $this->get('session')->getFlashBag()->set('updatestatus', $message);
                }
            }
            return $this->redirect($this->generateUrl('expense_indexupdatestatus'));
        }
        else
            /** redirect MainController:indexAction */
            return $this->redirect($this->generateUrl('main_menu'));
    }

    /**
     * show expense save.
     *
     * @access public
     * @return showparameters
     */
    public function showadminAction($page)
    {
        if($this->get('security.context')->isGranted('ROLE_COMPTA'))
        {
            $user = $this->get('security.context')->getToken()->getUser();
            /** check @var $user */
            if($user == "anon.")
                return $this->redirect($this->generateUrl('fos_user_security_login'));
            /** check @var $session 'userfeesid' */
            else
            {
                $em = $this->getDoctrine()->getManager();
                $maxItems = 10;//$this->container->getParameter('max_articles_per_page');
                $data_expense = $em->getRepository('CoyoteSiteBundle:Expense')->findAllOrderByUserFeesID();
                $expenses_count = count($data_expense);
                $pagination = array(
                                'page' => $page,
                                'route' => 'admin_showadmin',
                                'pages_count' => ceil($expenses_count / $maxItems),
                                'route_params' => array()
                );
                $entities = $this->getDoctrine()->getRepository('CoyoteSiteBundle:Expense')
                                 ->getListExpenseUsers($page, $maxItems);
                
                return $this->render('CoyoteSiteBundle:Expense:showadmin.html.twig', array(
                                'data' => $entities,
                                'pagination' => $pagination));
            }
        }
        else
            /** redirect MainController:indexAction */
            return $this->redirect($this->generateUrl('main_menu'));
    }
}

