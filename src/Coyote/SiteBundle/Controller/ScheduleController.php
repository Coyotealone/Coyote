<?php

namespace Coyote\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

use Coyote\SiteBundle\Form\UserType;
use Coyote\SiteBundle\Form\ScheduleType;

use Coyote\SiteBundle\Entity\Schedule;
use Coyote\SiteBundle\Entity\Timetable;
use Coyote\SiteBundle\Entity\User;
use Coyote\SiteBundle\Entity\Data;

use Doctrine\ORM\EntityRepository;

/**
 * Schedule controller.
 *
 */
class ScheduleController extends Controller
{

    /**
     * indexAction function.
     * function that redirect to schedule_new or schedule_create
     *
     * @access public
     * @return void
     */
    public function indexAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();

        if($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED') == false)
        {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        return $this->redirect($this->generateUrl('schedule_post'));
    }

   /**
     * editAction function.
     * function that displays a edit page of Time Attendance
     *
     * @access public
     * @return void
     */
    public function postScheduleAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $request->getSession();

        $date = $em->getRepository('CoyoteSiteBundle:Timetable')->createDateYearWeek(
            $session->get('year'), $session->get('week'));

        $data_timetable = $em->getRepository('CoyoteSiteBundle:Timetable')->searchIdDate($date);

        $time = $em->getRepository('CoyoteSiteBundle:Schedule')->timeData(
            $data_timetable, $this->getUser());

        $j = 0;
        $duration = array();
        for($i=0;$i<count($time);$i++)
        {
            if(count($time[$j])>0)
            {
                if($data_timetable[$i]->getId() == $time[$j]->getTimetable()->getId())
                {
                    $session->set('id_'.$i, $time[$j]->getId());
                    $duration[$i] = $time[$j]->getAbsenceDuration();
                    $j++;
                }
            }
            else
            {
                $session->set('id_'.$i, '');
            }
        }
        return $this->render('CoyoteSiteBundle:Schedule:postschedule.html.twig',
            array('data_timetable' => $data_timetable, 'time' => $time, 'duration' => $duration));
    }


    /**
     * worklessAction function.
     * function to display the previous week
     *
     * @access public
     * @return void
     */
    public function worklessAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $request->getSession();
        $no_week = $session->get('week');
        $year = $session->get('year');
        if($no_week == 1)
        {
            $no_week = 52;
            $year--;
        }
        else
            $no_week--;
        $session->set('week', $no_week);
        $session->set('year', $year);

