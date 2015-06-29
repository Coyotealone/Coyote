<?php

namespace Coyote\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Coyote\SiteBundle\Entity\ServicesFunctions;
use Coyote\SiteBundle\Form\ServicesFunctionsType;

/**
 * ServicesFunctions controller.
 *
 */
class ServicesFunctionsController extends Controller
{

    /**
     * Lists all ServicesFunctions entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CoyoteSiteBundle:ServicesFunctions')->findAll();

        return $this->render('CoyoteSiteBundle:ServicesFunctions:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new ServicesFunctions entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ServicesFunctions();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('servicesfunctions_show', array('id' => $entity->getId())));
        }

        return $this->render('CoyoteSiteBundle:ServicesFunctions:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ServicesFunctions entity.
     *
     * @param ServicesFunctions $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ServicesFunctions $entity)
    {
        $form = $this->createForm(new ServicesFunctionsType(), $entity, array(
            'action' => $this->generateUrl('servicesfunctions_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ServicesFunctions entity.
     *
     */
    public function newAction()
    {
        $entity = new ServicesFunctions();
        $form   = $this->createCreateForm($entity);

        return $this->render('CoyoteSiteBundle:ServicesFunctions:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ServicesFunctions entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoyoteSiteBundle:ServicesFunctions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ServicesFunctions entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CoyoteSiteBundle:ServicesFunctions:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ServicesFunctions entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoyoteSiteBundle:ServicesFunctions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ServicesFunctions entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CoyoteSiteBundle:ServicesFunctions:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ServicesFunctions entity.
    *
    * @param ServicesFunctions $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ServicesFunctions $entity)
    {
        $form = $this->createForm(new ServicesFunctionsType(), $entity, array(
            'action' => $this->generateUrl('servicesfunctions_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ServicesFunctions entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoyoteSiteBundle:ServicesFunctions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ServicesFunctions entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('servicesfunctions_edit', array('id' => $id)));
        }

        return $this->render('CoyoteSiteBundle:ServicesFunctions:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ServicesFunctions entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CoyoteSiteBundle:ServicesFunctions')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ServicesFunctions entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('servicesfunctions'));
    }

    /**
     * Creates a form to delete a ServicesFunctions entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('servicesfunctions_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
