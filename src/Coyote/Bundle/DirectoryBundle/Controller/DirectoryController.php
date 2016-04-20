<?php

namespace Coyote\Bundle\DirectoryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Coyote\Bundle\DirectoryBundle\Entity\Directory;
use Coyote\Bundle\DirectoryBundle\Form\DirectoryType;

/**
 * Directory controller.
 *
 */
class DirectoryController extends Controller
{

    /**
     * Lists all Directory entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CoyoteDirectoryBundle:Directory')->findAll();

        return $this->render('CoyoteDirectoryBundle:Directory:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Directory entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Directory();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setEnabled(1);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('directory_show', array('id' => $entity->getId())));
        }

        return $this->render('CoyoteDirectoryBundle:Directory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Directory entity.
     *
     * @param Directory $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Directory $entity)
    {
        $form = $this->createForm(new DirectoryType(), $entity, array(
            'action' => $this->generateUrl('directory_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Directory entity.
     *
     */
    public function newAction()
    {
        $entity = new Directory();
        $form   = $this->createCreateForm($entity);

        return $this->render('CoyoteDirectoryBundle:Directory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Directory entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoyoteDirectoryBundle:Directory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Directory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CoyoteDirectoryBundle:Directory:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Directory entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoyoteDirectoryBundle:Directory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Directory entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CoyoteDirectoryBundle:Directory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Directory entity.
    *
    * @param Directory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Directory $entity)
    {
        $form = $this->createForm(new DirectoryType(), $entity, array(
            'action' => $this->generateUrl('directory_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Directory entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoyoteDirectoryBundle:Directory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Directory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('directory_edit', array('id' => $id)));
        }

        return $this->render('CoyoteDirectoryBundle:Directory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Directory entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CoyoteDirectoryBundle:Directory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Directory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('directory'));
    }

    /**
     * Creates a form to delete a Directory entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('directory_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    public function showDirectoryByFirstnameAction($country, $business)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CoyoteDirectoryBundle:Directory')->findAllByFirstname($country, '%'.$business.'%');
        return $this->render('CoyoteDirectoryBundle:Directory:showdirectorybyfirstname.html.twig',
                array('entity' => $entity, 'country' => $country, 'business' => $business));
    }

    public function showDirectoryByFunctionServiceAction($country, $business)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CoyoteDirectoryBundle:Directory')->findAllByFunctionService($country, '%'.$business.'%');
        return $this->render('CoyoteDirectoryBundle:Directory:showdirectorybyfunctionservice.html.twig',
                array('entity' => $entity, 'country' => $country, 'business' => $business));
    }

    public function printDirectoryByFirstnameAction($country, $business)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CoyoteDirectoryBundle:Directory')->findAllByFirstname($country, '%'.$business.'%');
        $update = $em->getRepository('CoyoteDirectoryBundle:Directory')->updateDate($country);
        $page = $this->render('CoyoteDirectoryBundle:Directory:pdfdirectorybyfirstname.html.twig',
                array('entity' => $entity, 'update' => $update, 'business' => $business));
        $date = date("Ymd");
        $heure = date("His");
        $html = $page->getContent();
        $filename = "annuaire".$date."-".$heure.".pdf";
        $html = $page->getContent();
        $html2pdf = new \Html2Pdf_Html2Pdf('P', 'A4', 'fr');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html);
        $html2pdf->Output($filename, 'D');
        return new Response('PDF réalisé');
    }

    public function printDirectoryByFunctionServiceAction($country, $business)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CoyoteDirectoryBundle:Directory')->findAllByFunctionService($country, '%'.$business.'%');
        $update = $em->getRepository('CoyoteDirectoryBundle:Directory')->updateDate($country);
        $page = $this->render('CoyoteDirectoryBundle:Directory:pdfdirectorybyfunctionservice.html.twig',
                array('entity' => $entity, 'update' => $update, 'business' => $business));
        $date = date("Ymd");
        $heure = date("His");
        $html = $page->getContent();
        $filename = "annuaire".$date."-".$heure.".pdf";
        $html = $page->getContent();
        $html2pdf = new \Html2Pdf_Html2Pdf('P', 'A4', 'fr');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html);
        $html2pdf->Output($filename, 'D');
        return new Response('PDF réalisé');
    }

    public function setEnabledDirectoryAction($id)
    {
	    $em = $this->getDoctrine()->getManager();
	    $entity = $em->getRepository('CoyoteDirectoryBundle:Directory')->findOneById($id);
	    $em->getRepository('CoyoteDirectoryBundle:Directory')->updateEnable($entity);
	    $em->persist($entity);
	    $em->flush();
	    return $this->redirect($this->generateUrl('directory'));
    }
}
