<?php

namespace Coyote\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

use Coyote\SiteBundle\Form\ScheduleType;

use Coyote\SiteBundle\Entity\Schedule;
use Coyote\SiteBundle\Entity\Timetable;
use Coyote\SiteBundle\Entity\User;
use Coyote\SiteBundle\Entity\Data;

use Doctrine\ORM\EntityRepository;
use Coyote\SiteBundle\Entity\Holiday;

/**
 * Schedule controller.
 *
 */
class ScheduleController extends Controller
{
    /**
     * Function to display a edit page of Time Attendance User about week.
     * getScheduleUserAction()
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getScheduleUserWeekAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$request = $this->getRequest();
    	$session = $request->getSession();
    
    	$date = $em->getRepository('CoyoteSiteBundle:Timetable')->createDateYearWeek(
    			$session->get('year'), $session->get('week'));
    
    	$data_timetable = $em->getRepository('CoyoteSiteBundle:Timetable')->searchIdDate($date);
    
    	$time = $em->getRepository('CoyoteSiteBundle:Schedule')->timeData(
    			$data_timetable, $this->getUser());
    
    	$duration = $em->getRepository('CoyoteSiteBundle:Schedule')->initGetSchedule(
    			$time, $data_timetable, $session);
    
    	return $this->render('CoyoteSiteBundle:Schedule:postschedule.html.twig',
    			array('data_timetable' => $data_timetable, 'time' => $time, 'duration' => $duration));
    }

    /**
     * Function to return to the previous week, set week and period into session.
     * weeklessAction()
     * @access public
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function postWeekLessAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $request->getSession();
        $em->getRepository("CoyoteSiteBundle:Schedule")->updateWeek("less", $session);
        return $this->redirect($this->generateUrl('schedule_getscheduleuserweek'));
    }

    /**
     * Function to go to the next week, set week and period into session.
     * workmoreAction()
     * @access public
     * @return void
     */
    public function postWeekMoreAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $request->getSession();
        $em->getRepository("CoyoteSiteBundle:Schedule")->updateWeek("more", $session);
        return $this->redirect($this->generateUrl('schedule_getscheduleuserweek'));
    }

    /**
     * Function to save Time Attendance User.
     * postScheduleUserAction()
     * @access public
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function postScheduleUserWeekAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        if ($user == "anon.")
        {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        if ($this->get('security.context')->isGranted('ROLE_TECH'))
        {
            $request = $this->getRequest();
            $session = $request->getSession();
            $doctrine = $this->getDoctrine();
            $em = $doctrine->getManager();
            $request = Request::createFromGlobals();
            $data = $request->request->all();
            $deplacement = null;
            $timetable = null;
            $schedule = null;
            for($i=1;$i<8;$i++)
            {
                if (array_key_exists('deplacement'.$i, $data))
                    $deplacement[$i] = $data['deplacement'.$i];
                if (!array_key_exists('deplacement'.$i, $data))
                    $deplacement[$i] = "";
                $date = $em->getRepository('CoyoteSiteBundle:Timetable')->createDateString($data['date'.$i]);
                $timetable[$i] = $em->getRepository('CoyoteSiteBundle:Timetable')->findByDate($date);
                $schedule[$i] = $em->getRepository('CoyoteSiteBundle:Schedule')->findOneBy(array(
                    'timetable' => $timetable[$i], 'user' => $user
                ));
            }
            $date = $em->getRepository('CoyoteSiteBundle:Timetable')->createDateYearWeek(
            $session->get('year'), $session->get('week'));
            $timetable_ids = $em->getRepository('CoyoteSiteBundle:Timetable')->searchIdDate($date);
            $list_id = "";
            for ($i=1;$i<8;$i++)
            {
                if (empty($schedule[$i]))
                {
                    $timetable_id = $em->getRepository('CoyoteSiteBundle:TimeTable')->findOneById(
                            $timetable_ids[($i-1)]->getId());
                    $schedule[$i] = $em->getRepository('CoyoteSiteBundle:Schedule')->saveSchedule(
                        $user, $timetable_id, $data['debut'.$i], $data['fin'.$i], $data['pause'.$i],
                        $deplacement[$i], $data['absence'.$i], $data['absenceday'.$i], $data['absencetime'.$i],
                        $data['commentaire'.$i]);
                }
                else
                {
                    $schedule[$i] = $em->getRepository('CoyoteSiteBundle:Schedule')->updateSchedule(
                    $schedule[$i], $data['debut'.$i], $data['fin'.$i], $data['pause'.$i], $deplacement[$i],
                    $data['absence'.$i], $data['absenceday'.$i], $data['absencetime'.$i],
                    $data['commentaire'.$i]);
                }
                if ($schedule[$i] != null)
                {
                    $em->persist($schedule[$i]);
                    $list_id .= $i.';';
                }
            }
            $em->flush();
            $tab_id = explode(";", $list_id);
            $index = 0;
            for($i=0;$i<count($tab_id)-1;$i++)
            {
                $index = $tab_id[$i];
                if( $schedule[$index]->getId() != "")
                    $message = 'schedule.flash.save';
                else
                    $message = 'schedule.flash.no_save';
            }
            if (empty($message))
            	$message = 'schedule.flash.locked';
            $this->get('session')->getFlashBag()->set('save_schedule', $message);
            return $this->redirect($this->generateUrl('schedule_getscheduleuserweek'));
        }
        if ($this->get('security.context')->isGranted('ROLE_CADRE'))
        {
            $request = $this->getRequest();
            $session = $request->getSession();
            $doctrine = $this->getDoctrine();
            $em = $doctrine->getManager();
            $request = Request::createFromGlobals();
            $data = $request->request->all();
            $deplacement = null;
            $timetable = null;
            $schedule = null;
            for($i=1;$i<8;$i++)
            {
                if (array_key_exists('deplacement'.$i, $data))
                    $deplacement[$i] = $data['deplacement'.$i];
                if (!array_key_exists('deplacement'.$i, $data))
                    $deplacement[$i] = "";
                $date = $em->getRepository('CoyoteSiteBundle:Timetable')->createDateString($data['date'.$i]);
                $timetable[$i] = $em->getRepository('CoyoteSiteBundle:Timetable')->findByDate($date);
                $schedule[$i] = $em->getRepository('CoyoteSiteBundle:Schedule')->findOneBy(array(
                            'timetable' => $timetable[$i], 'user' => $user));
            }
            $date = $em->getRepository('CoyoteSiteBundle:Timetable')->createDateYearWeek(
            $session->get('year'), $session->get('week'));
            $timetable_ids = $em->getRepository('CoyoteSiteBundle:Timetable')->searchIdDate($date);
            $user = $this->getUser();
            $list_id = "";
            for ($i=1;$i<8;$i++)
            {
                if(empty($schedule[$i]))
                {
                    $timetable_id = $em->getRepository('CoyoteSiteBundle:TimeTable')->findOneById($timetable_ids[($i-1)]->getId());
                    $schedule[$i] = $em->getRepository('CoyoteSiteBundle:Schedule')->saveSchedulefm(
                        $user, $timetable_id, $deplacement[$i], $data['absence'.$i], $data['absenceday'.$i], $data['absencetime'.$i],
                        $data['commentaire'.$i], $data['jour'.$i]);
                }
                else
                {
                    $schedule[$i] = $em->getRepository('CoyoteSiteBundle:Schedule')->updateSchedulefm(
                        $schedule[$i], $deplacement[$i], $data['absence'.$i], $data['absenceday'.$i], $data['absencetime'.$i],
                        $data['commentaire'.$i], floatval($data['jour'.$i]));
                }
                if($schedule[$i] != null)
                {
                    $em->persist($schedule[$i]);
                    $list_id .= $i.';';
                }
            }
            $em->flush();
            $tab_id = explode(";", $list_id);
            $index = 0;
            for($i=0;$i<count($tab_id)-1;$i++)
            {
                $index = $tab_id[$i];
                if( $schedule[$index]->getId() != "")
                    $message = 'schedule.flash.save';
                else
                    $message = 'schedule.flash.no_save';
            }
            $this->get('session')->getFlashBag()->set('save_schedule', $message);
            return $this->redirect($this->generateUrl('schedule_getscheduleuserweek'));
        }
    }

    /**
     * Function to show Time Attendance User about month and year.
     * getScheduleAction()
     * @access public
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function getScheduleUserMonthAction(Request $request)
    {
        $data = new Data();
        
        if ($request->getMethod() == 'GET' && isset($_GET['year']) && isset($_GET['month']))
        {
            $doctrine = $this->getDoctrine();
            $em = $doctrine->getManager();
            $year = $_GET['year'];
            $month = $_GET['month'];
            if (empty($year) && empty($month))
            {
                return $this->redirect($this->generateUrl('schedule_indexshow'));
            }
            else
            {
                if(empty($year) && empty($month))
                    return $this->render('CoyoteSiteBundle:Schedule:indexshow.html.twig');
                $user = $this->getUser();
                $period = $em->getRepository('CoyoteSiteBundle:Schedule')->findPeriod($month, $year);
                $date = $year."-".$month."-%";
                $absenceca = $em->getRepository('CoyoteSiteBundle:Schedule')->absenceMonth($date, $user->getId(), "CA");
                $absencecp = $em->getRepository('CoyoteSiteBundle:Schedule')->absenceMonth($date, $user->getId(), "CP");
                $absencertt = $em->getRepository('CoyoteSiteBundle:Schedule')->absenceMonth($date, $user->getId(), "RTT");
                $absencerttyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "RTT");
                $absencecayear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "CA");
                $absencecpyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "CP");
                if ($this->get('security.context')->isGranted('ROLE_CADRE'))
                {
                    $daymonth = $em->getRepository('CoyoteSiteBundle:Schedule')->findDayMonth($date, $user);
                    $dayyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findDayYear($period, $user);
                    $dataschedule = $em->getRepository('CoyoteSiteBundle:Schedule')->dataScheduleFM($user, $date);
                    return $this->render('CoyoteSiteBundle:Schedule:showfm.html.twig', array(
                        'dataschedule' => $dataschedule,
                        'absencertt' => $absencertt,
                        'absenceca' => $absenceca,
                        'absencecp' => $absencecp,
                        'rttyear' => $absencerttyear,
                        'cpyear' => $absencecpyear,
                        'cayear' => $absencecayear,
                        'dayyear' => $dayyear,
                        'daymonth' => $daymonth,
                        ));
                }
                if ($this->get('security.context')->isGranted('ROLE_TECH'))
                {
                    $data_schedule = $em->getRepository('CoyoteSiteBundle:Schedule')->dataSchedule($user, $date);
                    $timeweek = $em->getRepository('CoyoteSiteBundle:Schedule')->timeWeek($data_schedule);
                    $timemonth = $em->getRepository('CoyoteSiteBundle:Schedule')->findTimeMonth($year.'-'.$month.'-%', $user);
                    $date = '';
                    $day = '';
                    $week = '';
                    for ($i=0;$i<count($data_schedule);$i++)
                    {
                        $day[$i] = $data_schedule[$i]['date']->format('l');
                        $date[$i] = $data_schedule[$i]['date']->format('d/m/Y');
                        $week[$i] = $data_schedule[$i]['date']->format('W');
                    }
                    return $this->render('CoyoteSiteBundle:Schedule:show.html.twig', array(
                        'day' => $day,
                        'date' => $date,
                        'week' => $week,
                        'dataschedule' => $data_schedule,
                        'absenceca' => $absenceca,
                        'absencecp' => $absencecp,
                        'absencertt' => $absencertt,
                        'time' => $timemonth,
                        'rttyear' => $absencerttyear,
                        'cpyear' => $absencecpyear,
                        'cayear' => $absencecayear,
                        'timeweek' => $timeweek,
                        ));
                }
            }
        }
        return $this->render('CoyoteSiteBundle:Schedule:indexshow.html.twig', array('month' => date('n'),
                        'year' => date('Y'), 'tab_mois' => $data->getTabMonth(), 'tab_num_mois' => $data->getTabNumMonth(),
                        'tab_annee' => $data->getTabYear()));
    }

    /**
     * Function to print time attendance by month
     * @access public
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function getScheduleUserPrintMonthAction(Request $request)
    {
        $data = new Data();
        if ($request->getMethod() == 'GET' && isset($_GET['year']) && isset($_GET['month']))
        {
            $doctrine = $this->getDoctrine();
            $em = $doctrine->getManager();
            $year = $_GET['year'];
            $month = $_GET['month'];
            $user = $this->getUser();
            $period = $em->getRepository('CoyoteSiteBundle:Schedule')->findPeriod($month, $year);
            $date = $year."-".$month."-%";
            $absenceca = $em->getRepository('CoyoteSiteBundle:Schedule')->absenceMonth($date, $user->getId(), "CA");
            $absencecp = $em->getRepository('CoyoteSiteBundle:Schedule')->absenceMonth($date, $user->getId(), "CP");
            $absencertt = $em->getRepository('CoyoteSiteBundle:Schedule')->absenceMonth($date, $user->getId(), "RTT");
            $absencerttyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "RTT");
            $absencecayear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "CA");
            $absencecpyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "CP");
            if ($this->get('security.context')->isGranted('ROLE_CADRE'))
            {
                $daymonth = $em->getRepository('CoyoteSiteBundle:Schedule')->findDayMonth($date, $user);
                $dayyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findDayYear($period, $user);
                $dataschedule = $em->getRepository('CoyoteSiteBundle:Schedule')->dataScheduleFM($user, $date);
                $page = $this->render('CoyoteSiteBundle:Schedule:printfm.html.twig', array(
                                'dataschedule' => $dataschedule,
                                'absencertt' => $absencertt,
                                'absenceca' => $absenceca,
                                'absencecp' => $absencecp,
                                'rttyear' => $absencerttyear,
                                'cpyear' => $absencecpyear,
                                'cayear' => $absencecayear,
                                'dayyear' => $dayyear,
                                'daymonth' => $daymonth,
                ));
            }
            if ($this->get('security.context')->isGranted('ROLE_TECH'))
            {
                $data_schedule = $em->getRepository('CoyoteSiteBundle:Schedule')->dataSchedule($user, $date);
                $timeweek = $em->getRepository('CoyoteSiteBundle:Schedule')->timeWeek($data_schedule);
                $timemonth = $em->getRepository('CoyoteSiteBundle:Schedule')->findTimeMonth($year.'-'.$month.'-%', $user);
                $date = '';
                $day = '';
                $week = '';
                for ($i=0;$i<count($data_schedule);$i++)
                {
                    $day[$i] = $data_schedule[$i]['date']->format('l');
                    $date[$i] = $data_schedule[$i]['date']->format('d/m/Y');
                    $week[$i] = $data_schedule[$i]['date']->format('W');
                }
                $page = $this->render('CoyoteSiteBundle:Schedule:print.html.twig', array(
                        'day' => $day,
                        'date' => $date,
                        'week' => $week,
                        'dataschedule' => $data_schedule,
                        'absenceca' => $absenceca,
                        'absencecp' => $absencecp,
                        'absencertt' => $absencertt,
                        'time' => $timemonth,
                        'rttyear' => $absencerttyear,
                        'cpyear' => $absencecpyear,
                        'cayear' => $absencecayear,
                        'timeweek' => $timeweek,));
            }
            $date = date("Ymd");
            $heure = date("His");
            $html = $page->getContent();
            $filename = $user->getName()."_presence".$date."-".$heure.".pdf";
            $html = $page->getContent();
            $html2pdf = new \Html2Pdf_Html2Pdf('P', 'A4', 'fr');
            $html2pdf->pdf->SetDisplayMode('real');
            $html2pdf->writeHTML($html);
            $html2pdf->Output($filename, 'D');
            return new Response('PDF réalisé');
        }
        return $this->render('CoyoteSiteBundle:Schedule:indexprint.html.twig', array('month' => date('n'),
                        'year' => date('Y'), 'tab_mois' => $data->getTabMonth(), 'tab_num_mois' => $data->getTabNumMonth(),
                        'tab_annee' => $data->getTabYear()));
    }

    /*****************************************************************/
    /***********************Fonctions En cours************************/
    /*****************************************************************/

    /**
     * showovertimeAction function.
     * function shows Overtime
     * @access public
     * @return void
     */
    public function showovertimeAction()
    {
        if ($this->get('security.context')->isGranted('ROLE_TECH'))
        {
        	$em = $this->getDoctrine()->getManager();
        	$holiday = $em->getRepository('CoyoteSiteBundle:Holiday')->findOneByUser($this->getUser());
        	$working_time_week = 0;
        	if ($holiday != null)
        		$working_time_week = $holiday->getHs();
            $overtime = $em->getRepository('CoyoteSiteBundle:Schedule')->countOvertime($this->getUser(), $working_time_week);
            return $this->render('CoyoteSiteBundle:Schedule:showovertime.html.twig', array('overtime' => $overtime));
        }
    }

    public function postSchedulesLockedAction()
    {
    	$request = $this->getRequest();
    	if ($request->getMethod() == 'POST' && isset($_POST['date']) )
    	{
    		$em = $this->getDoctrine()->getManager();
    		$date = new \DateTime($_POST['date']);
    		$schedules_lock = $em->getRepository("CoyoteSiteBundle:Schedule")->postScheduleLocked($date, $this->getUser());
    		if ($schedules_lock == "OK")
    		{
    			$message = 'schedule.flash.schedules_locked';
    		}
    		$this->get('session')->getFlashBag()->set('schedules_locked', $message);
    		return $this->redirect($this->generateUrl('schedule_postschedules_locked'));
    	}
    	else 
    	{
    		return $this->render('CoyoteSiteBundle:Schedule:scheduleslocked.html.twig');
    	}
    }
    
    
    
    /*****************************************************************/
    /***********************Fonctions Erronées************************/
    /*****************************************************************/

    /**
     * affichage de la page avant d'obtenir un fichier pdf de l'année.
     * show page selection period to print PDF
     *
     * @access public
     * @return void
     */
    /*public function indexprintyearAction()
    {
        $data = new Data();
        $date = date('Y-m-d');
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $period = $em->getRepository('CoyoteSiteBundle:Timetable')->findPeriodByDate($date);
        return $this->render('CoyoteSiteBundle:Schedule:indexprintyear.html.twig', array(
            'period' => $period, 'tab_period' => $data->getTabPeriod()));
    }*/


    /**
     * génération d'un fichier pdf de l'année de l'user.
     * export data time attendance in PDF by working period
     *
     * @access public
     * @return void
     */
    /*public function printyearAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $period = $_GET['pay_period'];
        if (empty($period))
        {
            return $this->redirect($this->generateUrl('schedule_indexprintyear'));
        }
        else
        {
            return new Response("En mainteance");
            if(empty($period))
                return $this->render('CoyoteSiteBundle:Schedule:indexprint.html.twig');
            $absencerttyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $this->getUser(), "RTT");
            $absencecayear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $this->getUser(), "CA");
            $absencecpyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $this->getUser(), "CP");
            if ($this->get('security.context')->isGranted('ROLE_CADRE'))
            {
                $dayyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findDayYear($period, $this->getUser());
                $dataschedule = $em->getRepository('CoyoteSiteBundle:Schedule')->dataScheduleFMYear($this->getUser(), $period);
                $page = $this->render('CoyoteSiteBundle:Schedule:printfmpayperiod.html.twig', array(
                    'dataschedule' => $dataschedule,
                    'rttyear' => $absencerttyear,
                    'cpyear' => $absencecpyear,
                    'cayear' => $absencecayear,
                    'dayyear' => $dayyear,
                    ));
            }
            if ($this->get('security.context')->isGranted('ROLE_TECH'))
            {
                $dataschedule = $em->getRepository('CoyoteSiteBundle:Schedule')->dataScheduleYear($this->getUser(), $period);
                $index = 0;
                $value = 0;
                $timeweek = '';
                $value_max = count($dataschedule)-1;
                for($i=0;$i<count($dataschedule);$i++)
                {
                    if ($dataschedule[$i]['day'] != "dimanche")
                        $value += $em->getRepository('CoyoteSiteBundle:Schedule')->calculTime(
                            $dataschedule[$i]['working_time']);
                    if ($dataschedule[$i]['day'] == "dimanche" and $i != $value_max)
                    {
                        $timeweek[$index] = $em->getRepository('CoyoteSiteBundle:Schedule')->formatTime($value);
                        $value = 0;
                        $index++;
                    }
                    if ($i == $value_max)
                    {
                        $timeweek[$index] = $em->getRepository('CoyoteSiteBundle:Schedule')->formatTime($value);
                    }
                }
                $page = $this->render('CoyoteSiteBundle:Schedule:printpayperiod.html.twig', array(
                    'dataschedule' => $dataschedule,
                    'rttyear' => $absencerttyear,
                    'cpyear' => $absencecpyear,
                    'cayear' => $absencecayear,
                    'timeweek' => $timeweek,
                    ));
            }
            $date = date("Ymd");
            $heure = date("His");
            $filename = $this->getUser()->getName()."_presence".$date."-".$heure.".pdf";
            $html = $page->getContent();
            $html2pdf = new \Html2Pdf_Html2Pdf('P', 'A4', 'fr');
            $html2pdf->pdf->SetDisplayMode('real');
            $html2pdf->writeHTML($html);
            $html2pdf->Output($filename, 'D');
            return new Response('PDF réalisé');
        }
    }*/


    /**
     * indexexportprintyearAction function.
     * Affichage des choix de période avant impression PDF
     * show page selection period to print PDF
     *
     * @access public
     * @return void
     */
    /*public function indexexportprintyearAction()
    {
        return new Response("En mainteance");
        $date = date('Y-m-d');
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $period = $em->getRepository('CoyoteSiteBundle:Timetable')->findPeriodByDate($date);
        $data = new Data();
        return $this->render('CoyoteSiteBundle:Schedule:indexexportprintyear.html.twig', array(
            'period' => $period, 'tab_period' => $data->getTabPeriod()));
    }*/


    /**
     * exportprintyearAction function.
     * export all data time attendance in PDF by working period
     *
     * @access public
     * @return void
     */
    /*public function exportprintyearAction()
    {
        return new Response("En mainteance");
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $pay_period = $_GET['pay_period'];
        define("pay_period", $pay_period, true);
        $data = new Data();
        $tab_user_id = $data->getTabUserIdSchedulePDF();
        if (empty($pay_period))
        {
            return $this->redirect($this->generateUrl('schedule_indexexportprintyear'));
        }
        else
        {
            if (empty($pay_period))
                return $this->render('CoyoteSiteBundle:Schedule:indexexportprintyear.html.twig');
            foreach($tab_user_id as $datauser)
            {
                $user = $em->getRepository('CoyoteSiteBundle:User')->find($datauser);
                $roles = $user->getRoles();
                $check_role = '';
                $role = '';
                foreach($roles as $datarole)
                {
                    $check_role = $datarole;
                    if ($check_role == "ROLE_CADRE")
                        $role = 'ROLE_CADRE';
                    if ($check_role == "ROLE_TECH")
                        $role = 'ROLE_TECH';
                }
                $absencerttyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear(
                    constant('pay_period'), $user, "RTT");
                $absencecayear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear(
                    constant('pay_period'), $user, "CA");
                $absencecpyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear(
                    constant('pay_period'), $user, "CP");
                if ($role == 'ROLE_CADRE')
                {
                    $dayyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findDayYear(
                        constant('pay_period'), $user);
                    $dataschedule = $em->getRepository('CoyoteSiteBundle:Schedule')->dataScheduleFMYear(
                        $user, constant('pay_period'));
                    $page = $this->render('CoyoteSiteBundle:Schedule:printfmpayperiod.html.twig', array(
                        'dataschedule' => $dataschedule,
                        'rttyear' => $absencerttyear,
                        'cpyear' => $absencecpyear,
                        'cayear' => $absencecayear,
                        'dayyear' => $dayyear,
                        ));
                }
                if ($role == 'ROLE_TECH')
                {
                    $dataschedule = $em->getRepository('CoyoteSiteBundle:Schedule')->dataScheduleYear(
                        $user, constant('pay_period'));
                    $index = 0;
                    $value = 0;
                    $timeweek = '';
                    $value_max = count($dataschedule)-1;
                    for($i=0;$i<count($dataschedule);$i++)
                    {
                        if ($dataschedule[$i]['day'] != "dimanche")
                            $value += $em->getRepository('CoyoteSiteBundle:Schedule')->calculTime(
                                $dataschedule[$i]['working_time']);
                        if ($dataschedule[$i]['day'] == "dimanche" and $i != $value_max)
                        {
                            $timeweek[$index] = $em->getRepository('CoyoteSiteBundle:Schedule')->formatTime($value);
                            $value = 0;
                            $index++;
                        }
                        if ($i == $value_max)
                        {
                            $timeweek[$index] = $em->getRepository('CoyoteSiteBundle:Schedule')->formatTime($value);
                        }
                    }
                    $page = $this->render('CoyoteSiteBundle:Schedule:printpayperiod.html.twig', array(
                        'dataschedule' => $dataschedule,
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
                $pay_period = explode("/", constant('pay_period'));
                $pay_period = $pay_period[0].'-'.$pay_period[1];
                $file_name = $pay_period.'_'.$user->getName().'.pdf';
                $html2pdf->pdf->Output('./presence/'.$file_name,"F");
            }
            return $this->redirect($this->generateUrl('schedule_indexexportprintyear'));
        }
    }*/

    /**
     * Function that redirect to getScheduleUserAction().
     * indexAction()
     * @access public
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    /*public function indexAction()
    {
        if($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED') == false)
        {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        return $this->redirect($this->generateUrl('schedule_getscheduleuser'));
    }*/
}
