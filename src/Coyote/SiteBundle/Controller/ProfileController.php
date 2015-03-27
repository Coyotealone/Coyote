<?php

namespace Coyote\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

use Doctrine\ORM\EntityRepository;

use Coyote\SiteBundle\Entity\Schedule;
use Coyote\SiteBundle\Entity\Timetable;
use Coyote\SiteBundle\Entity\User;
use Coyote\SiteBundle\Entity\Data;

/**
 * Profile controller.
 *
 */
class ProfileController extends Controller
{
	/**
	 * Show profil user connected.
	 * @access public
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function getprofilUserAction()
	{
		/** @var object user */
		$user = $this->container->get('security.context')->getToken()->getUser();
		/** show view */
		return $this->render('CoyoteSiteBundle:Profile:show.html.twig', array('user' => $user));
	}
	
	/**
	 * Redirect to accueil if user want edit.
	 * @access public
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function profileditAction()
	{
		/** redirect MainController:indexAction */
		return $this->redirect($this->generateUrl('main_menu'));
	}
	
	/**
	 * Redirect to function fos_user_resetting_request.
	 * @access public
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function resettingAction()
	{
		/** redirect \FOS\UserBundle\Controller\ResettingController */
		return $this->redirect($this->generateUrl('fos_user_resetting_request'));
	}
}