<?php

namespace Coyote\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Coyote\SiteBundle\Entity\Schedule;
use Coyote\SiteBundle\Form\AbsenceType;

/**
 * Absence controller.
 *
 */
class AbsenceController extends Controller
{
    /**
     * Function to list Absence about Schedule Entity.
     * @access public
     * @param integer $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $maxItems = 10;
        $absences = $em->getRepository('CoyoteSiteBundle:Schedule')->absenceByUser($this->getUser());
        $absences_count = count($absences);
        $pagination = array(
            'page' => $page,
            'route' => 'absence',
            'pages_count' => ceil($absences_count / $maxItems),
            'route_params' => array()
        );
        $entities = $this->getDoctrine()->getRepository('CoyoteSiteBundle:Schedule')
            ->getListAbsenceUser($this->getUser(), $page, $maxItems);
        return $this->render('CoyoteSiteBundle:Absence:index.html.twig', array(
                        'entities' => $entities,
                        'pagination' => $pagination));
    }
   
    /**
     * Creates a new Schedule entity.
     * @access public
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $entity = new Schedule();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setUser($this->getUser());
            $entity->setStart('0:00');
            $entity->setBreak('0:00');
            $entity->setEnd('0:00');
            $entity->setWorkingTime('0:00');
            $entity->setWorkingHours('0');
            $entity->setComment("");
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('absence'));
        }

        return $this->render('CoyoteSiteBundle:Absence:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Schedule entity.
     * @access private
     * @param Schedule $entity The entity
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Schedule $entity)
    {
        $form = $this->createForm(new AbsenceType(), $entity, array(
            'action' => $this->generateUrl('absence_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Schedule entity.
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction()
    {
        $entity = new Schedule();
        $form   = $this->createCreateForm($entity);

        return $this->render('CoyoteSiteBundle:Absence:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Schedule entity.
     * @access public
     * @param mixed $id The entity id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CoyoteSiteBundle:Schedule')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Schedule entity.');
        }
        if ($entity->getUser() != $this->getUser())
        {
            throw $this->createNotFoundException("You don't have permission to view this entity.");
        }
        return $this->render('CoyoteSiteBundle:Absence:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing Schedule entity.
     * @access public
     * @param mixed $id The entity id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoyoteSiteBundle:Schedule')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Schedule entity.');
        }

        $editForm = $this->createEditForm($entity);
        return $this->render('CoyoteSiteBundle:Absence:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Schedule entity.
    * @access private
    * @param Schedule $entity The entity
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Schedule $entity)
    {
        $form = $this->createForm(new AbsenceType(), $entity, array(
            'action' => $this->generateUrl('absence_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        return $form;
    }

    /**
     * Edits an existing Schedule entity.
     * @access public
     * @param Request $request
     * @param mixed $id The entity id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CoyoteSiteBundle:Schedule')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Schedule entity.');
        }
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        if ($editForm->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('absence'));
        }
        return $this->render('CoyoteSiteBundle:Absence:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Schedule entity.
     * @access public
     * @param Request $request
     * @param mixed $id The entity id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CoyoteSiteBundle:Schedule')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Schedule entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('absence'));
    }

    /**
     * Creates a form to delete a Schedule entity by id.
     * @access private
     * @param mixed $id The entity id
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('absence_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /*****************************************************************/
    /***********************Fonctions En cours************************/
    /*****************************************************************/
    
    
    
    
    
    /*****************************************************************/
    /***********************Fonctions Erronées************************/
    /*****************************************************************/
}
