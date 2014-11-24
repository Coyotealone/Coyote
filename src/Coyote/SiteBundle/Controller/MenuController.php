<?php

namespace Coyote\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Compenent\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\SecurityContextInterface;

use Doctrine\ORM\EntityRepository;


/**
 * Controller managing page menu
 *
 */
class MenuController extends Controller
{

    /**
     * show view menu.
     *
     * @access public
     * @return void
     */
    public function indexAction()
    {
        return $this->render('CoyoteSiteBundle:Accueil:menu.html.twig');
    }

    /**
     * show view menu.
     *
     * @access public
     * @return void
     */
    public function menuAction()
    {
        return $this->render('CoyoteSiteBundle:Accueil:menu.html.twig');
    }
}

