<?php

namespace Coyote\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     * Function to show view menu.
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $session = new Session();
        $week = date('W');
        $year = date('Y');
        if ($week == 1)
        {
            $year = $year + 1;
        }
        $em = $this->getDoctrine()->getManager();
        $lang = $session->get('lang');
        if (empty($lang))
        {
            $lang = 'fr';
        }
        $data_quote = $em->getRepository('CoyoteSiteBundle:Quote')->findby(array('week' => $week, 'year' => $year));
        return $this->render('CoyoteSiteBundle:Accueil:menu.html.twig', array('quote' => $data_quote,
            '_locale' => $lang));
    }

    /**
     * Function to show view menu.
     * @access public
     * @return void
     */
    public function menuAction()
    {
        $session = new Session();
        $week = date('W');
        $year = date('Y');
        $em = $this->getDoctrine()->getManager();
        $lang = $session->get('lang');
        if (empty($lang))
        {
            $lang = 'fr';
        }
        $data_quote = $em->getRepository('CoyoteSiteBundle:Quote')->findby(array('week' => $week, 'year' => $year));
        return $this->render('CoyoteSiteBundle:Accueil:menu.html.twig', array('quote' => $data_quote,
            '_locale' => $lang));
    }
}

