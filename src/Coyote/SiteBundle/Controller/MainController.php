<?php

namespace Coyote\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * Main controller.
 *
 */
class MainController extends Controller
{
	/**
	 * Function to show view menu and save data in session.
	 * @access public
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function getMenuAction(Request $request)
	{
		$user = $this->get('security.context')->getToken()->getUser();
		$session = $request->getSession();
		$locale = $request->getLocale();
		if ($user == "anon.")
		{
			return $this->redirect($this->generateUrl('main_login', array('_locale' => $locale)));
		}
		if ($this->get('security.context')->isGranted('ROLE_SUPER_ADMIN'))
		{
			return $this->redirect($this->generateUrl('sonata_admin_dashboard'));
		}
		else
		{
			$em = $this->getDoctrine()->getManager();
			$data_user = $em->getRepository('CoyoteSiteBundle:User')->findOneById($this->getUser());
			$date = date('Y').'-'.date('m').'-'.date('d');
			$date = (new \DateTime($date));
			$session->set('week', $date->format('W'));
			$session->set('year', $date->format('Y'));
			$date = $em->getRepository('CoyoteSiteBundle:Timetable')->findOneBy(array('date' => $date));
			$session->set('period', $date->getPeriod());
			$session->set('status', $data_user->getRoles());
			$locale = $request->getLocale();
			$data_quote = $em->getRepository('CoyoteSiteBundle:Quote')->findby(array
					('week' => date('W'), 'year' => date('Y')));
			return $this->render('CoyoteSiteBundle:Accueil:menu.html.twig', array('quote' => $data_quote,
					'_locale' => $locale));
		}
	}

	/**
	 * Function to change language website.
	 * @access public
	 * @param mixed $_locale
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function postLanguageAction(Request $request, $_locale)
	{
		$session = $request->getSession();
		$session->set('lang', $_locale);
		$user = $this->get('security.context')->getToken()->getUser();
		if ($user == "anon.")
		{
			return $this->redirect($this->generateUrl('main_login', array('_locale' => $session->get('lang'))));
		}
		else
		{
			return $this->redirect($this->generateUrl('main_menu', array('_locale' => $session->get('lang'))));
		}
	}

	/*************************FOS User Bundle*************************/

	/**
	 * Function login FOS.
	 * @access public
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function loginAction(Request $request)
	{
		$session = $request->getSession();
		$_locale = $session->get('lang');

		$user = $this->get('security.context')->getToken()->getUser();
		if ($user != "anon.")
		{
			return $this->redirect($this->generateUrl('main_menu'));
		}
		// get the error if any (works with forward and redirect -- see below)
		if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR))
		{
			$error = $request->attributes->get(SecurityContextInterface::AUTHENTICATION_ERROR);
		}
		elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR))
		{
			$session->set('lang', $_locale);
			$this->container->get('request')->setLocale($session->get('lang'));
			$error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
			$session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
		}
		else
		{
			$error = '';
		}
		if ($error) {
			// TODO: this is a potential security risk (see http://trac.symfony-project.org/ticket/9523)
			$error = $error->getMessage();
		}
		// last username entered by the user
		$lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);

		$csrfToken = $this->container->has('form.csrf_provider')
		? $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate')
		: null;

		return $this->renderLogin(array(
				'last_username' => $lastUsername,
				'error'         => $error,
				'csrf_token' => $csrfToken,
		));
	}

	/**
	 *  Function to show view Login FOS.
	 * @param array $data
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	protected function renderLogin(array $data)
	{
		$template = sprintf('CoyoteSiteBundle:Security:login.html.twig');
		return $this->container->get('templating')->renderResponse($template, $data);
	}

	/**
	 * Function to check login FOS.
	 * @throws \RuntimeException
	 */
	public function checkAction()
	{
		throw new \RuntimeException('You must configure the check path to be handled by the firewall
            using form_login in your security firewall configuration.');
	}

	/**
	 * Function logout FOS.
	 * @throws \RuntimeException
	 */
	public function logoutAction()
	{
		throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
	}

	/**
	 * Function to redirect to index.
	 * @access public
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function redirectAction(Request $request)
	{
		return $this->forward('CoyoteSiteBundle:Main:getMenu', array('_locale' => $request->getLocale()));
	}

	/**
	 * Function to show index page.
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function indexAction()
	{
		return $this->render('CoyoteSiteBundle:Base:index.html.twig');
	}

	/*****************************************************************/
	/***********************Fonctions En cours************************/
	/*****************************************************************/


	/*****************************************************************/
	/***********************Fonctions Erronées************************/
	/*****************************************************************/


}