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
    public function indexAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $session = new Session();
        if($user == "anon.")
            return $this->redirect($this->generateUrl('main_login'));
        if($this->get('security.context')->isGranted('ROLE_SUPER_ADMIN'))
        {
            return $this->redirect($this->generateUrl('sonata_admin_dashboard'));
        }
        if($this->get('security.context')->isGranted('ROLE_CONFIG'))
        {
            return $this->redirect($this->generateUrl('configurator'));
        }
        else
        {
            $em = $this->getDoctrine()->getManager();

            $iduser = $this->get('security.context')->getToken()->getUser()->getId();
            $session->set('userid', $iduser);

            $datauser = $em->getRepository('CoyoteSiteBundle:User')->findOneById($iduser);

            $session->set('year', date('Y'));
            $session->set('no_week', date('W'));
            $session->set('username', $datauser->getName());
            $session->set('status', $datauser->getRoles());
            if($this->get('security.context')->isGranted('ROLE_BUSINESS'))
            {
                $userfees_data = $em->getRepository('CoyoteSiteBundle:UserFees')->findOneByUser($session->get('userid'));
                if($userfees_data != null)
                    $session->set('userfeesid', $userfees_data->getId());
            }

            $lang = $session->get('lang');
            if(empty($lang))
                $lang = 'fr';

            return $response = $this->forward('CoyoteSiteBundle:Main:menu', array('_locale' => $lang));
        }
    }

    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        $locale = $request->getLocale();
        $session->set('lang', $locale);

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR))
        {
            $error = $request->attributes->get(SecurityContextInterface::AUTHENTICATION_ERROR);
        }
        elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR))
        {
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
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }

    public function logoutAction()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }

    public function menuAction($_locale)
    {
        $week = 49;//date('W');
        $year = date('Y');
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $quote = $em->getRepository('CoyoteSiteBundle:Quote')->findby(array('week' => $week, 'year' => $year));

        return $this->render('CoyoteSiteBundle:Accueil:menu.html.twig', array('quote' => $quote, '_locale' => $_locale));
    }

    public function languageAction($_locale)
    {
        $user = $this->get('security.context')->getToken()->getUser();

        $session = new Session();
        $session->set('lang', null);
        $session->set('lang', $_locale);

        if($user == "anon.")
        {
            return $this->redirect($this->generateUrl('main_login'));
        }
        else
        {
            return $this->redirect($this->generateUrl('main_menu', array('_locale' => $session->get('lang'))));
        }
    }
}

