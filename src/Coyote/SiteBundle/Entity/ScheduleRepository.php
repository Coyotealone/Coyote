<?php

namespace Coyote\SiteBundle\Entity;

use Coyote\SiteBundle\Entity\Timetable;
use Doctrine\ORM\EntityRepository;

/**
 * ScheduleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ScheduleRepository extends EntityRepository
{

    /**
     * computing working time.
     *
     * @access public
     * @param mixed $date
     * @param mixed $user
     * @return string total working time
     */
    public function findTimeMonth($date, $user)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('s.working_time')
           ->from('CoyoteSiteBundle:Schedule', 's')
           ->innerJoin('CoyoteSiteBundle:Timetable', 't', 'WITH', 't.id = s.timetable')
           ->where('s.user = :user and t.date LIKE :date')
           ->setParameters(array('user' => $user, 'date' => '%'.$date.'%'));
        $workingtime_schedule =  $qb->getQuery()
                                    ->getResult();

        $timeend = "0";

        for($i = 0; $i<count($workingtime_schedule); $i++)
        {
            $timeend += $this->calculTime($workingtime_schedule[$i]['working_time']);
        }
        $time = $this->formatTime($timeend);
        return $time;
    }

    /**
     * find pay period .
     *
     * @access public
     * @param mixed $mois
     * @param mixed $annee
     * @return string period
     */
    public function findPeriod($mois, $annee)
    {
        if($mois >= "01" && $mois <= "05")
        {
            $anneebefore = $annee - 1;
            return $anneebefore."/".$annee;
        }
        if($mois >= "06" && $mois <= "12")
        {
            $anneenext = $annee + 1;
            return $annee."/".$anneenext;
        }
    }

    /**
     * find absence in pay period by user and specific absence.
     *
     * @access public
     * @param mixed $pay_period
     * @param mixed $user
     * @param mixed $absence
     * @return integer count absence
     */
    public function findAbsenceYear($pay_period, $user, $absence)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('s.id')
           ->from('CoyoteSiteBundle:Schedule', 's')
           ->innerJoin('CoyoteSiteBundle:Timetable', 't', 'WITH', 't.id = s.timetable')
           ->where('s.user = :user and s.absence = :absence and t.pay_period = :pay_period')
           ->setParameters(array('user' => $user, 'absence' => $absence, 'pay_period' => $pay_period));
        $id_schedule =  $qb->getQuery()
                           ->getResult();

        return count($id_schedule);
    }

    /**
     * conversion time in minutes.
     *
     * @access public
     * @param mixed $time
     * @return integer minutes
     */
    public function calculTime($time)
    {
        $time = explode(":", $time);
        $minute = $time[1];
        $heure = $time[0];
        $timefinal = $heure * 60 + $minute;
        return $timefinal;
    }

    /**
     * conversion time in hours.
     *
     * @access public
     * @param mixed $time
     * @return string
     */
    public function formatTime($time)
    {
        date_default_timezone_set('UTC');
        $time = $time * 60;

        $heures=intval($time / 3600);
        $minutes=intval(($time % 3600) / 60);
        if(strlen($minutes) < 2)
            $minutes = '0'.$minutes;

        return $heures.'h'.$minutes;
    }

    /**
     * find week and year.
     *
     * @access public
     * @param mixed $pay_period
     * @param mixed $user
     * @return array
     */
    public function findNoWeekPayPeriod($pay_period, $user)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('distinct(t.no_week) as no_week, t.year')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->innerJoin('CoyoteSiteBundle:Schedule', 's', 'WITH', 't.id = s.timetable')
           ->where('t.pay_period = :pay_period and s.user = :user')
           ->orderBy('s.timetable')
           ->setParameters(array('pay_period' => $pay_period, 'user' => $user));
        $time =  $qb->getQuery()
                    ->getResult();
        return $time;
    }

    /**
     * pre save schedule for technician user.
     *
     * @access public
     * @param mixed $user
     * @param mixed $timetable_id
     * @param mixed $time_start
     * @param mixed $time_end
     * @param mixed $time_break
     * @param mixed $time_travel
     * @param mixed $time_absence
     * @param mixed $time_comment
     * @return object schedule
     */
    public function saveSchedule($user, $timetable_id, $time_start, $time_end, $time_break, $time_travel, $time_absence, $time_absenceday, $time_absencetime, $time_comment)
    {
        $schedule = new schedule();

        $schedule->setUser($user);
        $schedule->setTimetable($timetable_id);

        if(empty($time_start))
            $time_start = '0:00';
        $schedule->setStart($time_start);

        if(empty($time_end))
            $time_end = '0:00';
        $schedule->setEnd($time_end);

        if(empty($time_break))
            $time_break = '0:00';
        $schedule->setBreak($time_break);

        $timetable = new timetable();

        $working_time_day = $timetable->working_time_day($time_start, $time_end, $time_break);

        $schedule->setWorkingTime($working_time_day);
        $working_hours_day = $timetable->working_hours_day($working_time_day);
        $schedule->setWorkingHours($working_hours_day);
        if($time_travel == "on")
            $time_travel = 1;
        else
            $time_travel = 0;
        $schedule->setTravel($time_travel);
        $schedule->setAbsenceName($time_absence);
        if($time_absenceday == "0.5" || $time_absenceday == "1")
            $schedule->setAbsenceDuration($time_absenceday);
        if($time_absenceday == "empty")
            $schedule->setAbsenceDuration($time_absencetime);
        $schedule->setComment($time_comment);
        return $schedule;
    }

    /**
     * pre update schedule for technician user.
     *
     * @access public
     * @param mixed $schedule
     * @param mixed $time_start
     * @param mixed $time_end
     * @param mixed $time_break
     * @param mixed $time_travel
     * @param mixed $time_absence
     * @param mixed $time_comment
     * @return object schedule
     */
    public function updateSchedule($schedule, $time_start, $time_end, $time_break, $time_travel, $time_absence, $time_absenceday, $time_absencetime, $time_comment)

    {
        $timetable = new timetable();
        $schedule->setStart($time_start);
        $schedule->setEnd($time_end);
        $schedule->setBreak($time_break);
        $working_time_day = $timetable->working_time_day($time_start, $time_end, $time_break);
        $schedule->setWorkingTime($working_time_day);
        $working_hours_day = $timetable->working_hours_day($working_time_day);
        $schedule->setWorkingHours($working_hours_day);
        if($time_travel == "on")
            $time_travel = 1;
        else
            $time_travel = 0;
        $schedule->setTravel($time_travel);
        $schedule->setAbsenceName($time_absence);
        if($time_absenceday == "0.5" || $time_absenceday == "1")
            $schedule->setAbsenceDuration($time_absenceday);
        if($time_absenceday == "empty")
            $schedule->setAbsenceDuration($time_absencetime);
        $schedule->setComment($time_comment);
        return $schedule;
    }

    /**
     * pre save schedule for framework user.
     *
     * @access public
     * @param mixed $user
     * @param mixed $timetable_id
     * @param mixed $time_travel
     * @param mixed $time_absence
     * @param mixed $time_comment
     * @param mixed $day
     * @return object shcedule
     */
    public function saveSchedulefm($user, $timetable_id, $time_travel, $time_absence, $time_absenceday, $time_absencetime, $time_comment, $day)
    {
        $schedule = new schedule();
        $schedule->setUser($user);
        $schedule->setTimetable($timetable_id);
        $schedule->setStart("0:00");
        $schedule->setEnd("0:00");
        $schedule->setBreak("0:00");
        $schedule->setWorkingTime("0:00");
        $schedule->setWorkingHours($day);
        if($time_travel == "on")
            $time_travel = 1;
        else
            $time_travel = 0;
        $schedule->setTravel($time_travel);
        $schedule->setAbsenceName($time_absence);
        if($time_absenceday == "0.5" || $time_absenceday == "1")
            $schedule->setAbsenceDuration($time_absenceday);
        if($time_absenceday == "empty")
            $schedule->setAbsenceDuration($time_absencetime);
        $schedule->setComment($time_comment);
        return $schedule;
    }

    /**
     * pre update schedule for framework user.
     *
     * @access public
     * @param mixed $schedule
     * @param mixed $time_travel
     * @param mixed $time_absence
     * @param mixed $time_comment
     * @param mixed $day
     * @return entity schedule
     */
    public function updateSchedulefm($schedule, $time_travel, $time_absence, $time_absenceday, $time_absencetime, $time_comment, $day)
    {
        $schedule->setWorkingHours($day);
        if($time_travel == "on")
            $time_travel = 1;
        else
            $time_travel = 0;
        $schedule->setTravel($time_travel);
        $schedule->setAbsenceName($time_absence);
        if($time_absenceday == "0.5" || $time_absenceday == "1")
            $schedule->setAbsenceDuration($time_absenceday);
        if($time_absenceday == "empty")
            $schedule->setAbsenceDuration($time_absencetime);$schedule->setComment($time_comment);
        return $schedule;
    }

    /**
     * data schedule for technician user.
     *
     * @access public
     * @param mixed $user
     * @param mixed $date
     * @return array
     */
    public function dataSchedule($user, $date)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('t.day, t.date, s.start, s.end, s.break, s.working_time, s.working_hours, s.travel, s.absence, s.comment , t.holiday')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->innerJoin('CoyoteSiteBundle:Schedule', 's', 'WITH', 't.id = s.timetable')
           ->where('t.date LIKE :date and s.user = :user')
           ->orderBy('s.timetable')
           ->setParameters(array('date' => $date, 'user' => $user));
        $dataschedule =  $qb->getQuery()
                            ->getResult();
        return $dataschedule;
    }

    /**
     * data schedule for framework user .
     *
     * @access public
     * @param mixed $user
     * @param mixed $date
     * @return array
     */
    public function dataScheduleFM($user, $date)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('t.day, t.date, s.working_hours, s.travel, s.absence, s.comment , t.holiday')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->innerJoin('CoyoteSiteBundle:Schedule', 's', 'WITH', 't.id = s.timetable')
           ->where('t.date LIKE :date and s.user = :user')
           ->orderBy('s.timetable')
           ->setParameters(array('date' => $date, 'user' => $user));
        $dataschedule =  $qb->getQuery()
                            ->getResult();
        return $dataschedule;
    }

    /**
     * find count absence
     *
     * @access public
     * @param mixed $date
     * @param mixed $user
     * @param mixed $absence
     * @return integer
     */
    public function absenceMonth($date, $user, $absence)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('COUNT(s.absence)')
           ->from('CoyoteSiteBundle:Schedule', 's')
           ->innerJoin('CoyoteSiteBundle:Timetable', 't', 'WITH', 't.id = s.timetable')
           ->where('s.user = :user and t.date LIKE :date and s.absence = :absence')
           ->setParameters(array('user' => $user, 'date' => $date, 'absence' => $absence));
        $absence_schedule =  $qb->getQuery()->getSingleScalarResult();
        return $absence_schedule;
    }

    /**
     * find count working day in month.
     *
     * @access public
     * @param mixed $date
     * @param mixed $user
     * @return float
     */
    public function findDayMonth($date, $user)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('s.working_hours')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->innerJoin('CoyoteSiteBundle:Schedule', 's', 'WITH', 't.id = s.timetable')
           ->where('t.date LIKE :date and s.user = :user')
           ->setParameters(array('date' => $date, 'user' => $user));
        $data_working_hours = $qb->getQuery()
                                 ->getResult();
        $working_day = 0.0;
        foreach($data_working_hours as $value)
        {
            $working_day = $working_day + $value['working_hours'];
        }
        return $working_day;
    }

    /**
     * find count working day in year
     *
     * @access public
     * @param mixed $period
     * @param mixed $user
     * @return float
     */
    public function findDayYear($period, $user)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('s.working_hours')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->innerJoin('CoyoteSiteBundle:Schedule', 's', 'WITH', 't.id = s.timetable')
           ->where('t.pay_period = :pay_period and s.user = :user')
           ->setParameters(array('pay_period' => $period, 'user' => $user));
        $data_working_hours = $qb->getQuery()
                                 ->getResult();
        $working_day = 0.0;
        foreach($data_working_hours as $value)
        {
            $working_day = $working_day + $value['working_hours'];
        }
        return $working_day;
    }


    /**
     * dataScheduleYear function.
     * data schedule technician user
     *
     * @access public
     * @param mixed $user
     * @param mixed $period
     * @return array
     */
    public function dataScheduleYear($user, $period)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('t.day, t.date, s.start, s.end, s.break, s.working_time, s.working_hours, s.travel, s.absence, s.comment , t.holiday')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->innerJoin('CoyoteSiteBundle:Schedule', 's', 'WITH', 't.id = s.timetable')
           ->where('t.pay_period = :pay_period and s.user = :user')
           ->orderBy('s.timetable')
           ->setParameters(array('pay_period' => $period, 'user' => $user));
        $dataschedule =  $qb->getQuery()
                            ->getResult();
        return $dataschedule;
    }


    /**
     * dataScheduleFMYear function.
     * data schedule framework user
     *
     * @access public
     * @param mixed $user
     * @param mixed $period
     * @return array
     */
    public function dataScheduleFMYear($user, $period)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('t.day, t.date, s.working_hours, s.travel, s.absence, s.comment , t.holiday')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->innerJoin('CoyoteSiteBundle:Schedule', 's', 'WITH', 't.id = s.timetable')
           ->where('t.pay_period = :pay_period and s.user = :user')
           ->orderBy('s.timetable')
           ->setParameters(array('pay_period' => $period, 'user' => $user));
        $dataschedule =  $qb->getQuery()
                            ->getResult();
        return $dataschedule;
    }

    /**
     * find week with date and user.
     *
     * @access private
     * @param mixed $date
     * @param mixed $user
     * @return array timetable no_week
     */
    private function findNoWeek($date, $user)
    {
        $query = $this->getEntityManager()
                      ->createQuery("
                        select distinct(t.no_week) from CoyoteSiteBundle:Timetable t
                        where t.date like :date ");
        $query->setParameters(array('date' => '%'.$date.'%'));

        $timetable_noweek = $query->getResult();

        return $timetable_noweek;
    }

    public function findTimeWeekPayPeriod($user, $year, $week, $pay_period)
    {
        $query = $this->getEntityManager()
                      ->createQuery("
                        select t.id from CoyoteSiteBundle:Timetable t
                        where t.no_week = :week and t.pay_period = :pay_period and t.year = :year");
        $query->setParameters(array('week' => $week, 'pay_period' => $pay_period, 'year' => $year));

        $timetable_id = $query->getResult();

        $nbjour = count($timetable_id);

        if($nbjour == 1)
        {
            $timetable_idstart = $timetable_id[0]['id'];
            $timetable_idend = $timetable_id[0]['id'];
        }
        else
        {
            $timetable_idstart = $timetable_id[0]['id'];
            $timetable_idend = $timetable_id[$nbjour-1]['id'];
        }

        $query = $this->getEntityManager()
                      ->createQuery("
                        SELECT s FROM CoyoteSiteBundle:Schedule s
                        WHERE s.user = :user and s.timetable BETWEEN :time1 and :time2 "
                        );
        $query->setParameters(array(
            'time1' => $timetable_idstart,
            'time2' => $timetable_idend,
            'user' => $user
            ));
        $res = $query->getResult();
        $timeres = 0;
        foreach($res as $data)
        {
            $time = $data->getWorkingtime();
            $timeres += $this->calculTime($time);
        }
        return $this->formatTime($timeres);
    }

    public function findDayPayPeriod($pay_period, $user)
    {
        $year = explode("/", $pay_period);
        $yearend = $year[1];
        $yearstart = $year[0];

        $datedeb = '01/06/'.$yearstart;
        $datefin = '31/05/'.$yearend;

        $qb = $this->_em->createQueryBuilder();
        $qb->select('t')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->where('t.date = :date')
           ->setParameters(array('date' => $datedeb));
        $firstiddate =  $qb->getQuery()
                           ->getResult(); //Id de tous les jours des mois

        $qb = $this->_em->createQueryBuilder();
        $qb->select('t')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->where('t.date = :date')
           ->setParameters(array('date' => $datefin));
        $lastiddate =  $qb->getQuery()
                          ->getResult(); //Id de tous les jours des mois

        $qb = $this->_em->createQueryBuilder();
        $qb->select('s.id')
           ->from('CoyoteSiteBundle:Schedule', 's')
           ->where('s.working_hours = :value and s.user = :user and s.timetable BETWEEN :datedeb and :datefin')
           ->setParameters(array('datedeb' => $firstiddate, 'datefin' => $lastiddate, 'value' => 1, 'user' => $user));
        $res = $qb->getQuery()
                  ->getResult(); //Id de tous les jours des mois

        return count($res);
    }

    public function findTimebyWeek($user, $week, $year)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('t.id')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->where('t.no_week = :week and t.year = :year')
           ->setParameters(array('week' => $week, 'year' => $year));

        $timetable_id =  $qb->getQuery()
                            ->getResult();
        $nbjour = count($timetable_id);

        $timetable_idstart = $timetable_id[0]['id'];
        $timetable_idend = $timetable_id[$nbjour-1]['id'];

        $query = $this->getEntityManager()
                      ->createQuery("
                        SELECT s FROM CoyoteSiteBundle:Schedule s
                        WHERE s.user = :user and s.timetable BETWEEN :time1 and :time2 "
                        );
        $query->setParameters(array(
            'time1' => $timetable_idstart,
            'time2' => $timetable_idend,
            'user' => $user
            ));
        $res = $query->getResult();
        $timeres = 0;
        $result = "\r\n";
        foreach($res as $data)
        {
            $result .= $data->getTimetable()->getDay().';'.$data->getTimetable()->getDate().';';
            $result .= $data->getStart().";".$data->getEnd().";".$data->getBreak().";".$data->getWorkingTime().";".$data->getWorkingHours().";";
            $result .= $data->getTravel().";".$data->getAbsence().";".$data->getComment().";\r\n";

            $time = $data->getWorkingtime();
            $timeres += $this->calculTime($time);
        }
        if($timeres > 0)
            $result .= "Temps de travail de la semaine : ".$this->formatTime($timeres).";\r\n\r\n";
        return $result;
    }

    public function findTimePayPeriod($pay_period, $user)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('t.id')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->where('t.pay_period = :pay_period')
           ->setParameters(array('pay_period' => $pay_period));

        $timetable_id =  $qb->getQuery()
                            ->getResult();
        $nbjour = count($timetable_id);

        $query = $this->getEntityManager()
                      ->createQuery("
                        SELECT s FROM CoyoteSiteBundle:Schedule s
                        WHERE s.user = :user and s.timetable BETWEEN :time1 and :time2 ORDER BY s.timetable"
                        );
        $query->setParameters(array(
            'time1' => $timetable_id[0]['id'],
            'time2' => $timetable_id[$nbjour-1]['id'],
            'user' => $user
            ));
        return $query->getResult();

    }

    public function findforBE($user, $date, $year, $user_name)
    {
        $week = $this->findNoWeek($date, $user);
        $result = $user_name;

        foreach($week as $data)
        {
            $result .= $this->findTimebyWeek($user, $data, $year);
        }
        return $result;
    }

}