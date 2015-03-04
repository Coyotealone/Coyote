<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class UserFees
 * @author Coyote
 * @ORM\Entity
 */
class UserFees
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="login", type="string", length=45, unique=true)
     */
    private $login;
    
    /**
     * @var integer
     * @ORM\Column(name="code", type="integer", unique=true, options={"unsigned":true})
     */
    private $code;
    
    /**
     * @var string
     * @ORM\Column(name="service", type="string", length=45)
     */
    private $service;
    
    /**
     * @ORM\ManyToOne(targetEntity="Car", inversedBy="userfeess")
     * @ORM\JoinColumn(name="car_id", referencedColumnName="id")
     */
    private $car;

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
     * @param integer $code
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
     * @return integer 
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

    /**
     * Set car
     *
     * @param \Coyote\SiteBundle\Entity\Car $car
     * @return UserFees
     */
    public function setCar(\Coyote\SiteBundle\Entity\Car $car = null)
    {
        $this->car = $car;

        return $this;
    }

    /**
     * Get car
     *
     * @return \Coyote\SiteBundle\Entity\Car 
     */
    public function getCar()
    {
        return $this->car;
    }
}