        return $this->redirect($this->generateUrl('schedule_index'));
    }


    /**
     * workmoreAction function.
     * function to display the next week
     *
     * @access public
     * @return void
     */
    public function workmoreAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $session = $request->getSession();
        $no_week = $session->get('week');
        $year = $session->get('year');
        if($no_week == 52)
        {
            $no_week = 1;
            $year++;
        }
        else
            $no_week++;
        $session->set('week', $no_week);
        $session->set('year', $year);
        return $this->redirect($this->generateUrl('schedule_index'));
    }


    /**
     * savetimeAction function.
     * function to save data of Time Attendance about ROLE_TECH
     *
     * @access public
     * @return void
     */
    public function savetimeAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        if($user == "anon.")
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        else
        {
            $request = $this->getRequest();
            $session = $request->getSession();
            $doctrine = $this->getDoctrine();
            $em = $doctrine->getManager();
            $request = Request::createFromGlobals();
            $data = $request->request->all();

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

            $j = 0;
            $list_id = "";

            for ($i=1;$i<8;$i++)
            {
                if(empty($schedule[$i]))
                {
                    $timetable_id = $em->getRepository('CoyoteSiteBundle:TimeTable')->findOneById($timetable_ids[($i-1)]->getId());
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
            return $this->redirect($this->generateUrl('schedule_index'));
        }
    }


    /**
     * savetimefmAction function.
     * function to save data of Time Attendance about ROLE_CADRE
     *
     * @access public
     * @return void
     */
    public function savetimefmAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        if($user == "anon.")
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        else{
            $request = $this->getRequest();
            $session = $request->getSession();
            $doctrine = $this->getDoctrine();
            $em = $doctrine->getManager();
            $request = Request::createFromGlobals();
            $data = $request->request->all();

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
            $user = $this->getUser();

            $j = 0;
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
            return $this->redirect($this->generateUrl('schedule_index'));
        }
    }

    /**
     * indexshowAction function.
     * show page selection month and year to show time attendance
     *
     * @access public
     * @return void
     */
    public function indexshowAction()
    {
        $data = new Data();
        return $this->render('CoyoteSiteBundle:Schedule:indexshow.html.twig', array('month' => date('n'),
            'year' => date('Y'), 'tab_mois' => $data->getTabMonth(), 'tab_num_mois' => $data->getTabNumMonth(),
            'tab_annee' => $data->getTabYear()));
    }

    /**
     * showAction function.
     * show time attendance by month and year
     *
     * @access public
     * @return void
     */
    public function showAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $request = Request::createFromGlobals();

        $year = $_GET['year'];
        $month = $_GET['month'];

        if(empty($year) && empty($month))
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

            if($this->get('security.context')->isGranted('ROLE_CADRE'))
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
            if($this->get('security.context')->isGranted('ROLE_TECH'))
            {
                $dataschedule = $em->getRepository('CoyoteSiteBundle:Schedule')->dataSchedule($user, $date);
                $index = 0;
                $value = 0;
                $timeweek = '';
                $value_max = count($dataschedule)-1;
                for($i=0;$i<count($dataschedule);$i++)
                {
                    if($dataschedule[$i]['date']->format('l') != "Sunday")
                        $value += $em->getRepository('CoyoteSiteBundle:Schedule')->calculTime(
                            $dataschedule[$i]['working_time']);
                    if($dataschedule[$i]['date']->format('l') == "Sunday" and $i != $value_max)
                    {
                        $timeweek[$index] = $em->getRepository('CoyoteSiteBundle:Schedule')->formatTime($value);
                        $value = 0;
                        $index++;
                    }
                    if($i == $value_max)
                    {
                        $timeweek[$index] = $em->getRepository('CoyoteSiteBundle:Schedule')->formatTime($value);
                    }
                }
                $timemonth = $em->getRepository('CoyoteSiteBundle:Schedule')->findTimeMonth($year.'-'.$month.'-%', $user);

                return $this->render('CoyoteSiteBundle:Schedule:show.html.twig', array(
                    'dataschedule' => $dataschedule,
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

    /**
     * indexprintAction function.
     *
     * @access public
     * @return void
     */
    public function indexprintAction()
    {
        $data = new Data();
        return $this->render('CoyoteSiteBundle:Schedule:indexprint.html.twig', array('month' => date('n'),
            'year' => date('Y'), 'tab_mois' => $data->getTabMonth(), 'tab_num_mois' => $data->getTabNumMonth(),
            'tab_annee' => $data->getTabYear()));
    }

    /**
     * printAction function.
     * export data time attendance in PDF by month select
     *
     * @access public
     * @return void
     */
    public function printAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $request = Request::createFromGlobals();

        $year = $_GET['year'];
        $month = $_GET['month'];

        if(empty($year) && empty($month))
        {
            return $this->redirect($this->generateUrl('schedule_indexprint'));
        }
        else
        {
            return new Response("En mainteance");

            if(empty($year) && empty($month))
                return $this->render('CoyoteSiteBundle:Schedule:indexprint.html.twig');

            $user = $this->getUser();
            $period = $em->getRepository('CoyoteSiteBundle:Schedule')->findPeriod($month, $year);
            $date = $year."-".$month."-%";
            $absenceca = $em->getRepository('CoyoteSiteBundle:Schedule')->absenceMonth($date, $user->getId(), "CA");
            $absencecp = $em->getRepository('CoyoteSiteBundle:Schedule')->absenceMonth($date, $user->getId(), "CP");
            $absencertt = $em->getRepository('CoyoteSiteBundle:Schedule')->absenceMonth($date, $user->getId(), "RTT");
            $absencerttyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "RTT");
            $absencecayear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "CA");
            $absencecpyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "CP");

            if($this->get('security.context')->isGranted('ROLE_CADRE'))
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
            if($this->get('security.context')->isGranted('ROLE_TECH'))
            {
                $dataschedule = $em->getRepository('CoyoteSiteBundle:Schedule')->dataSchedule($user, $date);
                $index = 0;
                $value = 0;
                $timeweek = '';
                $value_max = count($dataschedule)-1;
                for($i=0;$i<count($dataschedule);$i++)
                {
                    if($dataschedule[$i]['date']->format('l') != "Sunday")
                        $value += $em->getRepository('CoyoteSiteBundle:Schedule')->calculTime(
                            $dataschedule[$i]['working_time']);
                    if($dataschedule[$i]['date']->format('l') == "Sunday" and $i != $value_max)
                    {
                        $timeweek[$index] = $em->getRepository('CoyoteSiteBundle:Schedule')->formatTime($value);
                        $value = 0;
                        $index++;
                    }
                    if($i == $value_max)
                    {
                        $timeweek[$index] = $em->getRepository('CoyoteSiteBundle:Schedule')->formatTime($value);
                    }
                }
                $timemonth = $em->getRepository('CoyoteSiteBundle:Schedule')->findTimeMonth($year.'-'.$month.'-%', $user);

                $page = $this->render('CoyoteSiteBundle:Schedule:print.html.twig', array(
                    'dataschedule' => $dataschedule,
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
            $date = date("Ymd");
            $heure = date("His");
            $filename = $user->getName()."_presence".$date."-".$heure.".pdf";
            $html = $page->getContent();
            $html2pdf = new \Html2Pdf_Html2Pdf('P', 'A4', 'fr');
            $html2pdf->pdf->SetDisplayMode('real');
            $html2pdf->writeHTML($html);
            $html2pdf->Output($filename, 'D');
            return new Response('PDF réalisé');
        }
    }

    /**
     * affichage de la page avant d'obtenir un fichier pdf de l'année.
     * show page selection period to print PDF
     *
     * @access public
     * @return void
     */
    public function indexprintyearAction()
    {
        $data = new Data();
        $date = date('Y-m-d');
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $period = $em->getRepository('CoyoteSiteBundle:Timetable')->findPeriodByDate($date);
        return $this->render('CoyoteSiteBundle:Schedule:indexprintyear.html.twig', array(
            'period' => $period, 'tab_period' => $data->getTabPeriod()));
    }


    /**
     * génération d'un fichier pdf de l'année de l'user.
     * export data time attendance in PDF by working period
     *
     * @access public
     * @return void
     */
    public function printyearAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $request = Request::createFromGlobals();

        $period = $_GET['pay_period'];

        if(empty($period))
        {
            return $this->redirect($this->generateUrl('schedule_indexprintyear'));
        }
        else
        {
            return new Response("En mainteance");
            if(empty($period))
                return $this->render('CoyoteSiteBundle:Schedule:indexprint.html.twig');

            $user = $em->getRepository('CoyoteSiteBundle:User')->find($session->get('userid'));
            $absencerttyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "RTT");
            $absencecayear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "CA");
            $absencecpyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "CP");

            if($this->get('security.context')->isGranted('ROLE_CADRE'))
            {
                $dayyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findDayYear($period, $user);
                $dataschedule = $em->getRepository('CoyoteSiteBundle:Schedule')->dataScheduleFMYear($user, $period);
                $page = $this->render('CoyoteSiteBundle:Schedule:printfmpayperiod.html.twig', array(
                    'dataschedule' => $dataschedule,
                    'rttyear' => $absencerttyear,
                    'cpyear' => $absencecpyear,
                    'cayear' => $absencecayear,
                    'dayyear' => $dayyear,
                    ));
            }
            if($this->get('security.context')->isGranted('ROLE_TECH'))
            {
                $dataschedule = $em->getRepository('CoyoteSiteBundle:Schedule')->dataScheduleYear($user, $period);
                $index = 0;
                $value = 0;
                $timeweek = '';
                $value_max = count($dataschedule)-1;
                for($i=0;$i<count($dataschedule);$i++)
                {
                    if($dataschedule[$i]['day'] != "dimanche")
                        $value += $em->getRepository('CoyoteSiteBundle:Schedule')->calculTime(
                            $dataschedule[$i]['working_time']);
                    if($dataschedule[$i]['day'] == "dimanche" and $i != $value_max)
                    {
                        $timeweek[$index] = $em->getRepository('CoyoteSiteBundle:Schedule')->formatTime($value);
                        $value = 0;
                        $index++;
                    }
                    if($i == $value_max)
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
            $filename = $user->getName()."_presence".$date."-".$heure.".pdf";
            $html = $page->getContent();
            $html2pdf = new \Html2Pdf_Html2Pdf('P', 'A4', 'fr');
            $html2pdf->pdf->SetDisplayMode('real');
            $html2pdf->writeHTML($html);
            $html2pdf->Output($filename, 'D');
            return new Response('PDF réalisé');
        }
    }


    /**
     * indexexportprintyearAction function.
     * Affichage des choix de période avant impression PDF
     * show page selection period to print PDF
     *
     * @access public
     * @return void
     */
    public function indexexportprintyearAction()
    {
        return new Response("En mainteance");
        $date = date('Y-m-d');
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $period = $em->getRepository('CoyoteSiteBundle:Timetable')->findPeriodByDate($date);
        $data = new Data();
        return $this->render('CoyoteSiteBundle:Schedule:indexexportprintyear.html.twig', array(
            'period' => $period, 'tab_period' => $data->getTabPeriod()));
    }


    /**
     * exportprintyearAction function.
     * export all data time attendance in PDF by working period
     *
     * @access public
     * @return void
     */
    public function exportprintyearAction()
    {
        return new Response("En mainteance");
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $pay_period = $_GET['pay_period'];
        define("pay_period", $pay_period, true);
        $data = new Data();
        $tab_user_id = $data->getTabUserIdSchedulePDF();

        if(empty($pay_period))
        {
            return $this->redirect($this->generateUrl('schedule_indexexportprintyear'));
        }
        else
        {
            if(empty($pay_period))
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
                    if($check_role == "ROLE_CADRE")
                        $role = 'ROLE_CADRE';
                    if($check_role == "ROLE_TECH")
                        $role = 'ROLE_TECH';
                }

                $absencerttyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear(
                    constant('pay_period'), $user, "RTT");
                $absencecayear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear(
                    constant('pay_period'), $user, "CA");
                $absencecpyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear(
                    constant('pay_period'), $user, "CP");

                if($role == 'ROLE_CADRE')
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
                if($role == 'ROLE_TECH')
                {
                    $dataschedule = $em->getRepository('CoyoteSiteBundle:Schedule')->dataScheduleYear(
                        $user, constant('pay_period'));
                    $index = 0;
                    $value = 0;
                    $timeweek = '';
                    $value_max = count($dataschedule)-1;
                    for($i=0;$i<count($dataschedule);$i++)
                    {
                        if($dataschedule[$i]['day'] != "dimanche")
                            $value += $em->getRepository('CoyoteSiteBundle:Schedule')->calculTime(
                                $dataschedule[$i]['working_time']);
                        if($dataschedule[$i]['day'] == "dimanche" and $i != $value_max)
                        {
                            $timeweek[$index] = $em->getRepository('CoyoteSiteBundle:Schedule')->formatTime($value);
                            $value = 0;
                            $index++;
                        }
                        if($i == $value_max)
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
    }


    /**
     * showovertimeAction function.
     * function shows Overtime
     * @access public
     * @return void
     */
    public function showovertimeAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $request = Request::createFromGlobals();
        $user_id = $session->get('userid');
        $date = "2014-06-%";
        $date_count_absence = "2014-06-0%";
        $working_day = $em->getRepository('CoyoteSiteBundle:Timetable')->findworkingday($date, $user_id);
        $sum_working_time = $em->getRepository('CoyoteSiteBundle:Schedule')->sumWorkingTimeMonth($date, $user_id);
        $count_absence = $em->getRepository('CoyoteSiteBundle:Schedule')->countAbsence($date_count_absence, $user_id);
        $overtime = $em->getRepository('CoyoteSiteBundle:Schedule')->calculOvertime($working_day, $sum_working_time,
            $count_absence);
        return $this->render('CoyoteSiteBundle:Schedule:showovertime.html.twig', array('overtime' => $overtime));
    }

}
