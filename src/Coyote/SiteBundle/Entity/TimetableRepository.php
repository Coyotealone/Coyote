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
    /*public function myFindDate($no_week, $year)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('t')//.date')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->where('t.no_week = :no_week and t.year = :year')
           ->setParameters(array('no_week' => $no_week, 'year' => $year));
        
        $date =  $qb->getQuery()
                    ->getResult();
        return $date;
    }
    
    public function myFindTime($no_week, $year, $user_id)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('t.id')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->where('t.no_week = :no_week and t.year = :year')
           ->setParameters(array('no_week' => $no_week, 'year' => $year));
        
        $timetable_id =  $qb->getQuery()
                            ->getResult();
        $qb = $this->_em->createQueryBuilder();
        $qb->select('s.start, s.end, s.break, s.working_time, s.working_hours, s.travel, s.absence, s.comment')
           ->from('CoyoteSiteBundle:Schedule', 's')
           ->where('s.user = :user_id and s.timetable BETWEEN :timetable_id and :timetable_id2')
           ->setParameters(array('timetable_id' => $timetable_id[0]['id'], 'user_id'=> $user_id, 'timetable_id2' => $timetable_id[6]['id']));
        
        $time =  $qb->getQuery()
                    ->getResult();
        return $time;
    }*/

    public function myFindScheduleId($no_week, $year, $user_id)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('t.id')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->where('t.no_week = :no_week and t.year = :year')
           ->setParameters(array('no_week' => $no_week, 'year' => $year));
        $timetable_id =  $qb->getQuery()
                            ->getResult();
        
        $qb = $this->_em->createQueryBuilder();
        $qb->select('s.id')
           ->from('CoyoteSiteBundle:Schedule', 's')
           ->where('s.user = :user_id and s.timetable BETWEEN :timetable_id and :timetable_id2')
           ->setParameters(array('timetable_id' => $timetable_id[0]['id'], 'user_id'=> $user_id, 'timetable_id2' => $timetable_id[6]['id']));
        
        $id =  $qb->getQuery()
                  ->getResult();
        return $id;
    }
    
    public function myFindTimetableId($no_week, $year)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('t.id')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->where('t.no_week = :no_week and t.year = :year')
           ->setParameters(array('no_week' => $no_week, 'year' => $year));
        $timetable_id =  $qb->getQuery()
                            ->getResult();
        
        return $timetable_id;
    }
    
    public function myFindTravel($no_week, $year, $user_id)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('t.id')
           ->from('CoyoteSiteBundle:Timetable', 't')
           ->where('t.no_week = :no_week and t.year = :year')
           ->setParameters(array('no_week' => $no_week, 'year' => $year));
        $timetable_id =  $qb->getQuery()
                            ->getResult();
        $qb = $this->_em->createQueryBuilder();
        $qb->select('s.travel')
           ->from('CoyoteSiteBundle:Schedule', 's')
           ->where('s.user = :user_id and s.timetable BETWEEN :timetable_id and :timetable_id2')
           ->setParameters(array('timetable_id' => $timetable_id[0]['id'], 'user_id'=> $user_id, 'timetable_id2' => $timetable_id[6]['id']));
        
        $travel =  $qb->getQuery()
                  ->getResult();
        return $travel;
    }
    
}
