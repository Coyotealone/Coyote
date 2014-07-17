<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserFees
 */
class UserFees
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $service;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $expenses;

    /**
     * @var \Coyote\SiteBundle\Entity\User
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->expenses = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set login
     *
     * @param string $login
     * @return UserFees
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return UserFees
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set service
     *
     * @param string $service
     * @return UserFees
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return string 
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Add expenses
     *
     * @param \Coyote\SiteBundle\Entity\Expense $expenses
     * @return UserFees
     */
    public function addExpense(\Coyote\SiteBundle\Entity\Expense $expenses)
    {
        $this->expenses[] = $expenses;

        return $this;
    }

    /**
     * Remove expenses
     *
     * @param \Coyote\SiteBundle\Entity\Expense $expenses
     */
    public function removeExpense(\Coyote\SiteBundle\Entity\Expense $expenses)
    {
        $this->expenses->removeElement($expenses);
    }

    /**
     * Get expenses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExpenses()
    {
        return $this->expenses;
    }

    /**
     * Set user
     *
     * @param \Coyote\SiteBundle\Entity\User $user
     * @return UserFees
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
    
    public function __toString()
    {
        return $this->code;
    }
}
