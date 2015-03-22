<?php

namespace Coyote\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Coyote\SiteBundle\Entity\Holiday;
use Coyote\SiteBundle\Form\HolidayType;

/**
 * Holiday controller.
 *
 */
class HolidayController extends Controller
{

    /**
     * Lists all Holiday entities.
     *
     */
    public function getHolidaysAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('CoyoteSiteBundle:Holiday')->findOneByUser($this->getUser());
        return $this->render('CoyoteSiteBundle:Holiday:index.html.twig', array(
            'holiday' => $entities,
        ));
    }

    /**
     * Creates a new Holiday entity.
     *
     */
    public function putcreateHolidayAction(Request $request)
    {
        $entity = new Holiday();

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setUser($this->getUser());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('holiday'));
        }

        return $this->render('CoyoteSiteBundle:Holiday:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Holiday entity.
     *
     * @param Holiday $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Holiday $entity)
    {
        $entity->setUser($this->getUser());
        $form = $this->createForm(new HolidayType(), $entity, array(
            'action' => $this->generateUrl('holiday_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Holiday entity.
     *
     */
    public function putnewHolidayAction()
    {
        $entity = new Holiday();
        $form   = $this->createCreateForm($entity);

        return $this->render('CoyoteSiteBundle:Holiday:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Holiday entity.
     *
     */
    public function getHolidayAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CoyoteSiteBundle:Holiday')->findOneByUser($this->getUser());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Holiday entity.');
        }
        return $this->render('CoyoteSiteBundle:Holiday:show.html.twig', array(
            'holiday'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing Holiday entity.
     *
     */
    public function posteditHolidayAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CoyoteSiteBundle:Holiday')->findOneByUser($this->getUser());
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Holiday entity.');
        }
        $editForm = $this->createEditForm($entity);
        return $this->render('CoyoteSiteBundle:Holiday:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Holiday entity.
    *
    * @param Holiday $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Holiday $entity)
    {
        $form = $this->createForm(new HolidayType(), $entity, array(
            'action' => $this->generateUrl('holiday_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }

    /**
     * Edits an existing Holiday entity.
     *
     */
    public function postupdateHolidayAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoyoteSiteBundle:Holiday')->findOneByUser($this->getUser());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Holiday entity.');
        }

        //$deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('holiday'));
            //return $this->redirect($this->generateUrl('holiday_edit', array('id' => $id)));
        }

        return $this->render('CoyoteSiteBundle:Holiday:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            //'delete_form' => $deleteForm->createView(),
        ));
    }

    /*****************************************************************/
    /***********************Fonctions Erronées************************/
    /*****************************************************************/
    
    /**
     * Deletes a Holiday entity.
     *
     */
    /*public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CoyoteSiteBundle:Holiday')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Holiday entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('holiday'));
    }*/

    /**
     * Creates a form to delete a Holiday entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    /*private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('holiday_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }*/
}
