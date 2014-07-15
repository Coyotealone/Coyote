<?php

namespace Coyote\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        if($user == "anon.")
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        else
            return $this->redirect($this->generateUrl('accueil'));
        //return $this->render('CoyoteSiteBundle:Default:index.html.twig');
    }
}
