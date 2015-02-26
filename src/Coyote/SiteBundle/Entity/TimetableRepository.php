<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TimetableRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TimetableRepository extends EntityRepository
{
    /**
     * find shedule id
     *
     * @access public
     * @param mixed $no_week
     * @param mixed $year
     * @param mixed $user_id
     * @return array schedule id
     */
    public function myFindScheduleId($no_week, $year, $user_id)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('s.id')
           ->from('CoyoteSiteBundle:Schedule', 's')
           ->innerJoin('CoyoteSiteBundle:Timetable', 't', 'WITH', 't.id = s.timetable')
           ->where('s.user = :user and t.year = :year and t.no_week = :no_week')
           ->setParameters(array('user' => $user_id, 'year' => $year, 'no_week' => $no_week));
        $id_schedule =  $qb->getQuery()
                           ->getResult();

        return $id_schedule;
    }

    /**
     * find timetable id.
     *
     * @access public
     * @param mixed $no_week
     * @param mixed $year
     * @return array timetable id
     */
    public function myFindTimetableId($no_week, $pay_period)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('t.id')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->where('t.no_week = :no_week and t.pay_period = :pay_period')
           ->setParameters(array('no_week' => $no_week, 'pay_period' => $pay_period));
        $timetable_id =  $qb->getQuery()
                            ->getResult();

        return $timetable_id;
    }

    /**
     * find period respect to date function.
     *
     * @access public
     * @param mixed $date
     * @return timetable pay_period
     */
    public function findPeriodByDate($date)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('t.pay_period')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->where('t.date = :date')
           ->setParameters(array('date' => $date));
        return $qb->getQuery()->getSingleScalarResult();
    }

    public function findworkingday($date, $user)
    {
        $datefin = date("Y-m-d H:i:s", mktime(23,59,59,date("m"),0,date("Y")));
        $qb = $this->_em->createQueryBuilder();
        $qb->select('t')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->where('t.date > :date and t.date < :datefin and t.holiday = :holiday and t.day != :day1 and t.day != :day2')
           ->setParameters(array('date' => $date, 'datefin' => $datefin, 'holiday' => '0', 'day1' => 'samedi', 'day2' => 'dimanche'));
        $timetable =  $qb->getQuery()
                         ->getResult();

        return count($timetable);
    }

    public function searchIdDate($date)
    {
        //$date = new \DateTime('NOW');
        $date = new \DateTime($date);
        $result = $date->format('N');
        if ($result > 1)
        {
            $result--;
            $date->modify("-".$result." day");
        }

        $qb = $this->_em->createQueryBuilder();
        $qb->select('t')
            ->from('CoyoteSiteBundle:Timetable', 't')
            ->where('t.date >= :date')
            ->setParameters(array('date' => $date->format('Y-m-d')));
        $data_timetable = $qb->getQuery()
                             ->setMaxResults(7)
                             ->getResult();
        return $data_timetable;
    }

    public function createDateString($datestring)
    {
        $dateexplode = explode('/', $datestring);
        $datecompose = date($dateexplode[2]).'-'.date($dateexplode[1]).'-'.date($dateexplode[0]);
        $date = (new \DateTime($datecompose));
        return $date;
    }

    public function createDateYearWeek($year, $week)
    {
        if(strlen($week) == 1)
            $week = "0".$week;
        $date = date( "Y-m-d", strtotime($year."W".$week."1") );
        return $date;
    }
}
