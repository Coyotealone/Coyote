<?php

namespace Coyote\Bundle\AttendanceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\DateTime;

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
		$date = $em->getRepository('CoyoteAttendanceBundle:Schedule')->createDateYearWeek(
    			$session->get('year'), $session->get('week'));
    	$data_timetable = $em->getRepository('CoyoteAttendanceBundle:Schedule')->dateWeek($date);
    	$time = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findAllAboutTimetableUserNew(
    			$data_timetable, $this->getUser());
		return $this->render('CoyoteAttendanceBundle:Schedule:postschedule.html.twig',
    			array('data_timetable' => $data_timetable, 'time' => $time));
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
        $em->getRepository("CoyoteAttendanceBundle:Schedule")->updateWeek("less", $session);
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
        $em->getRepository("CoyoteAttendanceBundle:Schedule")->updateWeek("more", $session);
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
        $request = $this->getRequest();
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();

        if ($this->get('security.context')->isGranted('ROLE_TECH'))
        {
            $data = $request->request->all();
            $em->getRepository('CoyoteAttendanceBundle:Schedule')->postScheduleUser($user, $data);
            $message = 'schedule.flash.save';
            $this->get('session')->getFlashBag()->set('save_schedule', $message);
            return $this->redirect($this->generateUrl('schedule_getscheduleuserweek'));
        }
        if ($this->get('security.context')->isGranted('ROLE_CADRE'))
        {
	        $data = $request->request->all();
            $em->getRepository('CoyoteAttendanceBundle:Schedule')->postScheduleUserfm($user, $data);
           	$message = 'schedule.flash.save';
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
	    $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        if ($request->getMethod() == 'GET' && filter_input(INPUT_GET, 'year', FILTER_UNSAFE_RAW) && filter_input(INPUT_GET, 'month', FILTER_UNSAFE_RAW))
        {
            $year = filter_input(INPUT_GET, 'year', FILTER_UNSAFE_RAW);
            $month = filter_input(INPUT_GET, 'month', FILTER_UNSAFE_RAW);
            if (empty($year) && empty($month))
            {
                return $this->redirect($this->generateUrl('schedule_indexshow'));
            }
            else
            {
                if(empty($year) && empty($month))
                    return $this->render('CoyoteAttendanceBundle:Schedule:indexshow.html.twig');
                $user = $this->getUser();
                $absences_month = $em->getRepository('CoyoteAttendanceBundle:Schedule')->allAbsencesMonth($month,$year,$user);
                $absences_year = $em->getRepository('CoyoteAttendanceBundle:Schedule')->allAbsencesYear($month,$year,$user);

                if ($this->get('security.context')->isGranted('ROLE_CADRE'))
                {
                    $data_tech = $em->getRepository('CoyoteAttendanceBundle:Schedule')->dataTech($user,$month,$year);
                    return $this->render('CoyoteAttendanceBundle:Schedule:showfm.html.twig', array('day' => $data_tech[3],
                        'date' => $data_tech[4], 'week' => $data_tech[5], 'dataschedule' => $data_tech[0],
                        'absenceca' => $absences_month[0], 'absencecp' => $absences_month[1], 'absencertt' => $absences_month[2],
                        'time' => $data_tech[2], 'rttyear' => $absences_year[2], 'cpyear' => $absences_year[1],
                        'cayear' => $absences_year[0], 'timeweek' => $data_tech[1], 'holiday' => $data_tech[6]));
                }
                if ($this->get('security.context')->isGranted('ROLE_TECH'))
                {
                    $data_tech = $em->getRepository('CoyoteAttendanceBundle:Schedule')->dataTech($user,$month,$year);
                    return $this->render('CoyoteAttendanceBundle:Schedule:show.html.twig', array('day' => $data_tech[3],
                        'date' => $data_tech[4], 'week' => $data_tech[5], 'dataschedule' => $data_tech[0],
                        'absenceca' => $absences_month[0], 'absencecp' => $absences_month[1], 'absencertt' => $absences_month[2],
                        'time' => $data_tech[2], 'rttyear' => $absences_year[2], 'cpyear' => $absences_year[1],
                        'cayear' => $absences_year[0], 'timeweek' => $data_tech[1], 'holiday' => $data_tech[6]));
                }
            }
        }
        $tab_month = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findMonth();
        $tab_num_month = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findNumMonth();
        $tab_year = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findYear();

        return $this->render('CoyoteAttendanceBundle:Schedule:indexshow.html.twig', array('month' => date('n'),
        		'year' => date('Y'), 'tab_mois' => $tab_month, 'tab_num_mois' => $tab_num_month,
                'tab_annee' => $tab_year));
    }

    /**
     * Function to print time attendance by month
     * @access public
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function getScheduleUserPrintMonthAction(Request $request)
    {
	    $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        if ($request->getMethod() == 'GET' && filter_input(INPUT_GET, 'month', FILTER_UNSAFE_RAW) && filter_input(INPUT_GET, 'year', FILTER_UNSAFE_RAW))
        {
            $year = filter_input(INPUT_GET, 'year', FILTER_UNSAFE_RAW);
            $month = filter_input(INPUT_GET, 'month', FILTER_UNSAFE_RAW);
            $user = $this->getUser();
            $absences_month = $em->getRepository('CoyoteAttendanceBundle:Schedule')->allAbsencesMonth($month,$year,$user);
            $absences_year = $em->getRepository('CoyoteAttendanceBundle:Schedule')->allAbsencesYear($month,$year,$user);
            if ($this->get('security.context')->isGranted('ROLE_CADRE'))
            {
                $data_tech = $em->getRepository('CoyoteAttendanceBundle:Schedule')->dataTech($user,$month,$year);
                $page = $this->render('CoyoteAttendanceBundle:Schedule:printfm.html.twig', array('day' => $data_tech[3],
                    'date' => $data_tech[4], 'week' => $data_tech[5], 'dataschedule' => $data_tech[0],
                    'absenceca' => $absences_month[0], 'absencecp' => $absences_month[1], 'absencertt' => $absences_month[2],
                    'time' => $data_tech[2], 'rttyear' => $absences_year[2], 'cpyear' => $absences_year[1],
                    'cayear' => $absences_year[0], 'timeweek' => $data_tech[1], 'holiday' => $data_tech[6]));
            }
            if ($this->get('security.context')->isGranted('ROLE_TECH'))
            {
                $data_tech = $em->getRepository('CoyoteAttendanceBundle:Schedule')->dataTech($user,$month,$year);
                $page = $this->render('CoyoteAttendanceBundle:Schedule:print.html.twig', array('day' => $data_tech[3],
                    'date' => $data_tech[4], 'week' => $data_tech[5], 'dataschedule' => $data_tech[0],
                    'absenceca' => $absences_month[0], 'absencecp' => $absences_month[1], 'absencertt' => $absences_month[2],
                    'time' => $data_tech[2], 'rttyear' => $absences_year[2], 'cpyear' => $absences_year[1],
                    'cayear' => $absences_year[0], 'timeweek' => $data_tech[1], 'holiday' => $data_tech[6]));
            }

            $filename = $user->getUsername()."_presence".date("Ymd")."-".date("His").".pdf";
            $html = $page->getContent();
            $html2pdf = new \Html2Pdf_Html2Pdf('P', 'A4', 'fr');
            $html2pdf->pdf->SetDisplayMode('real');
            $html2pdf->writeHTML($html);
            $html2pdf->Output($filename, 'D');
            return new Response('PDF réalisé');
        }
        $tab_month = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findMonth();
        $tab_num_month = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findNumMonth();
        $tab_year = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findYear();

        return $this->render('CoyoteAttendanceBundle:Schedule:indexprint.html.twig', array('month' => date('n'),
        		'year' => date('Y'), 'tab_mois' => $tab_month, 'tab_num_mois' => $tab_num_month,
                'tab_annee' => $tab_year));
    }

    /*****************************************************************/
    /***********************Fonctions En cours************************/
    /*****************************************************************/

    public function getScheduleUserAction()
    {
        /** @var $em object doctrine request */
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        if ($request->getMethod() == 'GET' && filter_input(INPUT_GET, 'pay_period', FILTER_UNSAFE_RAW))
    	{
        	$period = filter_input(INPUT_GET, 'pay_period', FILTER_UNSAFE_RAW);

            if ($this->get('security.context')->isGranted('ROLE_CADRE'))
            {
                /** @var $filename string */
                $filename = "export_period".$period.".csv";
                $user = $this->getUser();
                $data_schedule = $em->getRepository('CoyoteAttendanceBundle:Schedule')->createFileUserFM($user, $period);
            }
            if ($this->get('security.context')->isGranted('ROLE_TECH'))
            {
                /** @var $filename string */
                $filename = "export_period".$period.".csv";
                $user = $this->getUser();
                $data_schedule = $em->getRepository('CoyoteAttendanceBundle:Schedule')->createFileUser($user, $period);
            }
            /** @return file txt downloaded with data expense */
            return new Response($data_schedule, 200, array(
                'Content-Type' => 'application/force-download',
                'Content-Disposition' => 'attachment; filename="'.$filename.'"'
            ));
        }
        else
        {
            $date = date('Y-m-d');
        	$doctrine = $this->getDoctrine();
        	$em = $doctrine->getManager();
        	$tab_period = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findPeriod();
        	$period = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findPeriodByDate($date);
            /** show view */
            return $this->render('CoyoteAttendanceBundle:Schedule:indexscheduleuserexcel.html.twig', array(
                'period' => $period, 'tab_period' => $tab_period));
        }
    }

    public function postSchedulesLockedAction()
    {
    	$request = $this->getRequest();
    	if ($request->getMethod() == 'POST' && filter_input(INPUT_POST, 'date', FILTER_UNSAFE_RAW))
    	{
    		$em = $this->getDoctrine()->getManager();
    		$date = new \DateTime(filter_input(INPUT_POST, 'date', FILTER_UNSAFE_RAW));
    		$schedules_lock = $em->getRepository("CoyoteAttendanceBundle:Schedule")->postScheduleLocked($date,
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
    		return $this->render('CoyoteAttendanceBundle:Schedule:scheduleslocked.html.twig');
    	}
    }

    /**
     * Function to print time attendance by year
     * @access public
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function getScheduleUserPrintYearAction(Request $request)
    {
	    $em = $this->getDoctrine()->getManager();
    	$request = $this->getRequest();
    	if ($request->getMethod() == 'GET' && filter_input(INPUT_GET, 'pay_period', FILTER_UNSAFE_RAW))
    	{
    		$period = filter_input(INPUT_GET, 'pay_period', FILTER_UNSAFE_RAW);
    		$user = $this->getUser();
    		if ($this->get('security.context')->isGranted('ROLE_CADRE'))
    		{
        		$data_tech = $em->getRepository('CoyoteAttendanceBundle:Schedule')->dataCadreYear($period, $user);
        		$absences_year = $em->getRepository('CoyoteAttendanceBundle:Schedule')->allAbsencesYearAboutPeriod($period,$user);

    			$page = $this->render('CoyoteAttendanceBundle:Schedule:printfmpayperiod.html.twig', array(
    				'day' => $data_tech[1], 'date' => $data_tech[2], 'week' => $data_tech[3], 'holiday' => $data_tech[4],
    				'dataschedule' => $data_tech[0], 'rttyear' => $absences_year[2], 'cpyear' => $absences_year[1],
    				'cayear' => $absences_year[0], 'period' => $period));
    		}
    		if ($this->get('security.context')->isGranted('ROLE_TECH'))
    		{
        		$data_tech = $em->getRepository('CoyoteAttendanceBundle:Schedule')->dataTechYear($period, $user);
        		$absences_year = $em->getRepository('CoyoteAttendanceBundle:Schedule')->allAbsencesYearAboutPeriod($period,$user);

    			$page = $this->render('CoyoteAttendanceBundle:Schedule:printpayperiod.html.twig', array(
    				'day' => $data_tech[2], 'date' => $data_tech[3], 'week' => $data_tech[4], 'holiday' => $data_tech[5],
    				'dataschedule' => $data_tech[0], 'rttyear' => $absences_year[2], 'cpyear' => $absences_year[1],
    				'cayear' => $absences_year[0], 'timeweek' => $data_tech[1], 'period' => $period));
    		}
    		$html = $page->getContent();
    		$filename = $user->getUsername()."_presence".date("Ymd")."-".date("His").".pdf";
    		$html = $page->getContent();
    		$html2pdf = new \Html2Pdf_Html2Pdf('P', 'A4', 'fr');
    		$html2pdf->pdf->SetDisplayMode('real');
    		$html2pdf->writeHTML($html);
    		$html2pdf->Output($filename, 'D');
    		return new Response('PDF réalisé');
    	}
    	$tab_period = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findPeriod();
    	$doctrine = $this->getDoctrine();
    	$em = $doctrine->getManager();
    	$period = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findPeriodByDate(date('Y-m-d'));
        return $this->render('CoyoteAttendanceBundle:Schedule:indexprintyear.html.twig', array(
            'period' => $period, 'tab_period' => $tab_period));
    }

    /**
     * Export data design office users.
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function getexportDataUserAction()
    {
        /** check role */
        if ($this->get('security.context')->isGranted('ROLE_CHEF_BE'))
        {
            /** @var $em object doctrine request */
            $em = $this->getDoctrine()->getManager();
            /** @var $data array data request */
            $request = $this->getRequest();

            if ($request->getMethod() == 'POST' && filter_input(INPUT_POST, 'month', FILTER_UNSAFE_RAW) && filter_input(INPUT_POST, 'year', FILTER_UNSAFE_RAW))
            {
                $ids_user_be = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findUserBe("%ROLE_BE_USER%");
	            $filecsv = $em->getRepository('CoyoteAttendanceBundle:Schedule')->createFileUserBE($ids_user_be,
                    filter_input(INPUT_POST, 'month', FILTER_UNSAFE_RAW), filter_input(INPUT_POST, 'year', FILTER_UNSAFE_RAW));
                /** @var $filename string file name CSV */
                $filename = 'datauser'.filter_input(INPUT_POST, 'month', FILTER_UNSAFE_RAW).'/'.filter_input(INPUT_POST, 'year', FILTER_UNSAFE_RAW).'.csv';
                /** @return file csv downloaded with data user schedule */
                return new Response($filecsv, 200, array(
                    'Content-Type' => 'application/force-download',
                    'Content-Disposition' => 'attachment; filename="'.$filename.'"'
                ));
            }
            else
            {
	            $tab_month = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findMonth();
	            $tab_num_month = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findNumMonth();
	            $tab_year = $em->getRepository('CoyoteAttendanceBundle:Schedule')->findYear();
	            return $this->render('CoyoteAttendanceBundle:Schedule:index_export.html.twig', array('month' => date('n'),
	                'year' => date('Y'), 'tab_mois' => $tab_month, 'tab_num_mois' => $tab_num_month,
	                'tab_annee' => $tab_year));
            }
        }
        else
        {
            /** redirect MainController:indexAction */
            return $this->redirect($this->generateUrl('main_menu'));
        }
    }

    /*****************************************************************/
    /***********************Fonctions Erronées************************/
    /*****************************************************************/

}