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
class MenuController extends Controller
{
    public function indexAction()
    {
        return $this->render('CoyoteSiteBundle:Accueil:menu.html.twig');
    }
    
    public function menuAction()
    {
        return $this->render('CoyoteSiteBundle:Accueil:menu.html.twig');
    }
}

