<?php

namespace Coyote\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Compenent\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\SecurityContextInterface;

use Coyote\SiteBundle\Entity\User;
use Coyote\SiteBundle\Entity\UserInfo;
use Coyote\SiteBundle\Form\UserType;

use Doctrine\ORM\EntityRepository;


/**
 * Main controller.
 *
 */
class MainController extends Controller
{
    /**
     * indexAction function.
     *
     * @access public
     * @return void
     */
    public function indexAction()
    {
        /** @var $user role User */
        $user = $this->get('security.context')->getToken()->getUser();

        $request = $this->getRequest();
        $session = $request->getSession();
        /** @var $locale string _locale */
        $locale = $request->getLocale();
        /** set lang */
        //$session->set('lang', $_locale);

        /** @var $session new object Session */
        //$session = new Session();
        /** check $user role */
        if($user == "anon.")
            /** redirect MainController:loginAction */
            return $this->redirect($this->generateUrl('main_login', array('_locale' => $locale)));
        /** check role */
        if($this->get('security.context')->isGranted('ROLE_SUPER_ADMIN'))
        {
            /** redirect SonataAdminController */
            return $this->redirect($this->generateUrl('sonata_admin_dashboard'));
        }
        else
        {
            /** @var $em object doctrine request */
            $em = $this->getDoctrine()->getManager();
            /** @var $user_id int user id */
            $user_id = $this->get('security.context')->getToken()->getUser()->getId();
            /** set userid */
            $session->set('userid', $user_id);
            /** @var $data_user entity User */
            $data_user = $em->getRepository('CoyoteSiteBundle:User')->findOneById($user_id);
            /** set no_week */
            $session->set('no_week', date('W'));
            /** set year */
            $year = date('Y');
            if($session->get('no_week') == 1)
                $year = $year + 1;
            $session->set('year', $year);

            $date = date('Y').'-'.date('m').'-'.date('d');
            $date = (new \DateTime($date));
            $date = $em->getRepository('CoyoteSiteBundle:Timetable')->findOneBy(array('date' => $date));
            /** set pay_period */
            $session->set('pay_period', $date->getPayPeriod());
            /** set username */
            $session->set('username', $data_user->getName());
            /** set status */
            $session->set('status', $data_user->getRoles());
            /** check role */
            if($this->get('security.context')->isGranted('ROLE_BUSINESS'))
            {
                /** @var $data_userfees entity UserFees */
                $data_userfees = $em->getRepository('CoyoteSiteBundle:UserFees')->findOneByUser(
                    $session->get('userid'));
                /** check $data_userfees */
                if($data_userfees != null)
                    /** set userfeesid */
                    $session->set('userfeesid', $data_userfees->getId());
            }
            /** @var $lang string _locale */
            $lang = $session->get('lang');
            /** check $lang */
            if(empty($lang))
                $lang = 'fr';
            /** show view */
            return $response = $this->forward('CoyoteSiteBundle:Main:menu', array('_locale' => $lang));
        }
    }

    /**
     * loginAction function.
     *
     * @access public
     * @return void
     */
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        $_locale = $session->get('lang');
        /** set lang */
        //$session->set('lang', $locale);

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

    protected function renderLogin(array $data)
    {
        $template = sprintf('CoyoteSiteBundle:Security:login.html.twig');

        return $this->container->get('templating')->renderResponse($template, $data);
    }

    public function checkAction()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall
            using form_login in your security firewall configuration.');
    }

    public function logoutAction()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }

    public function menuAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        /** @var $locale string _locale */
        $locale = $request->getLocale();

        /** @var $week string mm */
        $week = date('W');
        /** @var $year string yyyy */
        $year = date('Y');
        if($week == 1)
            $year = $year + 1;
        /** @var $em object doctrine request */
        $em = $this->getDoctrine()->getManager();
        /** @var $data_quote entity Quote */
        $data_quote = $em->getRepository('CoyoteSiteBundle:Quote')->findby(array('week' => $week, 'year' => $year));
        /** show view */
        return $this->render('CoyoteSiteBundle:Accueil:menu.html.twig', array('quote' => $data_quote,
            '_locale' => $locale));
    }

    public function languageAction($_locale)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        /** @var $locale string _locale */
        $locale = $request->getLocale();
        /** set lang */
        $session->set('lang', $_locale);


        /** @var $user role */
        $user = $this->get('security.context')->getToken()->getUser();
        /** check $user */
        if($user == "anon.")
            /** redirect MainController:loginAction */
            return $this->redirect($this->generateUrl('main_login', array('_locale' => $session->get('lang'))));
        else
            /** redirect MainController:MenuAction */
            return $this->redirect($this->generateUrl('main_menu', array('_locale' => $session->get('lang'))));
    }

    public function redirectAction()
    {

        $request = $this->getRequest();
        $session = $request->getSession();
        //return new Response($session->get('lang'));
        return $response = $this->forward('CoyoteSiteBundle:Main:index', array('_locale' => $request->getLocale()));
        return $this->redirect($this->generateUrl('main_login', array('_locale' => 'fr')));
    }
}