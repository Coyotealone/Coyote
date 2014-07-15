<?php

namespace Coyote\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Coyote\SiteBundle\Entity\FormOrder;
use Coyote\SiteBundle\Form\FormOrderType;

/**
 * FormOrder controller.
 *
 */
class FormOrderController extends Controller
{

    /**
     * Lists all FormOrder entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CoyoteSiteBundle:FormOrder')->findAll();

        return $this->render('CoyoteSiteBundle:FormOrder:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new FormOrder entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new FormOrder();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('CoyoteSiteBundle:UserInfo')->findId(1);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('formorder_show', array('id' => $entity->getId())));
        }

        return $this->render('CoyoteSiteBundle:FormOrder:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            //'user'
        ));
    }

    /**
    * Creates a form to create a FormOrder entity.
    *
    * @param FormOrder $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(FormOrder $entity)
    {
        $form = $this->createForm(new FormOrderType(), $entity, array(
            'action' => $this->generateUrl('formorder_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new FormOrder entity.
     *
     */
    public function newAction()
    {
        $entity = new FormOrder();
        $form   = $this->createCreateForm($entity);

        return $this->render('CoyoteSiteBundle:FormOrder:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a FormOrder entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoyoteSiteBundle:FormOrder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FormOrder entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CoyoteSiteBundle:FormOrder:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing FormOrder entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoyoteSiteBundle:FormOrder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FormOrder entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CoyoteSiteBundle:FormOrder:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a FormOrder entity.
    *
    * @param FormOrder $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(FormOrder $entity)
    {
        $form = $this->createForm(new FormOrderType(), $entity, array(
            'action' => $this->generateUrl('formorder_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing FormOrder entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoyoteSiteBundle:FormOrder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FormOrder entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('formorder_edit', array('id' => $id)));
        }

        return $this->render('CoyoteSiteBundle:FormOrder:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a FormOrder entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CoyoteSiteBundle:FormOrder')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find FormOrder entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('formorder'));
    }

    /**
     * Creates a form to delete a FormOrder entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('formorder_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
