<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Schedule
 */
class Schedule
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $start;

    /**
     * @var string
     */
    private $end;

    /**
     * @var string
     */
    private $break;

    /**
     * @var string
     */
    private $working_time;

    /**
     * @var float
     */
    private $working_hours;

    /**
     * @var boolean
     */
    private $travel;

    /**
     * @var string
     */
    private $absence;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var \Coyote\SiteBundle\Entity\User
     */
    private $user;

    /**
     * @var \Coyote\SiteBundle\Entity\Timetable
     */
    private $timetable;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set start
     *
     * @param string $start
     * @return Schedule
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return string 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param string $end
     * @return Schedule
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return string 
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set break
     *
     * @param string $break
     * @return Schedule
     */
    public function setBreak($break)
    {
        $this->break = $break;

        return $this;
    }

    /**
     * Get break
     *
     * @return string 
     */
    public function getBreak()
    {
        return $this->break;
    }

    /**
     * Set working_time
     *
     * @param string $workingTime
     * @return Schedule
     */
    public function setWorkingTime($workingTime)
    {
        $this->working_time = $workingTime;

        return $this;
    }

    /**
     * Get working_time
     *
     * @return string 
     */
    public function getWorkingTime()
    {
        return $this->working_time;
    }

    /**
     * Set working_hours
     *
     * @param float $workingHours
     * @return Schedule
     */
    public function setWorkingHours($workingHours)
    {
        $this->working_hours = $workingHours;

        return $this;
    }

    /**
     * Get working_hours
     *
     * @return float 
     */
    public function getWorkingHours()
    {
        return $this->working_hours;
    }

    /**
     * Set travel
     *
     * @param boolean $travel
     * @return Schedule
     */
    public function setTravel($travel)
    {
        $this->travel = $travel;

        return $this;
    }

    /**
     * Get travel
     *
     * @return boolean 
     */
    public function getTravel()
    {
        return $this->travel;
    }

    /**
     * Set absence
     *
     * @param string $absence
     * @return Schedule
     */
    public function setAbsence($absence)
    {
        $this->absence = $absence;

        return $this;
    }

    /**
     * Get absence
     *
     * @return string 
     */
    public function getAbsence()
    {
        return $this->absence;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Schedule
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set user
     *
     * @param \Coyote\SiteBundle\Entity\User $user
     * @return Schedule
     */
    public function setUser(\Coyote\SiteBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Coyote\SiteBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set timetable
     *
     * @param \Coyote\SiteBundle\Entity\Timetable $timetable
     * @return Schedule
     */
    public function setTimetable(\Coyote\SiteBundle\Entity\Timetable $timetable = null)
    {
        $this->timetable = $timetable;

        return $this;
    }

    /**
     * Get timetable
     *
     * @return \Coyote\SiteBundle\Entity\Timetable 
     */
    public function getTimetable()
    {
        return $this->timetable;
    }
}
