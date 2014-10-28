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
        $request = $this->getRequest();
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        if($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED') == false)
        {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        $date = $em->getRepository('CoyoteSiteBundle:Timetable')->findBy(array('no_week' => $session->get('no_week'),'year' => $session->get('year'),));
        $time = $em->getRepository('CoyoteSiteBundle:Schedule')->findBy(array('timetable' => $date, 'user' => $session->get('userid')));

        if(count($time) == 0)
            return $this->redirect($this->generateUrl('coyote_time_create'));
        else
            return $this->redirect($this->generateUrl('coyote_time_edit'));
    }

    public function createAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $request = $this->getRequest();
        $session = $request->getSession();
        $date = $em->getRepository('CoyoteSiteBundle:Timetable')->findBy(array('no_week' => $session->get('no_week'),'year' => $session->get('year'),));
        $session->set('id_lundi', '');
        $session->set('id_mardi', '');
        $session->set('id_mercredi', '');
        $session->set('id_jeudi', '');
        $session->set('id_vendredi', '');
        $session->set('id_samedi', '');
        $session->set('id_dimanche', '');
        return $this->render('CoyoteSiteBundle:Time:create.html.twig', array('date' => $date));
    }

    public function editAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $request = $this->getRequest();
        $session = $request->getSession();
        $date = $em->getRepository('CoyoteSiteBundle:Timetable')->findBy(array('no_week' => $session->get('no_week'),'year' => $session->get('year'),));
        $time = $em->getRepository('CoyoteSiteBundle:Schedule')->findBy(array('timetable' => $date, 'user' => $session->get('userid')));
        $id = $em->getRepository('CoyoteSiteBundle:Timetable')->myFindScheduleId($session->get('no_week'), $session->get('year'), $session->get('userid'));
        $timetable_id = $em->getRepository('CoyoteSiteBundle:Timetable')->myFindTimetableId($session->get('no_week'), $session->get('year'));
        $session->set('id_lundi', $id[0]['id']);
        $session->set('id_mardi', $id[1]['id']);
        $session->set('id_mercredi', $id[2]['id']);
        $session->set('id_jeudi', $id[3]['id']);
        $session->set('id_vendredi', $id[4]['id']);
        $session->set('id_samedi', $id[5]['id']);
        $session->set('id_dimanche', $id[6]['id']);
        return $this->render('CoyoteSiteBundle:Time:edit.html.twig', array('date' => $date, 'time' => $time, 'id' => $id, 'timetable' => $timetable_id));
    }

    public function worklessAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
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
        return $this->redirect($this->generateUrl('coyote_time_index'));
    }

    public function workmoreAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
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
        return $this->redirect($this->generateUrl('coyote_time_index'));
    }

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

            $schedulelundi = $em->getRepository('CoyoteSiteBundle:Schedule')->find($session->get('id_lundi'));
            $schedulemardi = $em->getRepository('CoyoteSiteBundle:Schedule')->find($session->get('id_mardi'));
            $schedulemercredi = $em->getRepository('CoyoteSiteBundle:Schedule')->find($session->get('id_mercredi'));
            $schedulejeudi = $em->getRepository('CoyoteSiteBundle:Schedule')->find($session->get('id_jeudi'));
            $schedulevendredi = $em->getRepository('CoyoteSiteBundle:Schedule')->find($session->get('id_vendredi'));
            $schedulesamedi = $em->getRepository('CoyoteSiteBundle:Schedule')->find($session->get('id_samedi'));
            $scheduledimanche = $em->getRepository('CoyoteSiteBundle:Schedule')->find($session->get('id_dimanche'));

            $timetable_ids = $em->getRepository('CoyoteSiteBundle:Timetable')->myFindTimetableId($session->get('no_week'), $session->get('year'));
            $id = $em->getRepository('CoyoteSiteBundle:Timetable')->myFindScheduleId($session->get('no_week'), $session->get('year'), $session->get('userid'));

            $user = $em->getRepository('CoyoteSiteBundle:User')->find($session->get('userid'));

            $timetable = new timetable();

            if($schedulelundi === null)
            {
                $timetable_id = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_ids[0]['id']);

                $schedulelundi = $em->getRepository('CoyoteSiteBundle:Schedule')->saveSchedule($user, $timetable_id, $data['debutlundi'], $data['finlundi'],
                                    $data['pauselundi'], $data['deplacementlundi'], $data['absencelundi'], $data['commentairelundi']);
            }
            if($schedulemardi === null)
            {
                $timetable_id = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_ids[1]['id']);

                $schedulemardi = $em->getRepository('CoyoteSiteBundle:Schedule')->saveSchedule($user, $timetable_id, $data['debutmardi'], $data['finmardi'],
                                    $data['pausemardi'], $data['deplacementmardi'], $data['absencemardi'], $data['commentairemardi']);
            }
            if($schedulemercredi === null)
            {
                $timetable_id = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_ids[2]['id']);

                $schedulemercredi = $em->getRepository('CoyoteSiteBundle:Schedule')->saveSchedule($user, $timetable_id, $data['debutmercredi'], $data['finmercredi'],
                                    $data['pausemercredi'], $data['deplacementmercredi'], $data['absencemercredi'], $data['commentairemercredi']);
            }
            if($schedulejeudi === null)
            {
                $timetable_id = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_ids[3]['id']);

                $schedulejeudi = $em->getRepository('CoyoteSiteBundle:Schedule')->saveSchedule($user, $timetable_id, $data['debutjeudi'], $data['finjeudi'],
                                    $data['pausejeudi'], $data['deplacementjeudi'], $data['absencejeudi'], $data['commentairejeudi']);
            }
            if($schedulevendredi === null)
            {
                $timetable_id = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_ids[4]['id']);

                $schedulevendredi = $em->getRepository('CoyoteSiteBundle:Schedule')->saveSchedule($user, $timetable_id, $data['debutvendredi'], $data['finvendredi'],
                                    $data['pausevendredi'], $data['deplacementvendredi'], $data['absencevendredi'], $data['commentairevendredi']);
            }
            if($schedulesamedi === null)
            {
                $timetable_id = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_ids[5]['id']);

                $schedulesamedi = $em->getRepository('CoyoteSiteBundle:Schedule')->saveSchedule($user, $timetable_id, $data['debutsamedi'], $data['finsamedi'],
                                    $data['pausesamedi'], $data['deplacementsamedi'], $data['absencesamedi'], $data['commentairesamedi']);
            }
            if($scheduledimanche === null)
            {
                $timetable_id = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_ids[6]['id']);

                $scheduledimanche = $em->getRepository('CoyoteSiteBundle:Schedule')->saveSchedule($user, $timetable_id, $data['debutdimanche'], $data['findimanche'],
                                    $data['pausedimanche'], $data['deplacementdimanche'], $data['absencedimanche'], $data['commentairedimanche']);
            }
            else
            {
                $schedulelundi = $em->getRepository('CoyoteSiteBundle:Schedule')->updateSchedule($schedulelundi, $data['debutlundi'], $data['finlundi'], $data['pauselundi'],
                                    $data['deplacementlundi'], $data['absencelundi'], $data['commentairelundi']);

                $schedulemardi = $em->getRepository('CoyoteSiteBundle:Schedule')->updateSchedule($schedulemardi, $data['debutmardi'], $data['finmardi'], $data['pausemardi'],
                                    $data['deplacementmardi'], $data['absencemardi'], $data['commentairemardi']);

                $schedulemercredi = $em->getRepository('CoyoteSiteBundle:Schedule')->updateSchedule($schedulemercredi, $data['debutmercredi'], $data['finmercredi'],
                                    $data['pausemercredi'], $data['deplacementmercredi'], $data['absencemercredi'], $data['commentairemercredi']);

                $schedulejeudi = $em->getRepository('CoyoteSiteBundle:Schedule')->updateSchedule($schedulejeudi, $data['debutjeudi'], $data['finjeudi'], $data['pausejeudi'],
                                    $data['deplacementjeudi'], $data['absencejeudi'], $data['commentairejeudi']);

                $schedulevendredi = $em->getRepository('CoyoteSiteBundle:Schedule')->updateSchedule($schedulevendredi, $data['debutvendredi'], $data['finvendredi'],
                                    $data['pausevendredi'], $data['deplacementvendredi'], $data['absencevendredi'], $data['commentairevendredi']);

                $schedulesamedi = $em->getRepository('CoyoteSiteBundle:Schedule')->updateSchedule($schedulesamedi, $data['debutsamedi'], $data['finsamedi'],
                                    $data['pausesamedi'], $data['deplacementsamedi'], $data['absencesamedi'], $data['commentairesamedi']);

                $scheduledimanche = $em->getRepository('CoyoteSiteBundle:Schedule')->updateSchedule($scheduledimanche, $data['debutdimanche'], $data['findimanche'],
                                    $data['pausedimanche'], $data['deplacementdimanche'], $data['absencedimanche'], $data['commentairedimanche']);
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


            return $this->redirect($this->generateUrl('coyote_time_index'));
        }
    }

    public function savetimefmAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        if($user == "anon.")
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        else
        {
            $request = $this->getRequest();
            $session = $request->getSession();
            //$session = new Session();

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

            $timetable_ids = $em->getRepository('CoyoteSiteBundle:Timetable')->myFindTimetableId($session->get('no_week'), $session->get('year'));
            $id = $em->getRepository('CoyoteSiteBundle:Timetable')->myFindScheduleId($session->get('no_week'), $session->get('year'), $session->get('userid'));

            $user = $em->getRepository('CoyoteSiteBundle:User')->find($session->get('userid'));

            $timetable = new timetable();

            if($schedulelundi === null)
            {
                $timetable_id = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_ids[0]['id']);

                $schedulelundi = $em->getRepository('CoyoteSiteBundle:Schedule')->saveSchedulefm($user, $timetable_id, $data['deplacementlundi'],
                                $data['absencelundi'], $data['commentairelundi'], $data['jourlundi']);
            }
            if($schedulemardi === null)
            {
                $timetable_id = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_ids[1]['id']);

                $schedulemardi = $em->getRepository('CoyoteSiteBundle:Schedule')->saveSchedulefm($user, $timetable_id, $data['deplacementmardi'],
                                $data['absencemardi'], $data['commentairemardi'], $data['jourmardi']);
            }
            if($schedulemercredi === null)
            {
                $timetable_id = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_ids[2]['id']);

                $schedulemercredi = $em->getRepository('CoyoteSiteBundle:Schedule')->saveSchedulefm($user, $timetable_id, $data['deplacementmercredi'],
                                $data['absencemercredi'], $data['commentairemercredi'], $data['jourmercredi']);
            }
            if($schedulejeudi === null)
            {
                $timetable_id = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_ids[3]['id']);

                $schedulejeudi = $em->getRepository('CoyoteSiteBundle:Schedule')->saveSchedulefm($user, $timetable_id, $data['deplacementjeudi'],
                                $data['absencejeudi'], $data['commentairejeudi'], $data['jourjeudi']);
            }
            if($schedulevendredi === null)
            {
                $timetable_id = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_ids[4]['id']);

                $schedulevendredi = $em->getRepository('CoyoteSiteBundle:Schedule')->saveSchedulefm($user, $timetable_id, $data['deplacementvendredi'],
                                $data['absencevendredi'], $data['commentairevendredi'], $data['jourvendredi']);
            }
            if($schedulesamedi === null)
            {
                $timetable_id = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_ids[5]['id']);

                $schedulesamedi = $em->getRepository('CoyoteSiteBundle:Schedule')->saveSchedulefm($user, $timetable_id, $data['deplacementsamedi'],
                                $data['absencesamedi'], $data['commentairesamedi'], $data['joursamedi']);
            }
            if($scheduledimanche === null)
            {
                $timetable_id = $em->getRepository('CoyoteSiteBundle:TimeTable')->find($timetable_ids[6]['id']);

                $scheduledimanche = $em->getRepository('CoyoteSiteBundle:Schedule')->saveSchedulefm($user, $timetable_id, $data['deplacementdimanche'],
                                $data['absencedimanche'], $data['commentairedimanche'], $data['jourdimanche']);
            }
            else
            {
                $schedulelundi = $em->getRepository('CoyoteSiteBundle:Schedule')->updateSchedulefm($schedulelundi, $data['deplacementlundi'],
                                    $data['absencelundi'], $data['commentairelundi'], floatval($data['jourlundi']));

                $schedulemardi = $em->getRepository('CoyoteSiteBundle:Schedule')->updateSchedulefm($schedulemardi, $data['deplacementmardi'],
                                    $data['absencemardi'], $data['commentairemardi'], floatval($data['jourmardi']));

                $schedulemercredi = $em->getRepository('CoyoteSiteBundle:Schedule')->updateSchedulefm($schedulemercredi, $data['deplacementmercredi'],
                                    $data['absencemercredi'], $data['commentairemercredi'], floatval($data['jourmercredi']));

                $schedulejeudi = $em->getRepository('CoyoteSiteBundle:Schedule')->updateSchedulefm($schedulejeudi, $data['deplacementjeudi'],
                                    $data['absencejeudi'], $data['commentairejeudi'], floatval($data['jourjeudi']));

                $schedulevendredi = $em->getRepository('CoyoteSiteBundle:Schedule')->updateSchedulefm($schedulevendredi, $data['deplacementvendredi'],
                                    $data['absencevendredi'], $data['commentairevendredi'], floatval($data['jourvendredi']));

                $schedulesamedi = $em->getRepository('CoyoteSiteBundle:Schedule')->updateSchedulefm($schedulesamedi, $data['deplacementsamedi'],
                                    $data['absencesamedi'], $data['commentairesamedi'], floatval($data['joursamedi']));

                $scheduledimanche = $em->getRepository('CoyoteSiteBundle:Schedule')->updateSchedulefm($scheduledimanche, $data['deplacementdimanche'],
                                    $data['absencedimanche'], $data['commentairedimanche'], floatval($data['jourdimanche']));

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

            if(empty($schedulelundi_id) || empty($schedulemerdi_id) || empty($schedulemercredi_id) || empty($schedulejeudi_id) || empty($schedulevendredi_id)
                || empty($schedulesamedi_id) || empty($scheduledimanche_id))
                $message = "Une erreur s'est produite !";
            else
                $message = "Enregistrement terminé";

            $this->get('session')->getFlashBag()->set('save', $message);

            return $this->redirect($this->generateUrl('coyote_time_index'));
        }
    }

    public function indexshowAction()
    {
        return $this->render('CoyoteSiteBundle:Time:indexshow.html.twig');
    }

    public function showAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
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

            $period = $em->getRepository('CoyoteSiteBundle:Schedule')->findPeriod($mois, $annee);
            $datajour = $em->getRepository('CoyoteSiteBundle:Schedule')->findTime($mois.'/'.$annee, $user);
            $absence = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceMonth($mois.'/'.$annee, $user);
            $absencerttyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "RTT");
            $absencecayear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "CA");
            $absencecpyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "Congés payés");
            $absence = explode(';', $absence);

            if($this->get('security.context')->isGranted('ROLE_CADRE'))
            {
                $daymonth = $em->getRepository('CoyoteSiteBundle:Schedule')->findDayMonth($mois.'/'.$annee, $user);
                $dayyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findDayYear($period, $user);

                return $this->render('CoyoteSiteBundle:Time:showfm.html.twig', array(
                    'data' => $datajour,
                    'rtt' => $absence[1],
                    'ca' => $absence[2],
                    'cp' => $absence[3],
                    'rttyear' => $absencerttyear,
                    'cpyear' => $absencecpyear,
                    'cayear' => $absencecayear,
                    'dayyear' => $dayyear,
                    'daymonth' => $daymonth,
                    ));
            }
            if($this->get('security.context')->isGranted('ROLE_TECH'))
            {
                $indextab = 0;
                $tabnoweek = '';
                $week = $em->getRepository('CoyoteSiteBundle:Schedule')->findNoWeek($mois.'/'.$annee, $user);
                foreach($week as $data)
                {
                    $findno_week = $em->getRepository('CoyoteSiteBundle:Timetable')->myFindScheduleId($data, $annee, $user);
                    if(count($findno_week) > 0)
                    {
                        $tabnoweek[$indextab] = $data;
                        $indextab++;
                    }
                }

                $timeweek = '';
                $index = 0;
                if($tabnoweek != 0)
                {
                    foreach($tabnoweek as $data)
                    {
                        $timeoneweek = $em->getRepository('CoyoteSiteBundle:Schedule')->findTimeWeek($user, $data, $annee);
                        $timeweek[$index] = $timeoneweek;
                        $index++;
                    }
                }
                $timemonth = $em->getRepository('CoyoteSiteBundle:Schedule')->findTimeMonth($mois.'/'.$annee, $user);

                return $this->render('CoyoteSiteBundle:Time:show.html.twig', array(
                    'data' => $datajour,
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
    }

    public function indexprintAction()
    {
        return $this->render('CoyoteSiteBundle:Time:indexprint.html.twig');
    }

    public function printAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $request = Request::createFromGlobals();

        $annee = $_GET['year'];
        $mois = $_GET['month'];

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

            $period = $em->getRepository('CoyoteSiteBundle:Schedule')->findPeriod($mois, $annee);
            $data = $em->getRepository('CoyoteSiteBundle:Schedule')->findTime($mois.'/'.$annee, $user);
            $timemonth = $em->getRepository('CoyoteSiteBundle:Schedule')->findTimeMonth($mois.'/'.$annee, $user);
            $absence = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceMonth($mois.'/'.$annee, $user);
            $absencerttyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "RTT");
            $absencecayear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "CA");
            $absencecpyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsenceYear($period, $user, "Congés payés");

            $absence = explode(';', $absence);
            if($this->get('security.context')->isGranted('ROLE_CADRE'))
            {
                $daymonth = $em->getRepository('CoyoteSiteBundle:Schedule')->findDayMonth($mois.'/'.$annee, $user);
                $dayyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findDayYear($period, $user);

                $page = $this->render('CoyoteSiteBundle:Time:printfm.html.twig', array(
                    'data' => $data,
                    'rtt' => $absence[1],
                    'ca' => $absence[2],
                    'cp' => $absence[3],
                    'rttyear' => $absencerttyear,
                    'cpyear' => $absencecpyear,
                    'cayear' => $absencecayear,
                    'dayyear' => $dayyear,
                    'daymonth' => $daymonth,
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

    public function calculAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $heuresupp = $em->getRepository('CoyoteSiteBundle:Timetable')->calcul();
        return $this->render('CoyoteSiteBundle:Time:test.html.twig', array(

                    'countheure' => $heuresupp,
                    ));
    }

    public function indexprintyearAction()
    {
        return $this->render('CoyoteSiteBundle:Time:indexprintyear.html.twig');
    }

    public function printyearAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $request = Request::createFromGlobals();

        $pay_period = "2014/2015";
        $pay_period = $_GET['pay_period'];


        if(empty($pay_period))
        {
            return $this->redirect($this->generateUrl('coyote_time_indexprint'));
        }
        else
        {
            if(empty($pay_period))
                return $this->render('CoyoteSiteBundle:Time:indexprint.html.twig');
            $user = $em->getRepository('CoyoteSiteBundle:User')->find($session->get('userid'));

            $week = $em->getRepository('CoyoteSiteBundle:Schedule')->findNoWeekPayPeriod($pay_period, $user);
            $timeweek = '';
            $i = 0;
            foreach($week as $data)
            {
                $timeoneweek = $em->getRepository('CoyoteSiteBundle:Schedule')->findTimeWeekPayPeriod($user, $data['year'], $data['no_week'], $pay_period);
                $timeweek[$i] = $timeoneweek;
                $i++;
            }

            $data = $em->getRepository('CoyoteSiteBundle:Schedule')->findTimePayPeriod($pay_period, $user);
            $absencerttyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsencePayPeriod($pay_period, $user, "RTT");
            $absencecayear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsencePayPeriod($pay_period, $user, "CA");
            $absencecpyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findAbsencePayPeriod($pay_period, $user, "Congés payés");
            $dayyear = $em->getRepository('CoyoteSiteBundle:Schedule')->findDayPayPeriod($pay_period, $user);

            if($this->get('security.context')->isGranted('ROLE_CADRE'))
            {
                $page = $this->render('CoyoteSiteBundle:Time:printfmpayperiod.html.twig', array(
                    'data' => $data,
                    'rttyear' => $absencerttyear,
                    'cpyear' => $absencecpyear,
                    'cayear' => $absencecayear,
                    'dayyear' => $dayyear,
                    ));
            }
            else
            {
                 $page = $this->render('CoyoteSiteBundle:Time:printpayperiod.html.twig', array(
                    'data' => $data,
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

