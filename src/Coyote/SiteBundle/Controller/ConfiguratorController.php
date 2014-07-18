<?php

namespace Coyote\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Compenent\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Session\Session;

use Doctrine\ORM\EntityRepository;

use Coyote\SiteBundle\Entity\Schedule;
use Coyote\SiteBundle\Entity\Timetable;
use Coyote\SiteBundle\Entity\UserInfo;
use Coyote\SiteBundle\Entity\User;

/**
 * Configurator controller.
 *
 */
class ConfiguratorController extends Controller
{
    public function indexAction()
    {
        return $this->render('CoyoteSiteBundle:Config:newpage.html.twig');
        //$em = $this->getDoctrine()->getManager();        
        //$dataconfig = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->findByLink('U00',array('id' => 'asc'));
        //return $this->render('CoyoteSiteBundle:Config:pageun.html.twig', array('data' => $dataconfig));
    }

    public function pagedeuxAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $session = new Session();
        $request = Request::createFromGlobals();
        $data = $request->request->all();
        
        $id = $data['cuve'];
        $session->set('configtonne', $id);
        $id0 = $id.'0';
        
        $config = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->findLink($id0);
        $commun = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->findLinkCommun($id0);
        $configcommun = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->findLink($commun[0]['comment']);
        return $this->render('CoyoteSiteBundle:Config:pagedeux.html.twig', array('data' => $config, 'commun' => $configcommun));
    }

    public function pagetroisAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $session = new Session();
        $request = Request::createFromGlobals();
        $data = $request->request->all();
        
        $id = $session->get('configtonne');
        $id1 = $id.'1';
        $dataessieu = $data['essieux'];
        $dataessieu = explode(':', $dataessieu);
        if(count($dataessieu) > 1)
            $essieu = $dataessieu[1];
        
        $config = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->findLink($id1);
        $commun = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->findLinkCommun($id1);
        $configcommun = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->findLink($commun[0]['comment']);
        return $this->render('CoyoteSiteBundle:Config:pagetrois.html.twig', array('data' => $config, 'commun' => $configcommun, 'essieu' => $essieu));   
    }

    public function pagequatreAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $session = new Session();
        $request = Request::createFromGlobals();
        $data = $request->request->all();
        
        $id = $session->get('configtonne');
        $id2 = $id.'2';
        
        $config = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->findLink($id2);
        $commun = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->findLinkCommun($id2);
        for($i = 0; $i<count($commun); $i++)
        {
            $configcommun[$i] = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->findLink($commun[$i]['comment']);
        }
        if(count($configcommun) == 0)
            return $this->render('CoyoteSiteBundle:Config:pagequatre.html.twig', array('data' => $config)); 
        if(count($configcommun) == 1)
            return $this->render('CoyoteSiteBundle:Config:pagequatre.html.twig', array('data' => $config, 'commun0' => $configcommun[0]));
        if(count($configcommun) == 2)
            return $this->render('CoyoteSiteBundle:Config:pagequatre.html.twig', array('data' => $config, 'commun0' => $configcommun[0], 'commun1' => $configcommun[1]));
        if(count($configcommun) == 3)
            return $this->render('CoyoteSiteBundle:Config:pagequatre.html.twig', array('data' => $config, 'commun0' => $configcommun[0], 'commun1' => $configcommun[1], 'commun2' => $configcommun[2]));
        if(count($configcommun) == 4)
            return $this->render('CoyoteSiteBundle:Config:pagequatre.html.twig', array('data' => $config, 'commun0' => $configcommun[0], 'commun1' => $configcommun[1], 'commun2' => $configcommun[2], 'commun3' => $configcommun[3]));  
    }

    public function pagecinqAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $session = new Session();
        $request = Request::createFromGlobals();
        $data = $request->request->all();
        
        $id = $session->get('configtonne');
        $id3 = $id.'3';
        
        //$config = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->findLink($id2);
        return $this->render('CoyoteSiteBundle:Config:pagecinq.html.twig');//, array('data' => $config));   
    }
    

    public function pagesixAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $session = new Session();
        $request = Request::createFromGlobals();
        $data = $request->request->all();
        
        $id = $session->get('configtonne');
        $id4 = $id.'4';
        
        $config = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->findLink($id4);
        $commun = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->findLinkCommun($id4);
        $listcommun = '';
        for($i = 0; $i<count($commun); $i++)
        {
            $configcommun[$i] = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->findLink($commun[$i]['comment']);
            $listcommun .= $commun[$i]['comment'].';';
        }
        //return new Response($listcommun);
        if(count($configcommun) == 0)
            return $this->render('CoyoteSiteBundle:Config:pagesix.html.twig', array('data' => $config)); 
        if(count($configcommun) == 1)
            return $this->render('CoyoteSiteBundle:Config:pagesix.html.twig', array('data' => $config, 'commun0' => $configcommun[0]));
        if(count($configcommun) == 2)
            return $this->render('CoyoteSiteBundle:Config:pagesix.html.twig', array('data' => $config, 'commun0' => $configcommun[0], 'commun1' => $configcommun[1]));
        if(count($configcommun) == 3)
            return $this->render('CoyoteSiteBundle:Config:pagesix.html.twig', array('data' => $config, 'commun0' => $configcommun[0], 'commun1' => $configcommun[1], 'commun2' => $configcommun[2]));
        if(count($configcommun) == 4)
            return $this->render('CoyoteSiteBundle:Config:pagesix.html.twig', array('data' => $config, 'commun0' => $configcommun[0], 'commun1' => $configcommun[1], 'commun2' => $configcommun[2], 'commun3' => $configcommun[3]));
        if(count($configcommun) == 5)
            return $this->render('CoyoteSiteBundle:Config:pagesix.html.twig', array('data' => $config, 'commun0' => $configcommun[0], 'commun1' => $configcommun[1], 'commun2' => $configcommun[2], 'commun3' => $configcommun[3], 'commun4' => $configcommun[4])); 
        if(count($configcommun) == 6)
            return $this->render('CoyoteSiteBundle:Config:pagesix.html.twig', array('data' => $config, 'commun0' => $configcommun[0], 'commun1' => $configcommun[1], 'commun2' => $configcommun[2], 'commun3' => $configcommun[3], 'commun4' => $configcommun[4], 'commun5' => $configcommun[5]));
        if(count($configcommun) == 7)
            return $this->render('CoyoteSiteBundle:Config:pagesix.html.twig', array('data' => $config, 'commun0' => $configcommun[0], 'commun1' => $configcommun[1], 'commun2' => $configcommun[2], 'commun3' => $configcommun[3], 'commun4' => $configcommun[4], 'commun5' => $configcommun[5], 'commun6' => $configcommun[6]));
        if(count($configcommun) == 8)
            return $this->render('CoyoteSiteBundle:Config:pagesix.html.twig', array('data' => $config, 'commun0' => $configcommun[0], 'commun1' => $configcommun[1], 'commun2' => $configcommun[2], 'commun3' => $configcommun[3], 'commun4' => $configcommun[4], 'commun5' => $configcommun[5], 'commun6' => $configcommun[6], 'commun7' => $configcommun[7])); 
    }
    
    public function pageseptAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $session = new Session();
        $request = Request::createFromGlobals();
        $data = $request->request->all();
        
        $id = $session->get('configtonne');
        $id5 = $id.'5';
        
        $config = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->findLink($id5);
        $commun = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->findLinkCommun($id5);
        $configcommun = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->findLink($commun[0]['comment']);
        
        return $this->render('CoyoteSiteBundle:Config:pagesept.html.twig', array('data' => $config, 'commun' => $configcommun)); 
    }

    public function pagehuitAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $session = new Session();
        $request = Request::createFromGlobals();
        $data = $request->request->all();
        
        $id = $session->get('configtonne');
        $id6 = $id.'6';
        
        $config = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->findLink($id6);
        $commun = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->findLinkCommun($id6);
        $listcommun = '';
        for($i = 0; $i<count($commun); $i++)
        {
            $configcommun[$i] = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->findLink($commun[$i]['comment']);
            $listcommun .= $commun[$i]['comment'].';';
        }
        if(count($configcommun) == 0)
            return $this->render('CoyoteSiteBundle:Config:pagehuit.html.twig', array('data' => $config)); 
        if(count($configcommun) == 1)
            return $this->render('CoyoteSiteBundle:Config:pagehuit.html.twig', array('data' => $config, 'commun0' => $configcommun[0]));
        if(count($configcommun) == 2)
            return $this->render('CoyoteSiteBundle:Config:pagehuit.html.twig', array('data' => $config, 'commun0' => $configcommun[0], 'commun1' => $configcommun[1]));
    }
    
    public function pageneufAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $session = new Session();
        $request = Request::createFromGlobals();
        $data = $request->request->all();
        
        return $this->render('CoyoteSiteBundle:Config:pageneuf.html.twig'); 

    }




    public function codeAction()
    {
        /*$em = $this->getDoctrine()->getManager();
        $itemcode = "1033;1034;1032;1036;250;251;252;964;966;523;967;973;528;963;996;529;965;966;967;963;968;525;974;526;969;527;270;264;970;530;269;976;539;268;262;971;972;975;429;267;303";
        
        $itemcode = explode(";", $itemcode);
        $nbcode = count($itemcode);
        $resfinal = "";
        $i=0;
        //return new Response($itemcode[$i]);
        for($i = 0; $i<$nbcode; $i++)
        {
            $em = $this->getDoctrine()->getManager();
            $data = $em->getRepository('CoyoteSiteBundle:Item')->myfindCodebyId($itemcode[$i]);
            if($data != null)
                $resfinal .= $data[0]['code'];
            else
                $resfinal .= "vide";
            $resfinal .= ";";
            
        }
        return new Response($resfinal);
        */
        $em = $this->getDoctrine()->getManager();
        $itemcode = "item_id;2800200;2800500;2800210;2816890;2800460;2800920;2814550;;2606860;2606890;500158;2610430;2610440;500159;2605520;2605650;2611030;2611020;2612870;2612400;2604590;2604380;2604310;2604550;2604480;2604000;2604470;2604800;;283471;284374;283472;283475;283192;283193;500105;500124;500125;2801060;2801050;2801070;2818380;500613;500614;;;;;280328;500123;;500024;;;;;;;;;;;;;";
        
        $itemcode = explode(";", $itemcode);
        $nbcode = count($itemcode);
        $resfinal = "";
        $i=0;
        //return new Response($itemcode[$i]);
        for($i = 0; $i<$nbcode; $i++)
        {
            $em = $this->getDoctrine()->getManager();
            $data = $em->getRepository('CoyoteSiteBundle:Item')->myfindIdbyCode($itemcode[$i]);
            if($data != null)
                $resfinal .= $data[0]['id'];
            else
                $resfinal .= "vide";
            $resfinal .= ";";
            
        }
        return new Response($resfinal);
    }
    
    function id($code)
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('CoyoteSiteBundle:Item')->myfindIdbyCode($code);
        return $data;
    }
    
    public function addconfigAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $session = new Session();
        $request = Request::createFromGlobals();
        $data = $request->request->all();
        
        $id = $data['cuve'];
        $id1 = $id+'0';
        
        //$config = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->findByLink('U010');
        $commun = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->findLinkCommun();
        return new Response(count($commun));
        /*$cuve = $config->getItem()->getCode();
        $link = $config->getComment();
        $session->set('cuve', $cuve);
        
        $dataconfig = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->findByLink($link,array('id' => 'asc'));
        //$designation
        return $this->render('CoyoteSiteBundle:Config:configsuite.html.twig', array('data' => $dataconfig));*/
    }
    
    public function showAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $session = new Session();
        $request = Request::createFromGlobals();
        $data = $request->request->all();
        
        $id = $data['porte'];
        $config = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->find($id);
        $session->set('porte',$config->getItem()->getCode());
        
        $id = $data['vanne'];
        $config = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->find($id);
        $session->set('vanne',$config->getItem()->getCode());
        
        $id = $data['essieu'];
        $config = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->find($id);
        $session->set('essieu',$config->getItem()->getCode());
        
        $id = $data['roue'];
        $config = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->find($id);
        $session->set('roue',$config->getItem()->getCode());
        
        $id = $data['signal'];
        $config = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->find($id);
        $session->set('eclairage',$config->getItem()->getCode());
        
        $id = $data['suppl'];
        $config = $em->getRepository('CoyoteSiteBundle:ConfiguringTankers')->find($id);
        $session->set('suppcuve',$config->getItem()->getCode());
        
        $datacuve = $em->getRepository('CoyoteSiteBundle:Item')->findByCode($session->get('cuve'));
        $dataporte = $em->getRepository('CoyoteSiteBundle:Item')->findByCode($session->get('porte'));
        $datavanne = $em->getRepository('CoyoteSiteBundle:Item')->findByCode($session->get('vanne'));
        $dataessieu = $em->getRepository('CoyoteSiteBundle:Item')->findByCode($session->get('essieu'));
        $dataroue = $em->getRepository('CoyoteSiteBundle:Item')->findByCode($session->get('roue'));
        $datasignal = $em->getRepository('CoyoteSiteBundle:Item')->findByCode($session->get('eclairage'));
        $datasuppl = $em->getRepository('CoyoteSiteBundle:Item')->findByCode($session->get('suppcuve'));
        
        return $this->render('CoyoteSiteBundle:Config:show.html.twig', 
            array(
                'cuve' => $datacuve, 
                'porte' => $dataporte, 
                'vanne' => $datavanne, 
                'essieu' => $dataessieu,
                'roue' => $dataroue, 
                'signal' => $datasignal, 
                'suppcuve' => $datasuppl, 
                ));
    }
}