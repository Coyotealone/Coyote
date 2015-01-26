<?php

namespace Coyote\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Compenent\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Session\Session;

use Spraed\PDFGeneratorBundle\PDFGenerator\PDFGenerator;

use Coyote\SiteBundle\Entity\User;
use Coyote\SiteBundle\Entity\UserInfo;
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
     * redirect to new expense.
     *
     * @access public
     * @return view index
     */
    public function indexAction()
    {
        /** @var $user object data user connected */
        $user = $this->get('security.context')->getToken()->getUser();
        /** @var $session new object Session */
        $session = new Session();
        /** check @var $user */
        if($user == "anon.")
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        /** check object session userfeesid */
        if($this->get('security.context')->isGranted('ROLE_TRADE'))
            /** show view */
            return $this->render('CoyoteSiteBundle:Expense:index.html.twig');
        else
            /** redirect MainController:indexAction */
            return $this->redirect($this->generateUrl('main_accueil'));
    }

    /**
     * new expense.
     *
     * @access public
     * @return view create
     */
    public function createAction()
    {
        /** @var $em object doctrine request */
        $em = $this->getDoctrine()->getManager();
        /** @var $user object data user connected */
        $user = $this->get('security.context')->getToken()->getUser();
        /** @var $session new object Session */
        $session = new Session();
        /** check @var $user */
        if($user == "anon.")
            /** redirect \FOS\UserBundle\Controller\SecurityController */
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        /** check object session userfeesid */
        if($session->get('userfeesid') == null)
            /** redirect MainController:indexAction */
            return $this->redirect($this->generateUrl('main_accueil'));
        else
        {
            /** @var $currency object currency all data from Currency */
            $currency = $em->getRepository('CoyoteSiteBundle:Currency')->findAll();
            /** @var $business object business all data from Business */
            $business = $em->getRepository('CoyoteSiteBundle:Business')->findAll();
            /** @var $fee object fee all data from Fee */
            $fee = $em->getRepository('CoyoteSiteBundle:Fee')->findAll();
            /** show view */
            return $this->render('CoyoteSiteBundle:Expense:create.html.twig',
                array('currency' => $currency, 'business' => $business, 'fee' => $fee));
        }
    }

    /**
     * index to show expense save.
     *
     * @access public
     * @return index show
     */
    public function indexshowAction()
    {
        /** @var $session new object Session */
        $session = new Session();
        /** @var $em object doctrine request */
        $em = $this->getDoctrine()->getManager();
        /** check object session userfeesid */
        if($session->get('userfeesid') == null)
            /** redirect MainController:indexAction */
            return $this->redirect($this->generateUrl('main_accueil'));
        else
        {
            $data = new Data();
            /** show view */
            return $this->render('CoyoteSiteBundle:Expense:indexshow.html.twig', array('month' => date('n'),
                'year' => date('Y'), 'tab_mois' => $data->getTabMonth(), 'tab_num_mois' => $data->getTabNumMonth(),
                'tab_annee' => $data->getTabYear(), 'tab_num_annee' => $data->getTabNumYear()));
        }
    }

    /**
     * show expense save.
     *
     * @access public
     * @return showparameters
     */
    public function showAction()
    {
        /** @var $session new object Session */
        $session = new Session();
        /** @var $user object data user connected */
        $user = $this->get('security.context')->getToken()->getUser();
        /** check @var $user */
        if($user == "anon.")
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        /** check @var $session 'userfeesid' */
        if($session->get('userfeesid') == null)
            return $this->redirect($this->generateUrl('main_accueil'));

        if (array_key_exists('year', $_GET)) {
                $year = $_GET['year'];
            }
        if (array_key_exists('month', $_GET)) {
                $month = $_GET['month'];
            }

        if(empty($year) && empty($month))
            return $this->redirect($this->generateUrl('expense_indexshow'));
        else
        {
            /** set @var $session 'year_expense' */
            $session->set('year_expense', $year);
            /** set @var $session 'month_expense' */
            $session->set('month_expense', $month);
            return $this->redirect($this->generateUrl('expense_showparameters', array('year' => $year,
                'month' => $month)));
        }
    }

    /**
     * show expense save.
     *
     * @access public
     * @param mixed $year
     * @param mixed $month
     * @return view show
     */
    public function showparametersAction($year, $month)
    {
        /** @var $session new object Session */
        $session = new Session();
        /** @var $user object data user connected */
        $user = $this->get('security.context')->getToken()->getUser();
        /** check @var $user */
        if($user == "anon.")
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        /** check @var $session 'userfeesid' */
        if($session->get('userfeesid') == null)
            return $this->redirect($this->generateUrl('main_accueil'));
        if(empty($year) && empty($month))
            /** show view */
            return $this->redirect($this->generateUrl('expense_indexshow'));
        else
        {
            /** @var $em object doctrine request */
            $em = $this->getDoctrine()->getManager();
            /** @var $date string mm/yyyy */
            $date = $year.'-'.$month.'%';
            /** @var $data_expense object Expense*/
            //return new Response($date);
            $data_expense = $em->getRepository('CoyoteSiteBundle:Expense')->findExpense($date,
                $session->get('userfeesid'));
            /** show view */
            //return new Response($data_expense[0]->getStatus()->getString());
            return $this->render('CoyoteSiteBundle:Expense:show.html.twig', array('data' => $data_expense));
        }
    }

    /**
     * save expense.
     *
     * @access public
     * @return createAction
     */
    public function saveAction()
    {
        /** @var $session new object Session */
        $session = new Session();
        /** @var $user object data user connected */
        $user = $this->get('security.context')->getToken()->getUser();
        /** check $user */
        if($user == "anon.")
            /** redirect \FOS\UserBundle\Controller\SecurityController */
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        /** check $session 'userfeesid' */
        if($session->get('userfeesid') == null)
            /** redirect MainController:indexAction */
            return $this->redirect($this->generateUrl('main_accueil'));
        else
        {
            $count_expense = 0;
            /** @var $em object doctrine request */
            $em = $this->getDoctrine()->getManager();
            /** @var $request */
            $request = Request::createFromGlobals();
            /** @var $data_request all data request */
            $data_request = $request->request->all();
            /** loop */
            for($i=0;$i<6;$i++)
            {
                /** check $data_request */
                if(!empty($data_request['article'.$i]) && !empty($data_request['date'.$i])
                    && !empty($data_request['devise'.$i]) && !empty($data_request['qte'.$i])
                && !empty($data_request['site'.$i]) && !empty($data_request['ttc'.$i]))
                {
                    /** @var $user_fee_id string $session 'userfeessid' */
                    $user_fee_id = $session->get('userfeesid');
                    /** @var $expense object expense */
                    $expense = $em->getRepository('CoyoteSiteBundle:Expense')->saveExpense($user_fee_id,
                        $data_request, $i);
                    /** persist $expense */
                    $em->persist($expense);
                    /** add data in db */
                    $em->flush();
                    $count_expense ++;
                }
                /** check $expense */
                if(isset($expense))
                    /** @var $tab_id array int expense id */
                    $tab_id[$i] = $expense->getId();

            }
            /** check $count_expense */
            if($count_expense >= 1 )
            {
                /** check $count_expense */
                if($count_expense > 1)
                {
                    /** @var $message string */
                    $message = $count_expense.' enregistrement effectués';
                }
                else
                {
                    /** @var $message string */
                    $message = '1 enregistrement effectué';
                }
            }
            else
                /** @var $message string */
                $message = 'Aucun enregistrement effectué';
            /** set $message in flashbag */
            $this->get('session')->getFlashBag()->set('saveexpense', $message);
            /** redirect ExpenseController:createAction */
            return $this->redirect($this->generateUrl('expense_create'));
        }
    }

    /**
     * edit expense.
     *
     * @access public
     * @param mixed $id
     * @return view edit
     */
    public function editAction($id)
    {
        /** @var $session new object Session */
        $session = new Session();
        /** check $session 'userfeesid' */
        if($session->get('userfeesid') == null)
            /** redirect MainController:indexAction */
            return $this->redirect($this->generateUrl('main_accueil'));
        /** @var $em object doctrine request */
        $em = $this->getDoctrine()->getManager();
        /** @var $entity entity Expense */
        $entity = $em->getRepository('CoyoteSiteBundle:Expense')->find($id);
        /** check $entity */
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Expense entity.');
        }
        /** @var $editForm form Edit */
        $editForm = $this->createEditForm($entity);
        /** @var $deleteForm form Delete */
        $deleteForm = $this->createDeleteForm($id);
        /** show view*/
        return $this->render('CoyoteSiteBundle:Expense:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * generate view to edit expense.
     *
     * @access private
     * @param Expense $entity
     * @return Form
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
     * generate view to delete expense.
     *
     * @access private
     * @param mixed $id
     * @return Form
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
     * update expense.
     *
     * @access public
     * @param Request $request
     * @param mixed $id
     * @return editAction
     */
    public function updateAction(Request $request, $id)
    {
        $session = new Session();
        if($session->get('userfeesid') == null)
            return $this->redirect($this->generateUrl('main_accueil'));
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
                $expense->setDate($date);
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
     * delete expense.
     *
     * @access public
     * @param Request $request
     * @param mixed $id
     * @return indexAction
     */
    public function deleteAction(Request $request, $id)
    {
        $session = new Session();
        if($session->get('userfeesid') == null)
            return $this->redirect($this->generateUrl('main_accueil'));
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

    public function indexupdatestatusAction()
    {
        return $this->render('CoyoteSiteBundle:Expense:updatestatus.html.twig');
    }

    public function updatestatusAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        /** @var $em object doctrine request */
        $em = $this->getDoctrine()->getManager();
        $request = Request::createFromGlobals();
        //if (array_key_exists('id_start', $_GET['id_start']))
        {
            $id_start = $_GET['id_start'];
        }

        //if (array_key_exists('id_end', $_GET['id_end']))
        {
            $id_end = $_GET['id_end'];
        }

        //else
        //    return $this->redirect($this->generateUrl('expense_indexupdatestatus'));
        /** @var $year string yyyy */

        /** @var $month string mm */

        /** check $year and $month */
        if(empty($id_start) && empty($id_end))
        {
            $message = "Aucune donnée mise à jour";
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
                    $data_expense->setStatus(1);
                    /** persist $expense */
                    $em->persist($data_expense);
                    /** add data in db */
                    $em->flush();
                }
                $message = "Mise à jour effectuée";
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
                $message = "Mise à jour effectuée";
                alert($message);
                $this->get('session')->getFlashBag()->set('updatestatus', $message);
            }
        }
        return $this->redirect($this->generateUrl('expense_indexupdatestatus'));
    }
}

