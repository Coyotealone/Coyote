<?php

namespace Coyote\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Compenent\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Session\Session;

use Coyote\SiteBundle\Form\UserType;
use Coyote\SiteBundle\Form\TimeType;
use Coyote\SiteBundle\Form\ScheduleType;

use Coyote\SiteBundle\Entity\Schedule;
use Coyote\SiteBundle\Entity\Timetable;
use Coyote\SiteBundle\Entity\User;

use Doctrine\ORM\EntityRepository;

/**
 * Main controller.
 *
 */
class TimeController extends Controller
{   
    public function indexAction()
    {
        $session = new Session();
        $user = $this->get('security.context')->getToken()->getUser();
        if($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED') == false) 
        {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        //if($user == "anon.")
        //    return $this->redirect($this->generateUrl('fos_user_security_login'));
        if($this->get('security.context')->isGranted('ROLE_TECH'))
            return $this->redirect($this->generateUrl('coyote_time_user'));
        if($this->get('security.context')->isGranted('ROLE_CADRE'))
            return $this->redirect($this->generateUrl('coyote_time_framework'));
        else
            return $this->render('CoyoteSiteBundle:Time:index.html.twig');
    }


    public function userAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $session = new Session();
        if($user == "anon.")
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        else
        {
            $date = $em->getRepository('CoyoteSiteBundle:Timetable')->findBy(array('no_week' => $session->get('no_week'),'year' => $session->get('year'),));
            $time = $em->getRepository('CoyoteSiteBundle:Schedule')->findBy(array('timetable' => $date, 'user' => $session->get('userid')));
            
            /*$jour = "lundi;mardi;mercredi;jeudi;vendredi;samedi;dimanche";
            $jour = explode(';', $jour);
            
            return $this->render('CoyoteSiteBundle:Time:test.html.twig', array('data' => $date, 'jour' => $jour));*/
            
            
            
            //$date = $em->getRepository('CoyoteSiteBundle:Timetable')->myFindDate($session->get('no_week'), $session->get('year'));
            //$time = $em->getRepository('CoyoteSiteBundle:Timetable')->myFindTime($session->get('no_week'), $session->get('year'), $session->get('userid'));
            
            if(count($time) == 0)
            {
                $session->set('id_lundi', '');
                $session->set('id_mardi', '');
                $session->set('id_mercredi', '');
                $session->set('id_jeudi', '');
                $session->set('id_vendredi', '');
                $session->set('id_samedi', '');
                $session->set('id_dimanche', '');
                return $this->render('CoyoteSiteBundle:Time:user_empty.html.twig', array('date' => $date));
            }
            else
            {
                $id = $em->getRepository('CoyoteSiteBundle:Timetable')->myFindScheduleId($session->get('no_week'), $session->get('year'), $session->get('userid'));
                $timetable_id = $em->getRepository('CoyoteSiteBundle:Timetable')->myFindTimetableId($session->get('no_week'), $session->get('year'));
                
                $session->set('id_lundi', $id[0]['id']);
                $session->set('id_mardi', $id[1]['id']);
                $session->set('id_mercredi', $id[2]['id']);
                $session->set('id_jeudi', $id[3]['id']);
                $session->set('id_vendredi', $id[4]['id']);
                $session->set('id_samedi', $id[5]['id']);
                $session->set('id_dimanche', $id[6]['id']);
                return $this->render('CoyoteSiteBundle:Time:user.html.twig', array('date' => $date, 'time' => $time, 'id' => $id, 'timetable' => $timetable_id));
            }
        }
    }

    public function frameworkAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $session = new Session();
        if($user == "anon.")
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        else
        {
            //$date = $em->getRepository('CoyoteSiteBundle:Timetable')->myFindDate($session->get('no_week'), $session->get('year'));
            //$time = $em->getRepository('CoyoteSiteBundle:Timetable')->myFindTime($session->get('no_week'), $session->get('year'), $session->get('userid'));
            
            //$date = $em->getRepository('CoyoteSiteBundle:Timetable')->findBy(array('no_week' => 28,'year' => 2014,));
            //$time = $em->getRepository('CoyoteSiteBundle:Schedule')->findBy(array('timetable' => $date, 'user' => 15));
            
            
            $date = $em->getRepository('CoyoteSiteBundle:Timetable')->findBy(array('no_week' => $session->get('no_week'),'year' => $session->get('year'),));
            $time = $em->getRepository('CoyoteSiteBundle:Schedule')->findBy(array('timetable' => $date, 'user' => $session->get('userid')));
            
            
            if(count($time) == 0)
            {
                //return $this->render('CoyoteSiteBundle:Time:test.html.twig', array('date' => $date));
                //return new Response('vide');
                $session->set('id_lundi', '');
                $session->set('id_mardi', '');
                $session->set('id_mercredi', '');
                $session->set('id_jeudi', '');
                $session->set('id_vendredi', '');
                $session->set('id_samedi', '');
                $session->set('id_dimanche', '');
                return $this->render('CoyoteSiteBundle:Time:framework_empty.html.twig', array('date' => $date));
            }
            else
            {
                //$id = $em->getRepository('CoyoteSiteBundle:Timetable')->myFindScheduleId(28, 2014, 15);
                //$timetable_id = $em->getRepository('CoyoteSiteBundle:Timetable')->myFindTimetableId(28, 2014);
                
                $id = $em->getRepository('CoyoteSiteBundle:Timetable')->myFindScheduleId($session->get('no_week'), $session->get('year'), $session->get('userid'));
                $timetable_id = $em->getRepository('CoyoteSiteBundle:Timetable')->myFindTimetableId($session->get('no_week'), $session->get('year'));
                
                $session->set('id_lundi', $id[0]['id']);
                $session->set('id_mardi', $id[1]['id']);
                $session->set('id_mercredi', $id[2]['id']);
                $session->set('id_jeudi', $id[3]['id']);
                $session->set('id_vendredi', $id[4]['id']);
                $session->set('id_samedi', $id[5]['id']);
                $session->set('id_dimanche', $id[6]['id']);
                return $this->render('CoyoteSiteBundle:Time:framework.html.twig', array('date' => $date, 'time' => $time, 'id' => $id, 'timetable' => $timetable_id));
            }
        
        } 
    }
    
