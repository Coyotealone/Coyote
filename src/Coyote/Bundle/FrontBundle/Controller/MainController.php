<?php

namespace Coyote\Bundle\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
		else
		{
			$em = $this->getDoctrine()->getManager();
			$data_user = $em->getRepository('ApplicationSonataUserBundle:User')->findOneById($this->getUser());
			$date = date('Y').'-'.date('m').'-'.date('d');
			$date = (new \DateTime($date));
			$session->set('week', $date->format('W'));
			$session->set('year', $date->format('Y'));
			$session->set('period', $em->getRepository('CoyoteAttendanceBundle:Schedule')->createPeriod(date('Y').'-'
			    .date('m').'-'.date('d')));
			$session->set('status', $data_user->getRoles());
			if (!empty($data_user->getLocale()))
			{
    			$locale = $data_user->getLocale();
			}
			else
			{
                $locale = $request->getLocale();
            }
			return $this->render('CoyoteFrontBundle:Accueil:menu.html.twig', array('_locale' => $locale));
		}
	}

	public function getBackOfficeAction(Request $request)
	{
    	if ($this->get('security.context')->isGranted('ROLE_SUPER_ADMIN'))
		{
    		$request->getSession()->set('_locale', 'en');
            $request->setLocale('en');
			return $this->redirect($this->generateUrl('sonata_admin_dashboard'));
		}
		else
		{
    		$em = $this->getDoctrine()->getManager();
			$data_user = $em->getRepository('ApplicationSonataUserBundle:User')->findOneById($this->getUser());
			if (!empty($data_user->getLocale()))
			{
    			$locale = $data_user->getLocale();
			}
			else
			{
                $locale = $request->getLocale();
            }
		    return $this->render('CoyoteFrontBundle:Accueil:menu.html.twig', array('_locale' => $locale));
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
		$template = sprintf('CoyoteFrontBundle:Security:login.html.twig');
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
		return $this->forward('CoyoteFrontBundle:Main:getMenu', array('_locale' => $request->getLocale()));
	}

	/**
	 * Function to show index page.
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function indexAction()
	{
		return $this->render('CoyoteFrontBundle:Base:index.html.twig');
	}

    /**
     *
     *
     */
	public function getScheduleUserAction()
    {
        /** @var $em object doctrine request */
        $em = $this->getDoctrine()->getManager();
        /** @var $request object request */
        $request = Request::createFromGlobals();
        /** @var $dataexpense string data file */
        $data_request = $request->request->all();

        if ($request->getMethod() == 'GET' && isset($_GET['pay_period']))
    	{
            $period = $_GET['pay_period'];
            $user = $em->getRepository('ApplicationSonataUserBundle:User')->findOneById($_GET['user']);
            /** @var $filename string */
            $filename = "export_period".$period.$user->getFirstname().".csv";

            $data_schedule = $em->getRepository('CoyoteAttendanceBundle:Schedule')->createFileUser($user, $period);
            /** @return file txt downloaded with data expense */
            return new Response($data_schedule, 200, array(
                'Content-Type' => 'application/force-download',
                'Content-Disposition' => 'attachment; filename="'.$filename.'"'
            ));
        }
        else
        {
            $tab_period = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findPeriod();
        	$date = date('Y-m-d');
        	$doctrine = $this->getDoctrine();
        	$em = $doctrine->getManager();
        	$period = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findPeriodByDate($date);
        	$tab_user = $em->getRepository('ApplicationSonataUserBundle:User')->findBy(array('enabled' => 1), array('firstname' => 'ASC'));
            /** show view */
            return $this->render('CoyoteFrontBundle:Schedule:indexscheduleuserexcelmain.html.twig', array(
                'period' => $period, 'tab_period' => $tab_period, 'tab_user' => $tab_user));
        }
    }

	/*****************************************************************/
	/***********************Fonctions En cours************************/
	/*****************************************************************/


	/*****************************************************************/
	/***********************Fonctions Erronées************************/
	/*****************************************************************/

}
