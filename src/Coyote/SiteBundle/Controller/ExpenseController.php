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
            return $this->render('CoyoteSiteBundle:Expense:indexshow.html.twig');
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

    public function printAction()
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('CoyoteSiteBundle:Expense')->findByUserfees('1');
        $html = $this->renderView('CoyoteSiteBundle:Expense:print.html.twig', array('data' => $data));
        $pdfGenerator = $this->get('spraed.pdf.generator');

        return new Response($pdfGenerator->generatePDF($html),
                    200,
                    array(
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition' => 'inline; filename="out.pdf"'
                    )
                );
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
                $jour = substr($date, 0, 2);
                $mois = substr($date, 2, 2);
                $annee = substr($date, 4, 3);
                $date = $jour."/".$mois."/".$annee;
                $expense->setDate($date);
            }
            $taux = $entity->getFee()->getRate();
            $ttc = $entity->getAmountTTC();
            $taux += 100;
            $price = $ttc * 100 / $taux;
            $tva = $ttc - $price;
            $tva = round($tva, 2);
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
}

