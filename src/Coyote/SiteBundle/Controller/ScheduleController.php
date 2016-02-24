<?php

namespace Coyote\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Coyote\SiteBundle\Entity\Data;

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

    	$data_timetable = $em->getRepository('CoyoteSiteBundle:Timetable')->findIdDate($date);

    	$time = $em->getRepository('CoyoteSiteBundle:Schedule')->findAllAboutTimetableUser(
    			$data_timetable, $this->getUser());

    	$duration = $em->getRepository('CoyoteSiteBundle:Schedule')->createIdTimetableSession(
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
                if (array_key_exists('travel'.$i, $data))
                    $deplacement[$i] = $data['travel'.$i];
                if (!array_key_exists('travel'.$i, $data))
                    $deplacement[$i] = "";
                $date = $em->getRepository('CoyoteSiteBundle:Timetable')->createDateString($data['date'.$i]);
                $timetable[$i] = $em->getRepository('CoyoteSiteBundle:Timetable')->findByDate($date);
                $schedule[$i] = $em->getRepository('CoyoteSiteBundle:Schedule')->findOneBy(array(
                    'timetable' => $timetable[$i], 'user' => $user
                ));
            }
            $date = $em->getRepository('CoyoteSiteBundle:Timetable')->createDateYearWeek(
            $session->get('year'), $session->get('week'));
            $timetable_ids = $em->getRepository('CoyoteSiteBundle:Timetable')->findIdDate($date);
            $list_id = "";
            for ($i=1;$i<8;$i++)
            {
                if (empty($schedule[$i]))
                {
                    $timetable_id = $em->getRepository('CoyoteSiteBundle:Timetable')->findOneById(
                            $timetable_ids[($i-1)]->getId());
                    $schedule[$i] = $em->getRepository('CoyoteSiteBundle:Schedule')->createSchedule($user,
                    		$timetable_id, $data['start'.$i], $data['end'.$i], $data['break'.$i], $deplacement[$i],
                    		$data['absence'.$i], $data['absenceday'.$i], $data['absencetime'.$i], $data['comment'.$i]);
                }
                else
                {
                    $schedule[$i] = $em->getRepository('CoyoteSiteBundle:Schedule')->updateSchedule(
                    $schedule[$i], $data['start'.$i], $data['end'.$i], $data['break'.$i], $deplacement[$i],
                    $data['absence'.$i], $data['absenceday'.$i], $data['absencetime'.$i],
                    $data['comment'.$i]);
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
                if (array_key_exists('travel'.$i, $data))
                    $deplacement[$i] = $data['travel'.$i];
                if (!array_key_exists('travel'.$i, $data))
                    $deplacement[$i] = "";
                $date = $em->getRepository('CoyoteSiteBundle:Timetable')->createDateString($data['date'.$i]);
                $timetable[$i] = $em->getRepository('CoyoteSiteBundle:Timetable')->findByDate($date);
                $schedule[$i] = $em->getRepository('CoyoteSiteBundle:Schedule')->findOneBy(array(
                            'timetable' => $timetable[$i], 'user' => $user));
            }
            $date = $em->getRepository('CoyoteSiteBundle:Timetable')->createDateYearWeek(
            $session->get('year'), $session->get('week'));
            $timetable_ids = $em->getRepository('CoyoteSiteBundle:Timetable')->findIdDate($date);
            $user = $this->getUser();
            $list_id = "";
            for ($i=1;$i<8;$i++)
            {
            	if(empty($schedule[$i]))
                {
                    $timetable_id = $em->getRepository('CoyoteSiteBundle:TimeTable')->findOneById(
                    		$timetable_ids[($i-1)]->getId());
                    $schedule[$i] = $em->getRepository('CoyoteSiteBundle:Schedule')->createSchedulefm($user,
                    		$timetable_id, $deplacement[$i], $data['absence'.$i], $data['absenceday'.$i],
                    		$data['absencetime'.$i], $data['comment'.$i], $data['day'.$i]);
                }
                else
                {
                    $schedule[$i] = $em->getRepository('CoyoteSiteBundle:Schedule')->updateSchedulefm($schedule[$i],
                    		$deplacement[$i], $data['absence'.$i], $data['absenceday'.$i], $data['absencetime'.$i],
                        	$data['comment'.$i], floatval($data['day'.$i]));
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
                $absenceca = $em->getRepository('CoyoteSiteBundle:Schedule')->countAbsenceMonth($date, $user->getId(), "CA");
                $absencecp = $em->getRepository('CoyoteSiteBundle:Schedule')->countAbsenceMonth($date, $user->getId(), "CP");
                $absencertt = $em->getRepository('CoyoteSiteBundle:Schedule')->countAbsenceMonth($date, $user->getId(), "RTT");
                $absencerttyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "RTT");
                $absencecayear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "CA");
                $absencecpyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "CP");
                if ($this->get('security.context')->isGranted('ROLE_CADRE'))
                {
                    $daymonth = $em->getRepository('CoyoteSiteBundle:Schedule')->findDayMonth($date, $user);
                    $dayyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findDayYear($period, $user);
                    $dataschedule = $em->getRepository('CoyoteSiteBundle:Schedule')->findAboutDateUserFM($user, $date);
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
                    $data_schedule = $em->getRepository('CoyoteSiteBundle:Schedule')->findAboutDateUser($user, $date);
                    $timeweek = $em->getRepository('CoyoteSiteBundle:Schedule')->countTimeWeek($data_schedule);
                    $timemonth = $em->getRepository('CoyoteSiteBundle:Schedule')->findTimeMonth($year.'-'.$month.'-%',
                    		$user);
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
            $absenceca = $em->getRepository('CoyoteSiteBundle:Schedule')->countAbsenceMonth($date, $user->getId(), "CA");
            $absencecp = $em->getRepository('CoyoteSiteBundle:Schedule')->countAbsenceMonth($date, $user->getId(), "CP");
            $absencertt = $em->getRepository('CoyoteSiteBundle:Schedule')->countAbsenceMonth($date, $user->getId(), "RTT");
            $absencerttyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "RTT");
            $absencecayear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "CA");
            $absencecpyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "CP");
            if ($this->get('security.context')->isGranted('ROLE_CADRE'))
            {
                $daymonth = $em->getRepository('CoyoteSiteBundle:Schedule')->findDayMonth($date, $user);
                $dayyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findDayYear($period, $user);
                $dataschedule = $em->getRepository('CoyoteSiteBundle:Schedule')->findAboutDateUserFM($user, $date);
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
                $data_schedule = $em->getRepository('CoyoteSiteBundle:Schedule')->findAboutDateUser($user, $date);
                $timeweek = $em->getRepository('CoyoteSiteBundle:Schedule')->countTimeWeek($data_schedule);
                $timemonth = $em->getRepository('CoyoteSiteBundle:Schedule')->findTimeMonth($year.'-'.$month.'-%',
                		$user);
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

    public function getScheduleUserAction()
    {
        /** @var $em object doctrine request */
        $em = $this->getDoctrine()->getManager();
        /** @var $request object request */
        $request = Request::createFromGlobals();
        
        if ($request->getMethod() == 'GET' && isset($_GET['pay_period']))
    	{
        	$year = explode('/', $_GET['pay_period']);
            $date_start = $year[0]."-06-01";
            $date_end = $year[1]."-05-31";
            /** @var $filename string */
            $filename = "export_period".$date_start."-".$date_end.".csv";
            $user = $this->getUser();
            $data_schedule = $em->getRepository('CoyoteSiteBundle:Schedule')->createFileUser($user, $date_start,
                $date_end);
            /** @return file txt downloaded with data expense */
            return new Response($data_schedule, 200, array(
                'Content-Type' => 'application/force-download',
                'Content-Disposition' => 'attachment; filename="'.$filename.'"'
            ));
        }
        else
        {
            $data = new Data();
        	$date = date('Y-m-d');
        	$doctrine = $this->getDoctrine();
        	$em = $doctrine->getManager();
        	$period = $em->getRepository('CoyoteSiteBundle:Timetable')->findPeriodByDate($date);
            /** show view */
            return $this->render('CoyoteSiteBundle:Schedule:indexscheduleuserexcel.html.twig', array(
                'period' => $period, 'tab_period' => $data->getTabPeriod()));
        }
    }

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
            $overtime = $em->getRepository('CoyoteSiteBundle:Schedule')->countOvertime($this->getUser(),
            		$working_time_week);
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
    		$schedules_lock = $em->getRepository("CoyoteSiteBundle:Schedule")->postScheduleLocked($date,
    				$this->getUser());
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

    /**
     * Function to print time attendance by year
     * @access public
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function getScheduleUserPrintYearAction(Request $request)
    {
    	$data = new Data();
    	if ($request->getMethod() == 'GET' && isset($_GET['pay_period']))
    	{
    		$doctrine = $this->getDoctrine();
    		$em = $doctrine->getManager();
    		$period = $_GET['pay_period'];
    		//$user = $em->getRepository('CoyoteSiteBundle:User')->findOneById(46);
    		$user = $this->getUser();
    		$absencerttyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "RTT");
    		$absencecayear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "CA");
    		$absencecpyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "CP");
    		if ($this->get('security.context')->isGranted('ROLE_CADRE'))
    		{
        		$dayyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findDayYear($period, $user);
    			$data_schedule = $em->getRepository('CoyoteSiteBundle:Schedule')->dataScheduleFMYear($user, $period);
    			$page = $this->render('CoyoteSiteBundle:Schedule:printfmpayperiod.html.twig', array(
    					'dataschedule' => $data_schedule,
    					'rttyear' => $absencerttyear,
    					'cpyear' => $absencecpyear,
    					'cayear' => $absencecayear,
    					'dayyear' => $dayyear,
    			));
    		}
    		if ($this->get('security.context')->isGranted('ROLE_TECH'))
    		{
    			$data_schedule = $em->getRepository('CoyoteSiteBundle:Schedule')->dataScheduleYear($user, $period);
    			$timeweek = $em->getRepository('CoyoteSiteBundle:Schedule')->timeWeek($data_schedule);
    			$date = '';
    			$day = '';
    			$week = '';
    			for ($i=0;$i<count($data_schedule);$i++)
    			{
    				$day[$i] = $data_schedule[$i]['date']->format('l');
    				$date[$i] = $data_schedule[$i]['date']->format('d/m/Y');
    				$week[$i] = $data_schedule[$i]['date']->format('W');
    			}
    			$page = $this->render('CoyoteSiteBundle:Schedule:printpayperiod.html.twig', array(
    				'day' => $day,
    				'date' => $date,
    				'week' => $week,
    				'dataschedule' => $data_schedule,
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
    	$data = new Data();
    	$date = date('Y-m-d');
    	$doctrine = $this->getDoctrine();
    	$em = $doctrine->getManager();
    	$period = $em->getRepository('CoyoteSiteBundle:Timetable')->findPeriodByDate($date);
        return $this->render('CoyoteSiteBundle:Schedule:indexprintyear.html.twig', array(
            'period' => $period, 'tab_period' => $data->getTabPeriod()));
    	}
    }
    /*****************************************************************/
    /***********************Fonctions Erronées************************/
    /*****************************************************************/
