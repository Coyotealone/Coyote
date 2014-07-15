<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Expense
 */
class Expense
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $date;

    /**
     * @var boolean
     */
    private $status;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var float
     */
    private $actual_amount;

    /**
     * @var float
     */
    private $amount_TTC;

    /**
     * @var float
     */
    private $amount_TVA;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var \Coyote\SiteBundle\Entity\Site
     */
    private $site;

    /**
     * @var \Coyote\SiteBundle\Entity\Currency
     */
    private $currency;

    /**
     * @var \Coyote\SiteBundle\Entity\Business
     */
    private $business;

    /**
     * @var \Coyote\SiteBundle\Entity\Fee
     */
    private $fee;

    /**
     * @var \Coyote\SiteBundle\Entity\UserFees
     */
    private $userfees;


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
     * @param string $date
     * @return Expense
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Expense
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set amount
     *
     * @param float $amount
     * @return Expense
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set actual_amount
     *
     * @param float $actualAmount
     * @return Expense
     */
    public function setActualAmount($actualAmount)
    {
        $this->actual_amount = $actualAmount;

        return $this;
    }

    /**
     * Get actual_amount
     *
     * @return float 
     */
    public function getActualAmount()
    {
        return $this->actual_amount;
    }

    /**
     * Set amount_TTC
     *
     * @param float $amountTTC
     * @return Expense
     */
    public function setAmountTTC($amountTTC)
    {
        $this->amount_TTC = $amountTTC;

        return $this;
    }

    /**
     * Get amount_TTC
     *
     * @return float 
     */
    public function getAmountTTC()
    {
        return $this->amount_TTC;
    }

    /**
     * Set amount_TVA
     *
     * @param float $amountTVA
     * @return Expense
     */
    public function setAmountTVA($amountTVA)
    {
        $this->amount_TVA = $amountTVA;

        return $this;
    }

    /**
     * Get amount_TVA
     *
     * @return float 
     */
    public function getAmountTVA()
    {
        return $this->amount_TVA;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Expense
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
     * Set site
     *
     * @param \Coyote\SiteBundle\Entity\Site $site
     * @return Expense
     */
    public function setSite(\Coyote\SiteBundle\Entity\Site $site = null)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return \Coyote\SiteBundle\Entity\Site 
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set currency
     *
     * @param \Coyote\SiteBundle\Entity\Currency $currency
     * @return Expense
     */
    public function setCurrency(\Coyote\SiteBundle\Entity\Currency $currency = null)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \Coyote\SiteBundle\Entity\Currency 
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set business
     *
     * @param \Coyote\SiteBundle\Entity\Business $business
     * @return Expense
     */
    public function setBusiness(\Coyote\SiteBundle\Entity\Business $business = null)
    {
        $this->business = $business;

        return $this;
    }

    /**
     * Get business
     *
     * @return \Coyote\SiteBundle\Entity\Business 
     */
    public function getBusiness()
    {
        return $this->business;
    }

    /**
     * Set fee
     *
     * @param \Coyote\SiteBundle\Entity\Fee $fee
     * @return Expense
     */
    public function setFee(\Coyote\SiteBundle\Entity\Fee $fee = null)
    {
        $this->fee = $fee;

        return $this;
    }

    /**
     * Get fee
     *
     * @return \Coyote\SiteBundle\Entity\Fee 
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * Set userfees
     *
     * @param \Coyote\SiteBundle\Entity\UserFees $userfees
     * @return Expense
     */
    public function setUserfees(\Coyote\SiteBundle\Entity\UserFees $userfees = null)
    {
        $this->userfees = $userfees;

        return $this;
    }

    /**
     * Get userfees
     *
     * @return \Coyote\SiteBundle\Entity\UserFees 
     */
    public function getUserfees()
    {
        return $this->userfees;
    }
}
