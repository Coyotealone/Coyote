<?php

namespace Coyote\SiteBundle\Entity;

use Coyote\SiteBundle\Entity\Timetable;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * ScheduleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ScheduleRepository extends EntityRepository
{
    /***********************getScheduleUserAction**********************/
    
    /**
     * Function to synchronize id Timetable about a same id array time.
     * @param array $time Array data Schedule
     * @param array $data_timetable Array id Timetable
     * @return array $duration Array with absence duration Schedule
     */
    public function initGetSchedule($time, $data_timetable, $session)
    {
        $j = 0;
        $duration = array();
        for($i=0;$i<count($time);$i++)
        {
            if (count($time[$j])>0)
            {
                if ($data_timetable[$i]->getId() == $time[$j]->getTimetable()->getId())
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
        return $duration;
    }
    
    /**
     * Function to find data about user and timetable.
     * @access public
     * @param Timetable $timetable
     * @param User $user
     * @return null if no data, else array with data schedule
     */
    public function timeData($timetable, $user )
    {
        $index = 0;
        $time = null;
        foreach($timetable as $data)
        {
            $qb = $this->_em->createQueryBuilder();
            $qb->select('s')
            ->from('CoyoteSiteBundle:Schedule', 's')
            ->where('s.user = :user and s.timetable = :timetable')
            ->setParameters(array('user' => $user, 'timetable' => $data));
            $result = $qb->getQuery()->getOneOrNullResult();
            if($result == null)
                $time[$index] = array();
            else
                $time[$index] = $result;
            $index++;
        }
        return $time;
    }
    
    /******************weeklessAction**weekmoreAction******************/
    
    /**
     * Function to update week and period.
     * @access public
     * @param string $value "less" or "more"
     */
    public function updateWeek($value, $session)
    {
        $week = $session->get('week');
        $year = $session->get('year');
        if ($value == "less")
        {
            if ($week == 1)
            {
                $week = 52;
                $year--;
            }
            else
            {
                $week--;
            }
        }
        if ($value == "more")
        {
            if ($week == 52)
            {
                $week = 1;
                $year++;
            }
            else
            {
                $week++;
            }
        }
        $session->set('week', $week);
        $session->set('year', $year);
    }
    
    /**********************postScheduleUserAction**********************/
    
    /**
     * Function to save Schedule for technician user.
     * @access public
     * @param User $user
     * @param Timetable $timetable
     * @param string $time_start
     * @param string $time_end
     * @param string $time_break
     * @param boolean $time_travel
     * @param string $time_absence
     * @param float $time_absenceday
     * @param string $time_absencetime
     * @param string $time_comment
     * @return NULL if you don't need save entity else return entity Schedule
     */
    public function saveSchedule($user, $timetable, $time_start, $time_end, $time_break, $time_travel, $time_absence,
            $time_absenceday, $time_absencetime, $time_comment)
    {
        if (empty($time_start) && empty($time_end) && empty($time_break) && empty($time_travel) && empty($time_comment)
                && ($time_absence == "Aucune"))
        {
            return null;
        }
        else 
        {
            $schedule = new Schedule();
            $schedule->setUser($user);
            $schedule->setTimetable($timetable);
            if (empty($time_start))
                $time_start = '0:00';
            $schedule->setStart($time_start);
            if (empty($time_end))
                $time_end = '0:00';
            $schedule->setEnd($time_end);
            if (empty($time_break))
                $time_break = '0:00';
            $schedule->setBreak($time_break);
            $timetable = new Timetable();
            $working_time_day = $timetable->working_time_day($time_start, $time_end, $time_break);
            $schedule->setWorkingTime($working_time_day);
            $working_hours_day = $timetable->working_hours_day($working_time_day);
            $schedule->setWorkingHours($working_hours_day);
            if ($time_travel == "on")
                $time_travel = 1;
            else
                $time_travel = 0;
            $schedule->setTravel($time_travel);
            $schedule->setAbsenceName($time_absence);
            if ($time_absence == "Aucune")
            {
                $schedule->setAbsenceDuration("");
            }
            else
            {
                if ($time_absenceday == "0.5" || $time_absenceday == "1")
                    $schedule->setAbsenceDuration($time_absenceday);
                if ($time_absenceday == "empty")
                    $schedule->setAbsenceDuration($time_absencetime);
            }
            $schedule->setComment($time_comment);
            return $schedule;
        }
    }
    
    /**
     * Function to update Schedule for techician user.
     * @param Schedule $schedule
     * @param string $time_start
     * @param string $time_end
     * @param string $time_break
     * @param boolean $time_travel
     * @param string $time_absence
     * @param float $time_absenceday
     * @param string $time_absencetime
     * @param string $time_comment
     * @return Schedule
     */
    public function updateSchedule($schedule, $time_start, $time_end, $time_break, $time_travel, $time_absence,
            $time_absenceday, $time_absencetime, $time_comment)
    {
        $timetable = new Timetable();
        if (empty($time_start))
            $time_start = '0:00';
        if (empty($time_end))
            $time_end = '0:00';
        if (empty($time_break))
            $time_break = '0:00';
        $schedule->setBreak($time_break);
        $schedule->setStart($time_start);
        $schedule->setEnd($time_end);
        $schedule->setBreak($time_break);
        $working_time_day = $timetable->working_time_day($time_start, $time_end, $time_break);
        $schedule->setWorkingTime($working_time_day);
        $working_hours_day = $timetable->working_hours_day($working_time_day);
        $schedule->setWorkingHours($working_hours_day);
        if ($time_travel == "on")
            $time_travel = 1;
        else
            $time_travel = 0;
        $schedule->setTravel($time_travel);
        $schedule->setAbsenceName($time_absence);
        if ($time_absence == "Aucune")
        {
            $schedule->setAbsenceDuration("");
        }
        else
        {
            if ($time_absenceday == "0.5" || $time_absenceday == "1")
                $schedule->setAbsenceDuration($time_absenceday);
            if ($time_absenceday == "empty")
                $schedule->setAbsenceDuration($time_absencetime);
        }
        $schedule->setComment($time_comment);
        return $schedule;
    }
    
    /**
     * Function to save Schedule for framework user.
     * @access public
     * @param User $user
     * @param Timetable $timetable
     * @param boolean $time_travel
     * @param string $time_absence
     * @param float $time_absenceday
     * @param string $time_absencetime
     * @param string $time_comment
     * @param float $day
     * @return NULL if you don't need save entity else return entity Schedule
     */
    public function saveSchedulefm($user, $timetable, $time_travel, $time_absence, $time_absenceday,
            $time_absencetime, $time_comment, $day)
    {
        if (empty($day) && empty($time_travel) && empty($time_comment)
                && ($time_absence == "Aucune"))
        {
            return null;
        }
        else 
        {
            $schedule = new Schedule();
            $schedule->setUser($user);
            $schedule->setTimetable($timetable);
            $schedule->setStart("0:00");
            $schedule->setEnd("0:00");
            $schedule->setBreak("0:00");
            $schedule->setWorkingTime("0:00");
            $schedule->setWorkingHours($day);
            if ($time_travel == "on")
                $time_travel = 1;
            else
                $time_travel = 0;
            $schedule->setTravel($time_travel);
            $schedule->setAbsenceName($time_absence);
            if($time_absenceday == "0.5" || $time_absenceday == "1")
                $schedule->setAbsenceDuration($time_absenceday);
            if ($time_absenceday == "empty")
            {
                if($time_absencetime == "undef")
                    $schedule->setAbsenceDuration('');
                else
                    $schedule->setAbsenceDuration($time_absencetime);
            }
            $schedule->setComment($time_comment);
            return $schedule;
        }
    }
    
    /**
     * Function to update Schedule for framework user.
     * @access public
     * @param Schedule $schedule
     * @param boolean $time_travel
     * @param string $time_absence
     * @param float $time_absenceday
     * @param string $time_absencetime
     * @param string $time_comment
     * @param float $day
     * @return Schedule
     */
    public function updateSchedulefm($schedule, $time_travel, $time_absence, $time_absenceday, $time_absencetime,
            $time_comment, $day)
    {
        $schedule->setWorkingHours($day);
        if ($time_travel == "on")
            $time_travel = 1;
        else
            $time_travel = 0;
        $schedule->setTravel($time_travel);
        $schedule->setAbsenceName($time_absence);
        if($time_absenceday == "0.5" || $time_absenceday == "1")
            $schedule->setAbsenceDuration($time_absenceday);
        if ($time_absenceday == "empty")
        {
            if($time_absencetime == "undef")
                $schedule->setAbsenceDuration('');
            else
                $schedule->setAbsenceDuration($time_absencetime);
        }
        $schedule->setComment($time_comment);
        return $schedule;
    }
    
    /*************************getScheduleAction************************/
    
    /**
     * Function to find period about month and year.
     * @param string $month
     * @param string $year
     * @return string $period
     */
    public function findPeriod($month, $year)
    {
        $period = "";
        if ($month >= "01" && $month <= "05")
        {
            $previous_year = $year - 1;
            $period = $previous_year."/".$year;
        }
        if ($month >= "06" && $month <= "12")
        {
            $following_year = $year + 1;
            $period = $year."/".$following_year;
        }
        return $period;
    }
    
    /**
     * Function to count number absence.
     * @access public
     * @param datetime $date
     * @param User $user
     * @param string $absence
     * @return number
     */
    public function absenceMonth($date, $user, $absence)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('s.absence_duration')
           ->from('CoyoteSiteBundle:Schedule', 's')
           ->innerJoin('CoyoteSiteBundle:Timetable', 't', 'WITH', 't.id = s.timetable')
           ->where('s.user = :user and t.date LIKE :date and s.absence_name = :absence')
           ->setParameters(array('user' => $user, 'date' => $date, 'absence' => $absence));
        $data_absence_duration = $qb->getQuery()
                                    ->getResult();
        $count_absence = 0.0;
        for($i = 0; $i<count($data_absence_duration);$i++)
        {
            $count_absence += $data_absence_duration[$i]['absence_duration'];
        }
        return $count_absence;
    }
    
    /**
     * Function to count number absence about a period by user and specific absence.
     * @access public
     * @param string $period
     * @param User $user
     * @param string $absence
     * @return number
     */
    public function findAbsenceYear($period, $user, $absence)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('s.absence_duration')
           ->from('CoyoteSiteBundle:Schedule', 's')
           ->innerJoin('CoyoteSiteBundle:Timetable', 't', 'WITH', 't.id = s.timetable')
           ->where('s.user = :user and t.period = :period and s.absence_name = :absence')
           ->setParameters(array('user' => $user, 'period' => $period, 'absence' => $absence));
        $data_absence_duration = $qb->getQuery()
                                    ->getResult();
        $count_absence = 0.0;
        for($i = 0; $i<count($data_absence_duration);$i++)
        {
            $count_absence += $data_absence_duration[$i]['absence_duration'];
        }
    
        return $count_absence;
    }
    
    /**
     * Function to count working hours in month.
     * @access public
     * @param string $date
     * @param User $user
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
     * Function to count working hours in period.
     * @access public
     * @param mixed $period
     * @param mixed $user
     * @return number
     */
    public function findDayYear($period, $user)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('s.working_hours')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->innerJoin('CoyoteSiteBundle:Schedule', 's', 'WITH', 't.id = s.timetable')
           ->where('t.period = :period and s.user = :user')
           ->setParameters(array('period' => $period, 'user' => $user));
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
     * Function to calculate working time by week.
     * @access public
     * @param Schedule $dataschedule
     * @return string $timeweek if $dataschedule is empty $timeweek = ''
     * else $timeweek is string format 'hh:mm'
     */
    public function timeWeek($dataschedule)
    {
        if(count($dataschedule)>0)
        {
            $week = $dataschedule[0]['date']->format('W');
            $index = 0;
            $value = 0;
            $timeweek = '';
            $count_item = count($dataschedule)-1;
            for($i=0;$i<count($dataschedule);$i++)
            {
                if ($week == $dataschedule[$i]['date']->format('W'))
                {
                    $value += $this->calculTime($dataschedule[$i]['working_time']);
                    $week = $dataschedule[$i]['date']->format('W');
                }
                if ($count_item == $i)
                {
                    $timeweek[$index] = $this->formatTime($value);
                    $value=0;
                    $index++;
                    $value += $this->calculTime($dataschedule[$i]['working_time']);
                    $timeweek[$index] = $this->formatTime($value);
                }
                if ($week != $dataschedule[$i]['date']->format('W'))
                {
                    $timeweek[$index] = $this->formatTime($value);
                    $value=0;
                    $index++;
                    $value += $this->calculTime($dataschedule[$i]['working_time']);
                    $week = $dataschedule[$i]['date']->format('W');
                }
            }
        }
        else
        {
            $timeweek = '';
        }
        return $timeweek;
    }
    
    /**
     * Function to count working time by month.
     * @access public
     * @param string $date
     * @param User $user
     * @return string total working time
     */
    public function findTimeMonth($date, $user)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('s.working_time')
           ->from('CoyoteSiteBundle:Schedule', 's')
           ->innerJoin('CoyoteSiteBundle:Timetable', 't', 'WITH', 't.id = s.timetable')
           ->where('s.user = :user and t.date LIKE :date')
           ->setParameters(array('user' => $user, 'date' => $date));
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
     * Function to find data schedule for technician user by month.
     * @access public
     * @param User $user
     * @param string $date
     * @return Schedule
     */
    public function dataSchedule($user, $date)
    {
        $date = $date."%";
        $qb = $this->_em->createQueryBuilder();
        $qb->select('t.date, s.start, s.end, s.break, s.working_time, s.working_hours, s.travel, s.absence_name,
            s.absence_duration, s.comment , t.holiday')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->innerJoin('CoyoteSiteBundle:Schedule', 's', 'WITH', 't.id = s.timetable')
           ->where('t.date LIKE :date and s.user = :user ')
           ->orderBy('s.timetable')
           ->setParameters(array('date' => $date, 'user' => $user, ));
        $dataschedule =  $qb->getQuery()
                            ->getResult();
        return $dataschedule;
    }
    
    /**
     * Function to find data schedule for framework user by month.
     * @access public
     * @param User $user
     * @param string $date
     * @return Schedule
     */
    public function dataScheduleFM($user, $date)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('t.date, s.working_hours, s.travel, s.absence_name, s.absence_duration, s.comment,
            t.holiday')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->innerJoin('CoyoteSiteBundle:Schedule', 's', 'WITH', 't.id = s.timetable')
           ->where('t.date LIKE :date and s.user = :user')
           ->orderBy('s.timetable')
           ->setParameters(array('date' => $date, 'user' => $user));
        $dataschedule =  $qb->getQuery()
                            ->getResult();
        return $dataschedule;
    }
    
    /************************Absence:indexAction***********************/
    
    /**
     * Get the paginated list of absences in Schedule Entity.
     *
     * @param int $page
     * @param int $maxperpage
     * @param string $sortby
     * @return Paginator
     */
    public function getListAbsenceUser($user, $page=1, $maxperpage=10)
    {
        $q = $this->_em->createQueryBuilder()
                  ->select('s')
                  ->from('CoyoteSiteBundle:Schedule','s')
                  ->where('s.user = :user and not s.absence_name =:absence')
                  ->setParameters(array('user' => $user, 'absence' => 'Aucune' ));
         
        $q->setFirstResult(($page-1) * $maxperpage)
          ->setMaxResults($maxperpage);
        return new Paginator($q);
    }
    
    /**
     * Function to find absence by User.
     * @param User $user
     * @return Schedule $entities
     */
    public function absenceByUser($user)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('s')
        ->from('CoyoteSiteBundle:Schedule', 's')
        ->where('s.user = :user and not s.absence_name = :absence')
        ->setParameters(array(
                        'user' => $user,
                        'absence'  => 'Aucune',
        ));
        $entities = $qb->getQuery()->getResult();
        return $entities;
    }
    
    /*******************Admin:exportDataUserAction******************/    
    
    /**
     * Function to retrieve data user about a date.
     * @param User $user
     * @param string $date date format 'Y-m-%'
     * @return Schedule Entity
     */
    public function dataFileBE($user, $date)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('t.date, s.start, s.end, s.break, s.working_time, s.working_hours, s.comment,
            s.travel, s.absence_name, s.absence_duration')
                ->from('CoyoteSiteBundle:Timetable', 't')
                ->innerJoin('CoyoteSiteBundle:Schedule', 's', 'WITH', 't.id = s.timetable')
                ->where('t.date LIKE :date and s.user = :user')
                ->setParameters(array('date' => $date, 'user' => $user));
        $timetableschedule = $qb->getQuery()->getResult();
        return $timetableschedule;
    }
    
    /**
     * Function to generate file for Chef_BE with data users.
     * @param array $tab_user_id Id User who work to Chef_BE
     * @param string $month
     * @param string $year
     * @return string data users
     */
    public function fileDataUserBE($tab_user_id, $month, $year)
    {
        $result = "";
        $week = 0;
        foreach($tab_user_id as $user_id)
        {
            $timetableschedule = $this->dataFileBE($user_id, $year.'-'.$month.'-%');
            $timeres = 0;
            $user_name = $this->nameUser($user_id);
            $result .= $user_name[0]['name'].";\r\n\r\n";
            foreach($timetableschedule as $data)
            {
                if($week != 0 && $data['date']->format('W') != $week)
                {
                    $result .= "Temps de travail de la semaine : ".$this->formatTime($timeres).";\r\n\r\n";
                    $timeres = 0;
                }
                $week = $data['date']->format('W');
                $result .= $data['date']->format('l').';'.$data['date']->format('Y-m-d').';';
                $result .= $data['start'].";".$data['end'].";".$data['break'].";".$data['working_time'].";";
                $result .= $data['working_hours'].";";
                $result .= $data['travel'].";".$data['absence_name'].";".$data['absence_duration'].";".$data['comment'].";\r\n";
                $timeres += $this->calculTime($data['working_time']).";\r\n";
                if ($data === end($timetableschedule))
                {
                    $result .= "Temps de travail de la semaine : ".$this->formatTime($timeres).";\r\n\r\n";
                    $timeres = 0;
                }
            }
        }
        return $result;
    }
    
    /*****************************Commun****************************/
    
    /**
     * Function to convert time in minutes.
     * @access public
     * @param string $time
     * @return number integer minutes
     */
    public function calculTime($time)
    {
        if ($time == "0:00")
            return 0;
        $time = explode(":", $time);
        $minute = $time[1];
        $heure = $time[0];
        $timefinal = $heure * 60 + $minute;
        return $timefinal;
    }
    
    /**
     * Function to convert time in hours.
     *
     * @access public
     * @param mixed $time
     * @return string format hh:mm
     */
    public function formatTime($time)
    {
        date_default_timezone_set('UTC');
        $time = $time * 60;
        $heures=intval($time / 3600);
        $minutes=intval(($time % 3600) / 60);
        if (strlen($minutes) < 2)
        {
            $minutes = '0'.$minutes;
        }
        return $heures.'h'.$minutes;
    }
    
    /******************************************************************/
    /***********************Anciennes Fonctions************************/
    /******************************************************************/
    
    

    

    /**
     * find week and year.
     *
     * @access public
     * @param mixed $pay_period
     * @param mixed $user
     * @return array pay_period, user
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
     * dataScheduleYear function.
     * data schedule technician user
     *
     * @access public
     * @param mixed $user
     * @param mixed $period
     * @return array Schedule, Timetable
     */
    public function dataScheduleYear($user, $period)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('t.date, s.start, s.end, s.break, s.working_time, s.working_hours, s.travel, s.absence_name,
            s.absence_duration, s.comment , t.holiday')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->innerJoin('CoyoteSiteBundle:Schedule', 's', 'WITH', 't.id = s.timetable')
           ->where('t.period = :period and s.user = :user')
           ->orderBy('s.timetable')
           ->setParameters(array('period' => $period, 'user' => $user));
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
     * @return array Schedule, Timetable
     */
    public function dataScheduleFMYear($user, $period)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('t.date, s.working_hours, s.travel, s.absence_name, s.absence_duration, s.comment ,
            t.holiday')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->innerJoin('CoyoteSiteBundle:Schedule', 's', 'WITH', 't.id = s.timetable')
           ->where('t.period = :period and s.user = :user')
           ->orderBy('s.timetable')
           ->setParameters(array('period' => $period, 'user' => $user));
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
     * @return array Timetable no_week
     */
    private function findNoWeek($date)
    {
        $query = $this->getEntityManager()
                      ->createQuery("
                        select distinct(t.no_week) from CoyoteSiteBundle:Timetable t
                        where t.date_name like :date ");
        $query->setParameters(array('date' => $date));

        $timetable_noweek = $query->getResult();

        return $timetable_noweek;
    }

    /**
     * sumWorkingTimeMonth function.
     * function to calculate working time by month
     *
     * @access public
     * @param mixed $date
     * @param mixed $user
     * @return string
     */
    public function sumWorkingTimeMonth($date, $user)
    {
        $datefin = date("Y-m-d H:i:s", mktime(23,59,59,date("m"),0,date("Y")));
        $qb = $this->_em->createQueryBuilder();
        $qb->select('s.working_time')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->innerJoin('CoyoteSiteBundle:Schedule', 's', 'WITH', 't.id = s.timetable')
           ->where('t.date > :date and t.date < :datefin and s.user = :user')
           ->setParameters(array('date' => $date, 'user' => $user, 'datefin' => $datefin));
        $working_time_month =  $qb->getQuery()
                                  ->getResult();
        $timetotal = "";
        for($i=0;$i<count($working_time_month);$i++)
        {
            $timetotal += $this->calculTime($working_time_month[$i]['working_time']);
        }
        return $this->formatTimeDB($timetotal);
    }

    /**
     * formatTimeDB function.
     * convert string in datetime
     *
     * @access public
     * @param mixed $time
     * @return void
     */
    public function formatTimeDB($time)
    {
        date_default_timezone_set('UTC');
        $time = $time * 60;

        $heures=intval($time / 3600);
        $minutes=intval(($time % 3600) / 60);
        if(strlen($minutes) < 2)
            $minutes = '0'.$minutes;

        return $heures.':'.$minutes;
    }

    /**
     * countAbsence function.
     * function to calculate working day
     *
     * @access public
     * @param mixed $date
     * @param mixed $user
     * @return integer
     */
    public function countAbsence($user)
    {
        $date = new \DateTime();

        $qb = $this->_em->createQueryBuilder();
        $qb->select('t')
            ->from('CoyoteSiteBundle:Timetable', 't')
            ->where('t.date = :date')
            ->setParameters(array('date' => $date->format('Y-m-d')));
        $data_date = $qb->getQuery()->getOneOrNullResult();
        $qb = $this->_em->createQueryBuilder();
        $qb->select('t')
            ->from('CoyoteSiteBundle:Timetable', 't')
            ->where('t.period = :period')
            ->orderBy('t.id', 'ASC')
            ->setParameters(array('period' => $data_date->getPeriod()));
        $data_date = $qb->getQuery()->getResult();
        $datefin = date("Y-m-d H:i:s", mktime(23,59,59,date("m"),0,date("Y")));
        $qb = $this->_em->createQueryBuilder();
        $qb->select('t')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->innerJoin('CoyoteSiteBundle:Schedule', 's', 'WITH', 't.id = s.timetable')
           ->where('t.holiday = :holiday and s.user = :user and
                s.absence_name != :absence1 and s.absence_name != :absence2 and t.date BETWEEN :date and :datefin')
           ->setParameters(array('date' => $data_date[0]->getDate()->format('Y-m-d'), 'datefin' => $datefin, 'holiday' => '0','user' => $user,
                'absence1' => 'Aucune', 'absence2' => 'Recup'));
        $timetable =  $qb->getQuery()
                         ->getResult();
        return count($timetable);
    }

    

    /**
     * nameUser function.
     *
     * @access public
     * @param mixed $user
     * @return string
     */
    public function nameUser($user)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u.name')
               ->from('CoyoteSiteBundle:User', 'u')
               ->where('u.id = :user')
               ->setParameters(array('user' => $user));
        $user_name = $qb->getQuery()->getResult();
        return $user_name;
    }

     public function calculOvertimeTech($user, $count_time, $count_absence)
    {
        $date = new \DateTime();
        $date = $date->sub(date_interval_create_from_date_string('1 days'));

        $qb = $this->_em->createQueryBuilder();
        $qb->select('t')
            ->from('CoyoteSiteBundle:Timetable', 't')
            ->where('t.date = :date')
            ->setParameters(array('date' => $date->format('Y-m-d')));
        $data_date = $qb->getQuery()->getOneOrNullResult();

        $period = $data_date->getPeriod();

        $qb = $this->_em->createQueryBuilder();
        $qb->select('s.working_time')
           ->from('CoyoteSiteBundle:Schedule', 's')
           ->innerJoin('CoyoteSiteBundle:Timetable', 't', 'WITH', 't.id = s.timetable')
           ->where('s.user = :user and t.date < :date and t.period = :period')
           ->setParameters(array('user' => $user, 'date' => $date, 'period' => $period));
        $workingtime_schedule =  $qb->getQuery()
                                    ->getResult();

        $nb_work = 0;
        for($i=0;$i<count($workingtime_schedule);$i++)
        {
            $nb_work += $this->calculTime($workingtime_schedule[$i]['working_time']);
        }

        $qb2 = $this->_em->createQueryBuilder();
        $qb2->select('s.absence_duration')
           ->from('CoyoteSiteBundle:Schedule', 's')
           ->innerJoin('CoyoteSiteBundle:Timetable', 't', 'WITH', 't.id = s.timetable')
           ->where('s.user = :user and t.date < :date and t.period = :period and s.absence_name = :absence')
           ->setParameters(array('user' => $user, 'date' => $date, 'period' => $period, 'absence' => "Recup"));
        $absence_duration_schedule =  $qb2->getQuery()
                                    ->getResult();

        $nb_hs = 0;
        for($i=0;$i<count($absence_duration_schedule);$i++)
        {
            $nb_hs += $this->calculTime($absence_duration_schedule[$i]['absence_duration']);
        }
        $count_time = $count_time - $count_absence;
        $count_time = $count_time * 7;
        $time_month = $count_time * 60;
        $nb_work = $nb_work - $nb_hs;
        //$time_work = $this->calculTime($result);
        $difference = $nb_work - $time_month;
        return $this->formatTime($difference);
    }

    /**
     * calculOvertime function.
     *
     * @access public
     * @param mixed $count_time
     * @param mixed $working_time_month
     * @param mixed $count_absence
     * @return string
     */
    public function calculOvertime($count_time, $working_time_month, $count_absence)
    {
        $value_month = array(1 => 8, 2=> 9, 3 => 10, 4=> 11, 5 => 12, 6=> 1, 7 => 2, 8=> 3, 9 => 4, 10=> 5, 11 => 6,
            12=> 7);
        $month = date("n");
        if($month == 1)
            $month = 12;
        else
            $month--;

        $count_time = $count_time - $count_absence - (5*$value_month[$month]);
        $count_time = $count_time * 7;
        $time_month = $count_time * 60;
        $time_work = $this->calculTime($working_time_month);
        $difference = $time_work - $time_month;
        return $this->formatTime($difference);
    }
}