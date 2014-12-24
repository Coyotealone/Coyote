<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Car
 */
class Car
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $code;

    /**
     * @var string
     */
    private $registration;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $userfeess;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userfeess = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set code
     *
     * @param integer $code
     * @return Car
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set registration
     *
     * @param string $registration
     * @return Car
     */
    public function setRegistration($registration)
    {
        $this->registration = $registration;

        return $this;
    }

    /**
     * Get registration
     *
     * @return string
     */
    public function getRegistration()
    {
        return $this->registration;
    }

    /**
     * Add userfeess
     *
     * @param \Coyote\SiteBundle\Entity\UserFees $userfeess
     * @return Car
     */
    public function addUserfeess(\Coyote\SiteBundle\Entity\UserFees $userfeess)
    {
        $this->userfeess[] = $userfeess;

        return $this;
    }

    /**
     * Remove userfeess
     *
     * @param \Coyote\SiteBundle\Entity\UserFees $userfeess
     */
    public function removeUserfeess(\Coyote\SiteBundle\Entity\UserFees $userfeess)
    {
        $this->userfeess->removeElement($userfeess);
    }

    /**
     * Get userfeess
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserfeess()
    {
        return $this->userfeess;
    }

    public function __toString()
    {
        return $this->code;
    }
}