    public function worklessAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = new Session();
        //$session->start();
        $no_week = $session->get('no_week');
        $year = $session->get('year');
        if($no_week == 1)
        {
            $no_week = 52;
            $year--;
        }
        else
            $no_week--;
        $session->set('no_week', $no_week);
        $session->set('year', $year);
        return $this->redirect($this->generateUrl('coyote_time_user'));
    }
    
    public function workmoreAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = new Session();
        //$session->start();
        $no_week = $session->get('no_week');
        $year = $session->get('year');
        if($no_week == 52)
        {
            $no_week = 1;
            $year++;
        }
        else
            $no_week++;
        $session->set('no_week', $no_week);
        $session->set('year', $year);
        
        $date = $em->getRepository('CoyoteSiteBundle:Timetable')->findBy(array('no_week' => $session->get('no_week'),'year' => $session->get('year'),));
        //$date = $em->getRepository('CoyoteSiteBundle:Timetable')->myFindDate($session->get('no_week'), $session->get('year'));
        
        return $this->redirect($this->generateUrl('coyote_time_user'));
    }

    public function worklessfmAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = new Session();
        //$session->start();
        $no_week = $session->get('no_week');
        $year = $session->get('year');
        if($no_week == 1)
        {
            $no_week = 52;
            $year--;
        }
        else
            $no_week--;
        $session->set('no_week', $no_week);
        $session->set('year', $year);
        return $this->redirect($this->generateUrl('coyote_time_framework'));
    }
    
    public function workmorefmAction()
    {
        $em = $this->getDoctrine()->getManager();
        $session = new Session();
        //$session->start();
        $no_week = $session->get('no_week');
        $year = $session->get('year');
        if($no_week == 52)
        {
            $no_week = 1;
            $year++;
        }
        else
            $no_week++;
        $session->set('no_week', $no_week);
        $session->set('year', $year);
        
        $date = $em->getRepository('CoyoteSiteBundle:Timetable')->myFindDate($session->get('no_week'), $session->get('year'));
        
        return $this->redirect($this->generateUrl('coyote_time_framework'));
    }
    
    public function savetimeAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        if($user == "anon.")
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        else
        {
            $session = new Session();
            
            $doctrine = $this->getDoctrine();
            $em = $doctrine->getManager();
            
            $request = Request::createFromGlobals();
            $data = $request->request->all();
            
            $schedulelundi = $em->getRepository('CoyoteSiteBundle:Schedule')->find($session->get('id_lundi'));
            $schedulemardi = $em->getRepository('CoyoteSiteBundle:Schedule')->find($session->get('id_mardi'));
            $schedulemercredi = $em->getRepository('CoyoteSiteBundle:Schedule')->find($session->get('id_mercredi'));
            $schedulejeudi = $em->getRepository('CoyoteSiteBundle:Schedule')->find($session->get('id_jeudi'));
            $schedulevendredi = $em->getRepository('CoyoteSiteBundle:Schedule')->find($session->get('id_vendredi'));
            $schedulesamedi = $em->getRepository('CoyoteSiteBundle:Schedule')->find($session->get('id_samedi'));
            $scheduledimanche = $em->getRepository('CoyoteSiteBundle:Schedule')->find($session->get('id_dimanche'));
            
            $timetable_id = $em->getRepository('CoyoteSiteBundle:Timetable')->myFindTimetableId($session->get('no_week'), $session->get('year'));
            $id = $em->getRepository('CoyoteSiteBundle:Timetable')->myFindScheduleId($session->get('no_week'), $session->get('year'), $session->get('userid'));
            
            $user = $em->getRepository('CoyoteSiteBundle:User')->find($session->get('userid'));
            
            $timetable = new timetable();
            
            if($schedulelundi === null)
            {
                $timestamp = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_id[0]['id']);
                
                $schedulelundi = new schedule();
                $schedulelundi->setUser($user);
                $schedulelundi->setTimetable($timestamp);
                
                $debutlundi = $data['debutlundi'];
                if($debutlundi == '')
                    $debutlundi = '0:00';
                $schedulelundi->setStart($debutlundi);
                $finlundi = $data['finlundi'];
                if($finlundi == '')
                    $finlundi = '0:00';
                $schedulelundi->setEnd($finlundi);
                $pauselundi = $data['pauselundi'];
                if($pauselundi == '')
                    $pauselundi = '0:00';
                $schedulelundi->setBreak($pauselundi);
                            
                $working_time_day = $timetable->working_time_day($debutlundi, $finlundi, $pauselundi);
                $schedulelundi->setWorkingTime($working_time_day);
                $working_hours_day = $timetable->working_hours_day($working_time_day);
                $schedulelundi->setWorkingHours($working_hours_day);
    
                $schedulelundi->setTravel($data['deplacementlundi']);
                $schedulelundi->setAbsence($data['absencelundi']);
                $schedulelundi->setComment($data['commentairelundi']);
            }
            if($schedulemardi === null)
            {
                $timestamp = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_id[1]['id']);
                
                $schedulemardi = new schedule();
                $schedulemardi->setUser($user);
                $schedulemardi->setTimetable($timestamp);
                
                $debutmardi = $data['debutmardi'];
                if($debutmardi == '')
                    $debutmardi = '0:00';
                $schedulemardi->setStart($debutmardi);
                $finmardi = $data['finmardi'];
                if($finmardi == '')
                    $finmardi = '0:00';
                $schedulemardi->setEnd($finmardi);
                $pausemardi = $data['pausemardi'];
                if($pausemardi == '')
                    $pausemardi = '0:00';
                $schedulemardi->setBreak($pausemardi);
                
                $working_time_day = $timetable->working_time_day($debutmardi, $finmardi, $pausemardi);
                $schedulemardi->setWorkingTime($working_time_day);
                $working_hours_day = $timetable->working_hours_day($working_time_day);
                $schedulemardi->setWorkingHours($working_hours_day);
    
                $schedulemardi->setTravel($data['deplacementmardi']);
                $schedulemardi->setAbsence($data['absencemardi']);
                $schedulemardi->setComment($data['commentairemardi']);
            }
            if($schedulemercredi === null)
            {
                $timestamp = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_id[2]['id']);
                
                $schedulemercredi = new schedule();
                $schedulemercredi->setUser($user);
                $schedulemercredi->setTimetable($timestamp);
                
                $debutmercredi = $data['debutmercredi'];
                if($debutmercredi == '')
                    $debutmercredi = '0:00';
                $schedulemercredi->setStart($debutmercredi);
                $finmercredi = $data['finmercredi'];
                if($finmercredi == '')
                    $finmercredi = '0:00';
                $schedulemercredi->setEnd($finmercredi);
                $pausemercredi = $data['pausemercredi'];
                if($pausemercredi == '')
                    $pausemercredi = '0:00';
                $schedulemercredi->setBreak($pausemercredi);
    
                $working_time_day = $timetable->working_time_day($debutmercredi, $finmercredi, $pausemercredi);
                $schedulemercredi->setWorkingTime($working_time_day);
                $working_hours_day = $timetable->working_hours_day($working_time_day);
                $schedulemercredi->setWorkingHours($working_hours_day);
                
                $schedulemercredi->setTravel($data['deplacementmercredi']);
                $schedulemercredi->setAbsence($data['absencemercredi']);
                $schedulemercredi->setComment($data['commentairemercredi']);
            }
            if($schedulejeudi === null)
            {
                $timestamp = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_id[3]['id']);
                
                $schedulejeudi = new schedule();
                $schedulejeudi->setUser($user);
                $schedulejeudi->setTimetable($timestamp);
                
                $debutjeudi = $data['debutjeudi'];
                if($debutjeudi == '')
                    $debutjeudi = '0:00';
                $schedulejeudi->setStart($debutjeudi);
                $finjeudi = $data['finjeudi'];
                if($finjeudi == '')
                    $finjeudi = '0:00';
                $schedulejeudi->setEnd($finjeudi);
                $pausejeudi = $data['pausejeudi'];
                if($pausejeudi == '')
                    $pausejeudi = '0:00';
                $schedulejeudi->setBreak($pausejeudi);
    
                $working_time_day = $timetable->working_time_day($debutjeudi, $finjeudi, $pausejeudi);
                $schedulejeudi->setWorkingTime($working_time_day);
                $working_hours_day = $timetable->working_hours_day($working_time_day);
                $schedulejeudi->setWorkingHours($working_hours_day);
    
                $schedulejeudi->setTravel($data['deplacementjeudi']);
                $schedulejeudi->setAbsence($data['absencejeudi']);
                $schedulejeudi->setComment($data['commentairejeudi']);
            }
            if($schedulevendredi === null)
            {
                $timestamp = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_id[4]['id']);
                
                $schedulevendredi = new schedule();
                $schedulevendredi->setUser($user);
                $schedulevendredi->setTimetable($timestamp);
                
                $debutvendredi = $data['debutvendredi'];
                if($debutvendredi == '')
                    $debutvendredi = '0:00';
                $schedulevendredi->setStart($debutvendredi);
                $finvendredi = $data['finvendredi'];
                if($finvendredi == '')
                    $finvendredi = '0:00';
                $schedulevendredi->setEnd($finvendredi);
                $pausevendredi = $data['pausevendredi'];
                if($pausevendredi == '')
                    $pausevendredi = '0:00';
                $schedulevendredi->setBreak($pausevendredi);
    
                $working_time_day = $timetable->working_time_day($debutvendredi, $finvendredi, $pausevendredi);
                $schedulevendredi->setWorkingTime($working_time_day);
                $working_hours_day = $timetable->working_hours_day($working_time_day);
                $schedulevendredi->setWorkingHours($working_hours_day);
    
                $schedulevendredi->setTravel($data['deplacementvendredi']);
                $schedulevendredi->setAbsence($data['absencevendredi']);
                $schedulevendredi->setComment($data['commentairevendredi']);
            }
            if($schedulesamedi === null)
            {
                $timestamp = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_id[5]['id']);
                
                $schedulesamedi = new schedule();
                $schedulesamedi->setUser($user);
                $schedulesamedi->setTimetable($timestamp);
                
                $debutsamedi = $data['debutsamedi'];
                if($debutsamedi == '')
                    $debutsamedi = '0:00';
                $schedulesamedi->setStart($debutsamedi);
                $finsamedi = $data['finsamedi'];
                if($finsamedi == '')
                    $finsamedi = '0:00';
                $schedulesamedi->setEnd($finsamedi);
                $pausesamedi = $data['pausesamedi'];
                if($pausesamedi == '')
                    $pausesamedi = '0:00';
                $schedulesamedi->setBreak($pausesamedi);
    
                $working_time_day = $timetable->working_time_day($debutsamedi, $finsamedi, $pausesamedi);
                $schedulesamedi->setWorkingTime($working_time_day);
                $working_hours_day = $timetable->working_hours_day($working_time_day);
                $schedulesamedi->setWorkingHours($working_hours_day);
    
                $schedulesamedi->setTravel($data['deplacementsamedi']);
                $schedulesamedi->setAbsence($data['absencesamedi']);
                $schedulesamedi->setComment($data['commentairesamedi']);
            }
            if($scheduledimanche === null)
            {
                $timestamp = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_id[6]['id']);
                
                $scheduledimanche = new schedule();
                $scheduledimanche->setUser($user);
                $scheduledimanche->setTimetable($timestamp);
                
                $debutdimanche = $data['debutdimanche'];
                if($debutdimanche == '')
                    $debutdimanche = '0:00';
                $scheduledimanche->setStart($debutdimanche);
                $findimanche = $data['findimanche'];
                if($findimanche == '')
                    $findimanche = '0:00';
                $scheduledimanche->setEnd($findimanche);
                $pausedimanche = $data['pausedimanche'];
                if($pausedimanche == '')
                    $pausedimanche = '0:00';
                $scheduledimanche->setBreak($pausedimanche);
    
                $working_time_day = $timetable->working_time_day($debutdimanche, $findimanche, $pausedimanche);
                $scheduledimanche->setWorkingTime($working_time_day);
                $working_hours_day = $timetable->working_hours_day($working_time_day);
                $scheduledimanche->setWorkingHours($working_hours_day);
    
                $scheduledimanche->setTravel($data['deplacementdimanche']);
                $scheduledimanche->setAbsence($data['absencedimanche']);
                $scheduledimanche->setComment($data['commentairedimanche']);
            }
            else
            {
                $schedulelundi->setStart($data['debutlundi']);
                $schedulelundi->setEnd($data['finlundi']);
                $schedulelundi->setBreak($data['pauselundi']);
                $working_time_day = $timetable->working_time_day($data['debutlundi'], $data['finlundi'], $data['pauselundi']);
                $schedulelundi->setWorkingTime($working_time_day);
                $working_hours_day = $timetable->working_hours_day($working_time_day);
                $schedulelundi->setWorkingHours($working_hours_day);
                $schedulelundi->setTravel($data['deplacementlundi']);
                $schedulelundi->setAbsence($data['absencelundi']);
                $schedulelundi->setComment($data['commentairelundi']);
                
                $schedulemardi->setStart($data['debutmardi']);
                $schedulemardi->setEnd($data['finmardi']);
                $schedulemardi->setBreak($data['pausemardi']);
                $working_time_day = $timetable->working_time_day($data['debutmardi'], $data['finmardi'], $data['pausemardi']);
                $schedulemardi->setWorkingTime($working_time_day);
                $working_hours_day = $timetable->working_hours_day($working_time_day);
                $schedulemardi->setWorkingHours($working_hours_day);
                $schedulemardi->setTravel($data['deplacementmardi']);
                $schedulemardi->setAbsence($data['absencemardi']);
                $schedulemardi->setComment($data['commentairemardi']);
                
                $schedulemercredi->setStart($data['debutmercredi']);
                $schedulemercredi->setEnd($data['finmercredi']);
                $schedulemercredi->setBreak($data['pausemercredi']);
                $working_time_day = $timetable->working_time_day($data['debutmercredi'], $data['finmercredi'], $data['pausemercredi']);
                $schedulemercredi->setWorkingTime($working_time_day);
                $working_hours_day = $timetable->working_hours_day($working_time_day);
                $schedulemercredi->setWorkingHours($working_hours_day);
                $schedulemercredi->setTravel($data['deplacementmercredi']);
                $schedulemercredi->setAbsence($data['absencemercredi']);
                $schedulemercredi->setComment($data['commentairemercredi']);
            
                $schedulejeudi->setStart($data['debutjeudi']);
                $schedulejeudi->setEnd($data['finjeudi']);
                $schedulejeudi->setBreak($data['pausejeudi']);
                $working_time_day = $timetable->working_time_day($data['debutjeudi'], $data['finjeudi'], $data['pausejeudi']);
                $schedulejeudi->setWorkingTime($working_time_day);
                $working_hours_day = $timetable->working_hours_day($working_time_day);
                $schedulejeudi->setWorkingHours($working_hours_day);
                $schedulejeudi->setTravel($data['deplacementjeudi']);
                $schedulejeudi->setAbsence($data['absencejeudi']);
                $schedulejeudi->setComment($data['commentairejeudi']);
            
                $schedulevendredi->setStart($data['debutvendredi']);
                $schedulevendredi->setEnd($data['finvendredi']);
                $schedulevendredi->setBreak($data['pausevendredi']);
                $working_time_day = $timetable->working_time_day($data['debutvendredi'], $data['finvendredi'], $data['pausevendredi']);
                $schedulevendredi->setWorkingTime($working_time_day);
                $working_hours_day = $timetable->working_hours_day($working_time_day);
                $schedulevendredi->setWorkingHours($working_hours_day);
                $schedulevendredi->setTravel($data['deplacementvendredi']);
                $schedulevendredi->setAbsence($data['absencevendredi']);
                $schedulevendredi->setComment($data['commentairevendredi']);
            
                $schedulesamedi->setStart($data['debutsamedi']);
                $schedulesamedi->setEnd($data['finsamedi']);
                $schedulesamedi->setBreak($data['pausesamedi']);
                $working_time_day = $timetable->working_time_day($data['debutsamedi'], $data['finsamedi'], $data['pausesamedi']);
                $schedulesamedi->setWorkingTime($working_time_day);
                $working_hours_day = $timetable->working_hours_day($working_time_day);
                $schedulesamedi->setWorkingHours($working_hours_day);
                $schedulesamedi->setTravel($data['deplacementsamedi']);
                $schedulesamedi->setAbsence($data['absencesamedi']);
                $schedulesamedi->setComment($data['commentairesamedi']);
            
                $scheduledimanche->setStart($data['debutdimanche']);
                $scheduledimanche->setEnd($data['findimanche']);
                $scheduledimanche->setBreak($data['pausedimanche']);
                $working_time_day = $timetable->working_time_day($data['debutdimanche'], $data['findimanche'], $data['pausedimanche']);
                $scheduledimanche->setWorkingTime($working_time_day);
                $working_hours_day = $timetable->working_hours_day($working_time_day);
                $scheduledimanche->setWorkingHours($working_hours_day);
                $scheduledimanche->setTravel($data['deplacementdimanche']);
                $scheduledimanche->setAbsence($data['absencedimanche']);
                $scheduledimanche->setComment($data['commentairedimanche']);
                
                
                
            }
            
            $em->persist($schedulelundi);
            $em->persist($schedulemardi);
            $em->persist($schedulemercredi);
            $em->persist($schedulejeudi);
            $em->persist($schedulevendredi);
            $em->persist($schedulesamedi);
            $em->persist($scheduledimanche);
            $em->flush();
            
            $schedulelundi_id = $schedulelundi->getId();
            $schedulemardi_id = $schedulemardi->getId();
            $schedulemercredi_id = $schedulemercredi->getId();
            $schedulejeudi_id = $schedulejeudi->getId();
            $schedulevendredi_id = $schedulevendredi->getId();
            $schedulesamedi_id = $schedulesamedi->getId();
            $scheduledimanche_id = $scheduledimanche->getId();
            
            if(empty($schedulelundi_id) && empty($schedulemerdi_id) && empty($schedulemercredi_id) && empty($schedulejeudi_id) && empty($schedulevendredi_id)
                && empty($schedulesamedi_id) && empty($scheduledimanche_id))
                $message = "Une erreur s'est produite !";
            else
                $message = "Enregistrement terminé";
                
            $this->get('session')->getFlashBag()->set('save', $message);
            
            
            return $this->redirect($this->generateUrl('coyote_time_user'));
        }
    }
    
    public function savetimefmAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        if($user == "anon.")
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        else
        {
            $session = new Session();
            
            $doctrine = $this->getDoctrine();
            $em = $doctrine->getManager();
            
            $request = Request::createFromGlobals();
            $data = $request->request->all();
            
            $schedulelundi = $em->getRepository('CoyoteSiteBundle:Schedule')->find($session->get('id_lundi'));
            $schedulemardi = $em->getRepository('CoyoteSiteBundle:Schedule')->find($session->get('id_mardi'));
            $schedulemercredi = $em->getRepository('CoyoteSiteBundle:Schedule')->find($session->get('id_mercredi'));
            $schedulejeudi = $em->getRepository('CoyoteSiteBundle:Schedule')->find($session->get('id_jeudi'));
            $schedulevendredi = $em->getRepository('CoyoteSiteBundle:Schedule')->find($session->get('id_vendredi'));
            $schedulesamedi = $em->getRepository('CoyoteSiteBundle:Schedule')->find($session->get('id_samedi'));
            $scheduledimanche = $em->getRepository('CoyoteSiteBundle:Schedule')->find($session->get('id_dimanche'));
            
            $timetable_id = $em->getRepository('CoyoteSiteBundle:Timetable')->myFindTimetableId($session->get('no_week'), $session->get('year'));
            $id = $em->getRepository('CoyoteSiteBundle:Timetable')->myFindScheduleId($session->get('no_week'), $session->get('year'), $session->get('userid'));
            
            $user = $em->getRepository('CoyoteSiteBundle:User')->find($session->get('userid'));
            
            $timetable = new timetable();
            
            if($schedulelundi === null)
            {
                $timestamp = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_id[0]['id']);
                
                $schedulelundi = new schedule();
                $schedulelundi->setStart("0:00");
                $schedulelundi->setEnd("0:00");
                $schedulelundi->setBreak("0:00");
                $schedulelundi->setWorkingTime("0:00");
                $schedulelundi->setUser($user);
                $schedulelundi->setTimetable($timestamp);
                $jour = $data['jourlundi'];
                $schedulelundi->setWorkingHours($jour);
                $schedulelundi->setTravel($data['deplacementlundi']);
                $schedulelundi->setAbsence($data['absencelundi']);
                $schedulelundi->setComment($data['commentairelundi']);
            }
            if($schedulemardi === null)
            {
                $timestamp = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_id[1]['id']);
                
                $schedulemardi = new schedule();
                $schedulemardi->setStart("0:00");
                $schedulemardi->setEnd("0:00");
                $schedulemardi->setBreak("0:00");
                $schedulemardi->setWorkingTime("0:00");
                $schedulemardi->setUser($user);
                $schedulemardi->setTimetable($timestamp);
                $jour = $data['jourmardi'];
                $schedulemardi->setWorkingHours($jour);
                $schedulemardi->setTravel($data['deplacementmardi']);
                $schedulemardi->setAbsence($data['absencemardi']);
                $schedulemardi->setComment($data['commentairemardi']);
            }
            if($schedulemercredi === null)
            {
                $timestamp = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_id[2]['id']);
                
                $schedulemercredi = new schedule();
                $schedulemercredi->setStart("0:00");
                $schedulemercredi->setEnd("0:00");
                $schedulemercredi->setBreak("0:00");
                $schedulemercredi->setWorkingTime("0:00");
                $schedulemercredi->setUser($user);
                $schedulemercredi->setTimetable($timestamp);
                $jour = $data['jourmercredi'];
                $schedulemercredi->setWorkingHours($jour);            
                $schedulemercredi->setTravel($data['deplacementmercredi']);
                $schedulemercredi->setAbsence($data['absencemercredi']);
                $schedulemercredi->setComment($data['commentairemercredi']);
            }
            if($schedulejeudi === null)
            {
                $timestamp = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_id[3]['id']);
                
                $schedulejeudi = new schedule();
                $schedulejeudi->setStart("0:00");
                $schedulejeudi->setEnd("0:00");
                $schedulejeudi->setBreak("0:00");
                $schedulejeudi->setWorkingTime("0:00");
                $schedulejeudi->setUser($user);
                $schedulejeudi->setTimetable($timestamp);
                $jour = $data['jourjeudi'];
                $schedulejeudi->setWorkingHours($jour);
                $schedulejeudi->setTravel($data['deplacementjeudi']);
                $schedulejeudi->setAbsence($data['absencejeudi']);
                $schedulejeudi->setComment($data['commentairejeudi']);
            }
            if($schedulevendredi === null)
            {
                $timestamp = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_id[4]['id']);
                
                $schedulevendredi = new schedule();
                $schedulevendredi->setStart("0:00");
                $schedulevendredi->setEnd("0:00");
                $schedulevendredi->setBreak("0:00");
                $schedulevendredi->setWorkingTime("0:00");
                $schedulevendredi->setUser($user);
                $schedulevendredi->setTimetable($timestamp);
                $jour = $data['jourvendredi'];
                $schedulevendredi->setWorkingHours($jour);            
                $schedulevendredi->setTravel($data['deplacementvendredi']);
                $schedulevendredi->setAbsence($data['absencevendredi']);
                $schedulevendredi->setComment($data['commentairevendredi']);
            }
            if($schedulesamedi === null)
            {
                $timestamp = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_id[5]['id']);
                
                $schedulesamedi = new schedule();
                $schedulesamedi->setStart("0:00");
                $schedulesamedi->setEnd("0:00");
                $schedulesamedi->setBreak("0:00");
                $schedulesamedi->setWorkingTime("0:00");
                $schedulesamedi->setUser($user);
                $schedulesamedi->setTimetable($timestamp);
                $jour = $data['joursamedi'];
                $schedulesamedi->setWorkingHours($jour);            
                $schedulesamedi->setTravel($data['deplacementsamedi']);
                $schedulesamedi->setAbsence($data['absencesamedi']);
                $schedulesamedi->setComment($data['commentairesamedi']);
            }
            if($scheduledimanche === null)
            {
                $timestamp = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_id[6]['id']);
                
                $scheduledimanche = new schedule();
                $scheduledimanche->setStart("0:00");
                $scheduledimanche->setEnd("0:00");
                $scheduledimanche->setBreak("0:00");
                $scheduledimanche->setWorkingTime("0:00");
                $scheduledimanche->setUser($user);
                $scheduledimanche->setTimetable($timestamp);
                $jour = $data['jourdimanche'];
                $scheduledimanche->setWorkingHours($jour);
                $scheduledimanche->setTravel($data['deplacementdimanche']);
                $scheduledimanche->setAbsence($data['absencedimanche']);
                $scheduledimanche->setComment($data['commentairedimanche']);
            }
            else
            {
                $schedulelundi->setWorkingHours(floatval($data['jourlundi']));
                $schedulelundi->setTravel($data['deplacementlundi']);
                $schedulelundi->setAbsence($data['absencelundi']);
                $schedulelundi->setComment($data['commentairelundi']);
                
                $schedulemardi->setWorkingHours(floatval($data['jourmardi']));
                $schedulemardi->setTravel($data['deplacementmardi']);
                $schedulemardi->setAbsence($data['absencemardi']);
                $schedulemardi->setComment($data['commentairemardi']);
                
                $schedulemercredi->setWorkingHours(floatval($data['jourmercredi']));
                $schedulemercredi->setTravel($data['deplacementmercredi']);
                $schedulemercredi->setAbsence($data['absencemercredi']);
                $schedulemercredi->setComment($data['commentairemercredi']);
            
                $schedulejeudi->setWorkingHours(floatval($data['jourjeudi']));
                $schedulejeudi->setTravel($data['deplacementjeudi']);
                $schedulejeudi->setAbsence($data['absencejeudi']);
                $schedulejeudi->setComment($data['commentairejeudi']);
            
                $schedulevendredi->setWorkingHours(floatval($data['jourvendredi']));
                $schedulevendredi->setTravel($data['deplacementvendredi']);
                $schedulevendredi->setAbsence($data['absencevendredi']);
                $schedulevendredi->setComment($data['commentairevendredi']);
            
                $schedulesamedi->setWorkingHours(floatval($data['joursamedi']));
                $schedulesamedi->setTravel($data['deplacementsamedi']);
                $schedulesamedi->setAbsence($data['absencesamedi']);
                $schedulesamedi->setComment($data['commentairesamedi']);
            
                $scheduledimanche->setWorkingHours(floatval($data['jourdimanche']));
                $scheduledimanche->setTravel($data['deplacementdimanche']);
                $scheduledimanche->setAbsence($data['absencedimanche']);
                $scheduledimanche->setComment($data['commentairedimanche']);
    
            }
            
            $em->persist($schedulelundi);
            $em->persist($schedulemardi);
            $em->persist($schedulemercredi);
            $em->persist($schedulejeudi);
            $em->persist($schedulevendredi);
            $em->persist($schedulesamedi);
            $em->persist($scheduledimanche);
            $em->flush();
            
            $schedulelundi_id = $schedulelundi->getId();
            $schedulemardi_id = $schedulemardi->getId();
            $schedulemercredi_id = $schedulemercredi->getId();
            $schedulejeudi_id = $schedulejeudi->getId();
            $schedulevendredi_id = $schedulevendredi->getId();
            $schedulesamedi_id = $schedulesamedi->getId();
            $scheduledimanche_id = $scheduledimanche->getId();
            
            if(empty($schedulelundi_id) && empty($schedulemerdi_id) && empty($schedulemercredi_id) && empty($schedulejeudi_id) && empty($schedulevendredi_id)
                && empty($schedulesamedi_id) && empty($scheduledimanche_id))
                $message = "Une erreur s'est produite !";
            else
                $message = "Enregistrement terminé";
                
            $this->get('session')->getFlashBag()->set('save', $message);
            
            //$this->get('session')->getFlashBag()->set('save', 'Enregistrement terminé');
            
            return $this->redirect($this->generateUrl('coyote_time_framework'));
        }
    }
    
    public function indexshowAction()
    {
        return $this->render('CoyoteSiteBundle:Time:indexshow.html.twig');
    }
    
    public function showAction()
    {
        $session = new Session();
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $request = Request::createFromGlobals();
        
        $annee = $_GET['year'];
        $mois = $_GET['month'];
        
        if(empty($annee) && empty($mois))
        {
            return $this->redirect($this->generateUrl('coyote_time_indexshow'));
        }
        else
        {
            if(empty($annee) && empty($mois))
                return $this->render('CoyoteSiteBundle:Time:indexshow.html.twig');
            $user = $em->getRepository('CoyoteSiteBundle:User')->find($session->get('userid'));
            
            $week = $em->getRepository('CoyoteSiteBundle:Schedule')->findNoWeek($mois.'/'.$annee, $user);
            $timeweek = '';
            $i = 0;
            foreach($week as $data)
            {
                $timeoneweek = $em->getRepository('CoyoteSiteBundle:Schedule')->findTimeWeek($user, $data, $annee);
                $timeweek[$i] = $timeoneweek;
                $i++;
            }
            
            
            $data = $em->getRepository('CoyoteSiteBundle:Schedule')->findTime($mois.'/'.$annee, $user);
            $timemonth = $em->getRepository('CoyoteSiteBundle:Schedule')->findTimeMonth($mois.'/'.$annee, $user);
            $absence = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceMonth($mois.'/'.$annee, $user);
            $absencerttyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($mois, $annee, $user, "rtt");
            $absencecayear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($mois, $annee, $user, "ca");
            $absencecpyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($mois, $annee, $user, "cp");
            $absence = explode(';', $absence);
            if($this->get('security.context')->isGranted('ROLE_CADRE'))
                return $this->render('CoyoteSiteBundle:Time:showfm.html.twig', array(
                    'data' => $data,
                    'rtt' => $absence[1],
                    'ca' => $absence[2],
                    'cp' => $absence[3],
                    'rttyear' => $absencerttyear,
                    'cpyear' => $absencecpyear,
                    'cayear' => $absencecayear,
                    ));
            else
                return $this->render('CoyoteSiteBundle:Time:show.html.twig', array(
                    'data' => $data, 
                    'time' => $timemonth, 
                    'rtt' => $absence[1], 
                    'ca' => $absence[2], 
                    'cp' => $absence[3], 
                    'rttyear' => $absencerttyear,
                    'cpyear' => $absencecpyear,
                    'cayear' => $absencecayear,
                    'timeweek' => $timeweek,
                    ));
        }
    }
    
    public function indexprintAction()
    {
        return $this->render('CoyoteSiteBundle:Time:indexprint.html.twig');
    }
    
    public function printAction()
    {
        $session = new Session();
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $request = Request::createFromGlobals();
        
        $annee = $_GET['year'];
        $mois = $_GET['month'];
        //$annee = 2014;
        //$mois = 06;
        
        if(empty($annee) && empty($mois))
        {
            return $this->redirect($this->generateUrl('coyote_time_indexprint'));
        }
        else
        {
            if(empty($annee) && empty($mois))
                return $this->render('CoyoteSiteBundle:Time:indexprint.html.twig');
            $user = $em->getRepository('CoyoteSiteBundle:User')->find($session->get('userid'));
            
            $week = $em->getRepository('CoyoteSiteBundle:Schedule')->findNoWeek($mois.'/'.$annee, $user);
            $timeweek = '';
            $i = 0;
            foreach($week as $data)
            {
                $timeoneweek = $em->getRepository('CoyoteSiteBundle:Schedule')->findTimeWeek($user, $data, $annee);
                $timeweek[$i] = $timeoneweek;
                $i++;
            }
            
            
            $data = $em->getRepository('CoyoteSiteBundle:Schedule')->findTime($mois.'/'.$annee, $user);
            $timemonth = $em->getRepository('CoyoteSiteBundle:Schedule')->findTimeMonth($mois.'/'.$annee, $user);
            $absence = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceMonth($mois.'/'.$annee, $user);
            $absencerttyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($mois, $annee, $user, "RTT");
            $absencecayear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($mois, $annee, $user, "CA");
            $absencecpyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($mois, $annee, $user, "CP");
            $absence = explode(';', $absence);
            if($this->get('security.context')->isGranted('ROLE_CADRE'))
            {
                $page = $this->render('CoyoteSiteBundle:Time:showfm.html.twig', array(
                    'data' => $data,
                    'rtt' => $absence[1],
                    'ca' => $absence[2],
                    'cp' => $absence[3],
                    'rttyear' => $absencerttyear,
                    'cpyear' => $absencecpyear,
                    'cayear' => $absencecayear,
                    ));
            }
            else
            {
                 $page = $this->render('CoyoteSiteBundle:Time:print.html.twig', array(
                    'data' => $data, 
                    'time' => $timemonth, 
                    'rtt' => $absence[1], 
                    'ca' => $absence[2], 
                    'cp' => $absence[3], 
                    'rttyear' => $absencerttyear,
                    'cpyear' => $absencecpyear,
                    'cayear' => $absencecayear,
                    'timeweek' => $timeweek,
                    ));
            }
            
            $html = $page->getContent();
                    
            $html2pdf = new \Html2Pdf_Html2Pdf('P', 'A4', 'fr');
            $html2pdf->pdf->SetDisplayMode('real');
            $html2pdf->writeHTML($html);
            $html2pdf->Output('Presence.pdf', 'D');
            
            return new Response('PDF réalisé');
        }
    }
}

