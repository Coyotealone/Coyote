<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Currency
 * @author Coyote
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Coyote\SiteBundle\Entity\CurrencyRepository");
 */
class Currency
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
     * @ORM\Column(name="code", type="string", length=3, unique=true)
     */
    private $code;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=45, unique=true)
     */
    private $name;

    /**
     * @var float
     * @ORM\Column(name="exchange_rate", type="float", options={"unsigned":true})
     */
    private $exchange_rate;

    /**
     * @ORM\OneToMany(targetEntity="Expense", mappedBy="currency", cascade={"persist", "merge"})
     */
    private $expenses;

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
     * Set code
     *
     * @param string $code
     * @return Currency
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
     * Set name
     *
     * @param string $name
     * @return Currency
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
     * Set exchange_rate
     *
     * @param float $exchangeRate
     * @return Currency
     */
    public function setExchangeRate($exchangeRate)
    {
        $this->exchange_rate = $exchangeRate;

        return $this;
    }

    /**
     * Get exchange_rate
     *
     * @return float
     */
    public function getExchangeRate()
    {
        return $this->exchange_rate;
    }

    /**
     * Add expenses
     *
     * @param \Coyote\SiteBundle\Entity\Expense $expenses
     * @return Currency
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

    public function __toString()
    {
        return $this->code;
    }
}
