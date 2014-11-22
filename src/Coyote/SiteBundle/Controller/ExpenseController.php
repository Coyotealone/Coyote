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

use Doctrine\ORM\EntityRepository;

use Coyote\SiteBundle\Form\UserType;
use Coyote\SiteBundle\Form\ExpenseType;


/**
 * Main controller.
 *
 */
class ExpenseController extends Controller
{
    public function indexAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $session = new Session();
        if($user == "anon.")
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        if($session->get('userfeesid') != null)
            return $this->render('CoyoteSiteBundle:Expense:index.html.twig');
        else
            return $this->redirect($this->generateUrl('accueil'));
    }

    public function createAction()
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $session = new Session();
        if($user == "anon.")
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        if($session->get('userfeesid') == null)
            return $this->redirect($this->generateUrl('accueil'));
        else
        {
            $currency = $em->getRepository('CoyoteSiteBundle:Currency')->findAll();
            $business = $em->getRepository('CoyoteSiteBundle:Business')->findAll();
            $fee = $em->getRepository('CoyoteSiteBundle:Fee')->findBy(array());

            return $this->render('CoyoteSiteBundle:Expense:create.html.twig',
                array('currency' => $currency, 'business' => $business, 'fee' => $fee));
        }
    }

    public function indexshowAction()
    {
        $session = new Session();
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        if($session->get('userfeesid') == null)
            return $this->redirect($this->generateUrl('accueil'));
        else
        {
            $month = date('n');
            $year = date('Y');
            $tab_mois = array( 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre' );
            $tab_num_mois = array( '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12' );
            $tab_annee = array('2014', '2015');
            $tab_num_annee = array('14', '15');

            return $this->render('CoyoteSiteBundle:Expense:indexshow.html.twig', array('month' => $month, 'year' => $year, 'tab_mois' => $tab_mois, 'tab_num_mois' => $tab_num_mois, 'tab_annee' => $tab_annee, 'tab_num_annee' => $tab_num_annee));
        }
    }

    public function showAction()
    {
        $session = new Session();
        $user = $this->get('security.context')->getToken()->getUser();
        if($user == "anon.")
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        if($session->get('userfeesid') == null)
            return $this->redirect($this->generateUrl('accueil'));
        $annee = $_GET['year'];
        $mois = $_GET['month'];
        if(empty($annee) && empty($mois))
            return $this->redirect($this->generateUrl('expense_indexshow'));
        else
        {
            $session->set('year_expense', $annee);
            $session->set('month_expense', $mois);
            return $this->redirect($this->generateUrl('expense_showparameters', array('year' => $annee, 'month' => $mois)));
        }
    }

    public function showparametersAction($year, $month)
    {
        $session = new Session();
        $user = $this->get('security.context')->getToken()->getUser();
        if($user == "anon.")
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        if($session->get('userfeesid') == null)
            return $this->redirect($this->generateUrl('accueil'));
        $annee = $year;
        $mois = $month;
        if(empty($annee) && empty($mois))
            return $this->redirect($this->generateUrl('expense_indexshow'));
        else
        {
            $iduser = $this->get('security.context')->getToken()->getUser()->getId();
            $em = $this->getDoctrine()->getManager();
            $date = $mois.'/'.$annee;
            $entity = $em->getRepository('CoyoteSiteBundle:Expense')->findExpense($date, $session->get('userfeesid'));
            return $this->render('CoyoteSiteBundle:Expense:show.html.twig', array('data' => $entity));
        }
    }

    public function saveAction()
    {
        $session = new Session();
        $user = $this->get('security.context')->getToken()->getUser();
        if($user == "anon.")
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        if($session->get('userfeesid') == null)
            return $this->redirect($this->generateUrl('accueil'));
        else
        {
            $doctrine = $this->getDoctrine();
            $em = $doctrine->getManager();

            $request = Request::createFromGlobals();
            $data = $request->request->all();

            $i = 0;
            for($i=0;$i<6;$i++)
            {
                if(!empty($data['article'.$i]) && !empty($data['date'.$i]) && !empty($data['devise'.$i]) && !empty($data['qte'.$i])
                && !empty($data['site'.$i]) && !empty($data['ttc'.$i]))
                {
                    $user_fee_id = $session->get('userfeesid');
                    $increment = $i;

                    $expense = $em->getRepository('CoyoteSiteBundle:Expense')->saveExpense($user_fee_id, $data, $increment);

                    $em->persist($expense);
                    $em->flush();
                }
                if(isset($expense))
                    $id[$i] = $expense->getId();

            }
            $message = '';
            if(isset($id))
            {
                $result_id = null;
                $result = array_unique($id);
                if(count($result) > 1)
                {
                    $result_id = '';
                    $message = count($result).' enregistrement effectués';
                }
                else
                {
                    $message = '1 enregistrement effectué';
                }
            }
            else
                $message = 'Aucun enregistrement effectué';
            $this->get('session')->getFlashBag()->set('saveexpense', $message);

            return $this->redirect($this->generateUrl('expense_create'));
        }
    }

    public function editAction($id)
    {
        $session = new Session();
        if($session->get('userfeesid') == null)
            return $this->redirect($this->generateUrl('accueil'));
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoyoteSiteBundle:Expense')->find($id);

        if (!$entity) {
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

    private function createEditForm(Expense $entity)
    {
        $form = $this->createForm(new ExpenseType(), $entity, array(
            'action' => $this->generateUrl('expense_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('expense_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    public function updateAction(Request $request, $id)
    {
        $session = new Session();
        if($session->get('userfeesid') == null)
            return $this->redirect($this->generateUrl('accueil'));
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

    public function deleteAction(Request $request, $id)
    {
        $session = new Session();
        if($session->get('userfeesid') == null)
            return $this->redirect($this->generateUrl('accueil'));
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

    public function indexprintAction()
    {
        $month = date('n');
        $year = date('Y');
        $tab_mois = array( 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre' );
        $tab_num_mois = array( '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12' );
        $tab_annee = array( '2014', '2015');
        $tab_num_annee = array( '14', '15');

        return $this->render('CoyoteSiteBundle:Expense:indexprint.html.twig', array('month' => $month, 'year' => $year, 'tab_mois' => $tab_mois, 'tab_num_mois' => $tab_num_mois, 'tab_annee' => $tab_annee, 'tab_num_annee' => $tab_num_annee));
    }

    /**
     * printAction function.
     *
     * @access public
     * @return void
     */
    public function printAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $request = Request::createFromGlobals();

        $annee = $_GET['year'];
        $mois = $_GET['month'];

        if(empty($annee) && empty($mois))
        {
            return $this->redirect($this->generateUrl('expense_indexprint'));
        }
        else
        {
            if(empty($annee) && empty($mois))
                return $this->render('CoyoteSiteBundle:Expense:indexprint.html.twig');

            $date = $mois.'/'.$annee;
            $data = $em->getRepository('CoyoteSiteBundle:Expense')->findExpense($date, $session->get('userfeesid'));
            $user = $em->getRepository('CoyoteSiteBundle:User')->find($session->get('userid'));
            $page = $this->render('CoyoteSiteBundle:Expense:print.html.twig', array(
                    'data' => $data));
            $date = date("Ymd");
            $heure = date("His");
            $filename = $user->getName()."_expense".$date."-".$heure.".pdf";
            $html = $page->getContent();
            $html2pdf = new \Html2Pdf_Html2Pdf('P', 'A4', 'fr');
            $html2pdf->pdf->SetDisplayMode('real');
            $html2pdf->writeHTML($html);
            $html2pdf->Output($filename, 'D');
            return new Response('PDF réalisé');
        }
    }
}

