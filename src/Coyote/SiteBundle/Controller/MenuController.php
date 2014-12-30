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
        /** @var $session new object Session */
        $session = new Session();
        /** @var $week string mm */
        $week = date('W');
        /** @var $year string yy */
        $year = date('Y');
        if($week == 1)
            $year = $year + 1;
        /** @var $em object doctrine request */
        $em = $this->getDoctrine()->getManager();
        /** @var $lang string */
        $lang = $session->get('lang');
        /** check lang */
        if(empty($lang))
            $lang = 'fr';
        /** @var $data_quote entity Quote */
        $data_quote = $em->getRepository('CoyoteSiteBundle:Quote')->findby(array('week' => $week, 'year' => $year));
        /** show view */
        return $this->render('CoyoteSiteBundle:Accueil:menu.html.twig', array('quote' => $data_quote, '_locale' => $lang));
    }

    /**
     * show view menu.
     *
     * @access public
     * @return void
     */
    public function menuAction()
    {
        /** @var $session new object Session */
        $session = new Session();
        /** @var $week string mm */
        $week = date('W');
        /** @var $year string yy */
        $year = date('Y');
        /** @var $em object doctrine request */
        $em = $this->getDoctrine()->getManager();
        /** @var $lang string */
        $lang = $session->get('lang');
        /** check lang */
        if(empty($lang))
            $lang = 'fr';
        /** @var $data_quote entity Quote */
        $data_quote = $em->getRepository('CoyoteSiteBundle:Quote')->findby(array('week' => $week, 'year' => $year));
        /** show view */
        return $this->render('CoyoteSiteBundle:Accueil:menu.html.twig', array('quote' => $data_quote, '_locale' => $lang));
    }
}

