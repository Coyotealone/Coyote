<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Currency
 */
class Currency
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $exchange_rate;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $offer_headers;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $expenses;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->offer_headers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add offer_headers
     *
     * @param \Coyote\SiteBundle\Entity\OfferHeader $offerHeaders
     * @return Currency
     */
    public function addOfferHeader(\Coyote\SiteBundle\Entity\OfferHeader $offerHeaders)
    {
        $this->offer_headers[] = $offerHeaders;

        return $this;
    }

    /**
     * Remove offer_headers
     *
     * @param \Coyote\SiteBundle\Entity\OfferHeader $offerHeaders
     */
    public function removeOfferHeader(\Coyote\SiteBundle\Entity\OfferHeader $offerHeaders)
    {
        $this->offer_headers->removeElement($offerHeaders);
    }

    /**
     * Get offer_headers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOfferHeaders()
    {
        return $this->offer_headers;
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
