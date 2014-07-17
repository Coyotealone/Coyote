<?php

namespace Coyote\SiteBundle\Controller;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Compenent\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Session\Session;

use Doctrine\ORM\EntityRepository;

use FOS\UserBundle\Controller\RegistrationController as BaseController;

class RegistrationController extends Controller
{
    public function registerAction()
    {
        if($this->get('security.context')->isGranted('ROLE_SUPER_ADMIN'))
        {
            $form = $this->container->get('fos_user.registration.form');
            $formHandler = $this->container->get('fos_user.registration.form.handler');
            $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');
    
            $process = $formHandler->process($confirmationEnabled);
            if ($process) {
                $user = $form->getData();
    
                /*****************************************************
                 * Add new functionality (e.g. log the registration) *
                 *****************************************************/
                $this->container->get('logger')->info(
                    sprintf('New user registration: %s', $user)
                );
    
                if ($confirmationEnabled) {
                    $this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
                    $route = 'fos_user_registration_check_email';
                } else {
                    $this->authenticateUser($user);
                    $route = 'fos_user_registration_confirmed';
                }
    
                $this->setFlash('fos_user_success', 'registration.flash.user_created');
                $url = $this->container->get('router')->generate($route);
    
                return new RedirectResponse($url);
            }
    
            return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.'.$this->getEngine(), array(
                'form' => $form->createView(),
                'theme' => $this->container->getParameter('fos_user.template.theme'),
            ));
        }
        
        else
            return $this->redirect($this->generateUrl('accueil'));
    }
}
