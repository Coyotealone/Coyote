<?php

namespace Coyote\Bundle\AttendanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Schedule
 * @author Coyote
 * @ORM\Entity
 * @ORM\Table(name="schedule")
 * @ORM\Entity(repositoryClass="Coyote\Bundle\AttendanceBundle\Entity\ScheduleRepository");
 * @ORM\HasLifecycleCallbacks
 */
class Schedule
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \Time
     * @ORM\Column(name="start", type="time")
     */
    private $start;

    /**
     * @var \Time
     * @ORM\Column(name="end", type="time")
     */
    private $end;

    /**
     * @var \Time
     * @ORM\Column(name="break", type="time")
     */
    private $break;

    /**
     * @var \Time
     * @ORM\Column(name="working_time", type="time")
     */
    private $working_time;

    /**
     * @var float
     * @ORM\Column(name="working_hours", type="float")
     */
    private $working_hours;

    /**
     * @var boolean
     * @ORM\Column(name="travel", type="boolean")
     */
    private $travel;

    /**
     * @var string
     * @ORM\Column(name="absence_name", type="string", length=20)
     */
    private $absence_name;

    /**
     * @var string
     * @ORM\Column(name="absence_duration", type="string", length=5)
     */
    private $absence_duration;

    /**
     * @var string
     * @ORM\Column(name="comment", type="string", length=255)
     */
    private $comment;

    /**
     * @var boolean
     * @ORM\Column(name="locked", type="boolean")
     */
    private $locked;

    /**
     * @var string
     * @ORM\Column(name="locked_by", type="string", length=50, nullable=true)
     */
    private $locked_by;

    /**
     * @var string
     * @ORM\Column(name="validated_by", type="string", length=50, nullable=true)
     */
    private $validated_by;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @var \DateTime
     * @ORM\Column(name="locked_at", type="datetime", nullable=true)
     */
    private $locked_at;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var \Date
     * @ORM\Column(name="date_schedule", type="date", nullable=false)
     */
    private $date_schedule;

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
     * @param time $start
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
     * @param time $end
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
     * @param time $break
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
     * @param time $workingTime
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
     * Set absence_name
     *
     * @param string $absenceName
     * @return Schedule
     */
    public function setAbsenceName($absenceName)
    {
        $this->absence_name = $absenceName;

        return $this;
    }

    /**
     * Get absence_name
     *
     * @return string
     */
    public function getAbsenceName()
    {
        return $this->absence_name;
    }

    /**
     * Set absence_duration
     *
     * @param string $absenceDuration
     * @return Schedule
     */
    public function setAbsenceDuration($absenceDuration)
    {
        $this->absence_duration = $absenceDuration;

        return $this;
    }

    /**
     * Get absence_duration
     *
     * @return string
     */
    public function getAbsenceDuration()
    {
        return $this->absence_duration;
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
     * Set created_at
     * @ORM\PrePersist
     * @param \DateTime $createdAt
     * @return Expense
     */
    public function setCreatedAt($createdAt)
    {
        if(!$this->getCreatedAt())
        {
            $this->created_at = new \DateTime();
        }
    }

    /**
     * Get created_at
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     * @ORM\PreUpdate
     * @param \DateTime $updatedAt
     * @return Expense
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = new \DateTime();
    }

    /**
     * Get updated_at
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->locked = 0;
    }

    /**
     * Set locked
     *
     * @param boolean $locked
     * @return Schedule
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;

        return $this;
    }

    /**
     * Get locked
     *
     * @return boolean
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Set locked_by
     *
     * @param string $lockedBy
     * @return Schedule
     */
    public function setLockedBy($lockedBy)
    {
        $this->locked_by = $lockedBy;

        return $this;
    }

    /**
     * Get locked_by
     *
     * @return string
     */
    public function getLockedBy()
    {
        return $this->locked_by;
    }

    /**
     * Set validated_by
     *
     * @param string $validatedBy
     * @return Schedule
     */
    public function setValidatedBy($validatedBy)
    {
        $this->validated_by = $validatedBy;

        return $this;
    }

    /**
     * Get validated_by
     *
     * @return string
     */
    public function getValidatedBy()
    {
        return $this->validated_by;
    }

    /**
     * Set locked_at
     *
     * @param \DateTime $lockedAt
     * @return Schedule
     */
    public function setLockedAt($lockedAt)
    {
        $this->locked_at = $lockedAt;

        return $this;
    }

    /**
     * Get locked_at
     *
     * @return \DateTime
     */
    public function getLockedAt()
    {
        return $this->locked_at;
    }

    

    /**
     * Set date_schedule
     *
     * @param \DateTime $dateSchedule
     * @return Schedule
     */
    public function setDateSchedule($dateSchedule)
    {
        $this->date_schedule = $dateSchedule;

        return $this;
    }

    /**
     * Get date_schedule
     *
     * @return \DateTime 
     */
    public function getDateSchedule()
    {
        return $this->date_schedule;
    }

    /**
     * Set user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     * @return Schedule
     */
    public function setUser(\Application\Sonata\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
