<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Absence
 */
class Absence
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $duration;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $schedules;

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
     * Set name
     *
     * @param string $name
     * @return Absence
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set duration
     *
     * @param string $duration
     * @return Absence
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Add schedules
     *
     * @param \Coyote\SiteBundle\Entity\Schedule $schedules
     * @return Absence
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
        return $this->name;
    }
}
