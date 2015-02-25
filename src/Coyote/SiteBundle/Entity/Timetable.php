<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Timetable
 * @author Coyote
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Coyote\SiteBundle\Entity\TimetableRepository");
 */
class Timetable
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    
    /**
     * @var boolean
     * @ORM\Column(name="holiday", type="boolean")
     */
    private $holiday;
    
    /**
     * @var string
     * @ORM\Column(name="period", type="string", length=9)
     */
    private $period;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->schedules = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set date
     *
     * @param \DateTime $date
     * @return Timetable
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set holiday
     *
     * @param boolean $holiday
     * @return Timetable
     */
    public function setHoliday($holiday)
    {
        $this->holiday = $holiday;

        return $this;
    }

    /**
     * Get holiday
     *
     * @return boolean 
     */
    public function getHoliday()
    {
        return $this->holiday;
    }

    /**
     * Set period
     *
     * @param string $period
     * @return Timetable
     */
    public function setPeriod($period)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * Get period
     *
     * @return string 
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Add schedules
     *
     * @param \Coyote\SiteBundle\Entity\Schedule $schedules
     * @return Timetable
     */
    public function addSchedule(\Coyote\SiteBundle\Entity\Schedule $schedules)
    {
        $this->schedules[] = $schedules;

        return $this;
    }

    /**
     * Remove schedules
     *
     * @param \Coyote\SiteBundle\Entity\Schedule $schedules
     */
    public function removeSchedule(\Coyote\SiteBundle\Entity\Schedule $schedules)
    {
        $this->schedules->removeElement($schedules);
    }

    /**
     * Get schedules
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSchedules()
    {
        return $this->schedules;
    }
    
    public function __toString()
    {
        return $this->date->format('d/m/Y');
    }
}
