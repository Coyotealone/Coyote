<?php

namespace Coyote\SiteBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Coyote\SiteBundle\Entity\Schedule;
use Coyote\SiteBundle\Entity\User;

class RestController extends FOSRestController
{
    /**
     * @Rest\Get("absence/{user}")
     * @ApiDoc(
     *      section="Schedule Entity",
     *      description="Get absence by user from database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          404 = "Not Found",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @param User $user User.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAllAbsenceByUserAction($user)
    {
        /*$em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("CoyoteSiteBundle:User")->findOneBy($user);
        $entity = $em->getRepository("CoyoteSiteBundle:Schedule")->absenceByUser($user);
        if (count($entity) > 0)
        {
            $view = $this->view(array(
                            "Absence" => $entity
            ),200);
        }
        else*/
        {
            $view = $this->view(array(
                            "No absence" => "Empty"
            ),204);
        }
        return $this->handleView($view);
    }
    
    /**
     * @Rest\Get("user")
     * @ApiDoc(
     *      section="User Entity",
     *      description="Get all user from database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          404 = "Not Found",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAllUserAction()
    {
        /*$em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("CoyoteSiteBundle:User")->findAll();
        if (count($entity) > 0)
        {
            $view = $this->view(array(
                            "Users" => $entity
            ),200);
        }
        else*/
        {
            $view = $this->view(array(
                            "No Users" => "Empty"
            ),204);
        }
        return $this->handleView($view);
    }
    
    /**
     * @Rest\Get("car")
     * @ApiDoc(
     *      section="Car Entity",
     *      description="Get all car from database",
     *      statusCodes = {
     *          200 = "OK",
     *          201 = "Created",
     *          204 = "No Content",
     *          404 = "Not Found",
     *          406 = "Not Acceptable",
     *      }
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAllCarAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("CoyoteSiteBundle:Car")->findAll();
        if (count($entity) > 0)
        {
            $view = $this->view(array(
                            "Cars" => $entity
            ),200);
        }
        else
        {
            $view = $this->view(array(
                            "No Cars" => $entity
            ),204);
        }
        return $this->handleView($view);
    }
}
