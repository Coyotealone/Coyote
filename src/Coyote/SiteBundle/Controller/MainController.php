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
            return $this->redirect($this->generateUrl('coyote_main_login'));
            //return $this->redirect($this->generateUrl('fos_user_security_login'));
        if($this->get('security.context')->isGranted('ROLE_SUPER_ADMIN'))
        {
            return $this->redirect($this->generateUrl('sonata_admin_dashboard'));
        }
        if($this->get('security.context')->isGranted('ROLE_COMPTA'))
        {
            return $this->render('CoyoteSiteBundle:Admin:index.html.twig');
        }
        if($this->get('security.context')->isGranted('ROLE_CHEF_BE'))
        {
            return $this->render('CoyoteSiteBundle:Admin:index.html.twig');
        }
        if($this->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            //return $this->render('CoyoteSiteBundle:Admin:index.html.twig');
            return $this->redirect($this->generateUrl('sonata_admin_dashboard'));
        }
        else
        {
            $em = $this->getDoctrine()->getManager();
            
            $iduser = $this->get('security.context')->getToken()->getUser()->getId();
            $session->set('userid', $iduser);
            
            $datauser = $em->getRepository('CoyoteSiteBundle:User')->findOneById($iduser);
            $userfees_data = $em->getRepository('CoyoteSiteBundle:UserFees')->findOneByUser($session->get('userid'));
            
            $session->set('year', date('Y'));
            $session->set('no_week', date('W'));
            $session->set('username', $datauser->getName());
            $session->set('status', $datauser->getRoles());
            if($userfees_data != null)
                $session->set('userfeesid', $userfees_data->getId());
            $lang = $session->get('lang');
            if(empty($lang))
                $lang = 'fr';
            return $this->redirect($this->generateUrl('coyote_main_menu', array('_locale' => $lang)));
            return $this->render('CoyoteSiteBundle:Accueil:menu.html.twig');
        }
    }

    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContextInterface::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
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
        $template = sprintf('FOSUserBundle:Security:login.html.%s', $this->container->getParameter('fos_user.template.engine'));

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

    public function menuAction()
    {
        return $this->render('CoyoteSiteBundle:Accueil:menu.html.twig');
    }

    public function languageAction($_locale)
    {
        $url = $this->container->get('router')->getContext()->getBaseUrl(); // /Coyote/web/app_dev.php
        $host = $this->container->get('router')->getContext()->getHost(); //localhost
        $scheme = $this->container->get('router')->getContext()->getScheme(); //http
        //$context->setHost('example.com');
        //$context->setScheme('https');
        //$context->setBaseUrl('my/path');
    
        //return new Response($url);
        $user = $this->get('security.context')->getToken()->getUser();
        
        $request = $this->getRequest();
        
        $locale = $request->getLocale();
        $lang = $this->get('request')->request->get('langue');
        //$_locale = $lang;
        
        $session = new Session();
        $session->set('lang', null);
        $session->set('lang', $_locale);
        //return new Response($_locale);
        /*if($lang == 'fr')
        {
            $request->setLocale('fr_FR');
            $_locale = 'fr';
            $session->set('lang', 'fr');
        }
        if($lang == 'en')
        {
            $request->setLocale('en_GB');
            $_locale = 'en';
            $session->set('lang', 'en');
        }*/
        
        
        if($user == "anon.")
        {   
            return $this->redirect($this->generateUrl('coyote_main_login'));
            //return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        else
        {
            return $this->redirect($this->generateUrl('coyote_main_menu', array('_locale' => $session->get('lang'))));
        }
    }

    public function testAction()
    {
        $name = 'toto';
        $facade = $this->get('ps_pdf.facade');
        $response = new Response();
        $this->render('CoyoteSiteBundle:Accueil:helloAction.pdf.twig', array("name" => $name), $response);
    
        $xml = $response->getContent();
    
        $content = $facade->render($xml);
    
        return new Response($content, 200, array('content-type' => 'application/pdf'));
    
        
        $format = $this->get('request')->get('_format');
        $format = 'pdf';
        $name = 'toto';
        return $this->render(sprintf('CoyoteSiteBundle:Accueil:helloAction.%s.twig', $format), array(
            'name' => $name,
        ));

    }

}

