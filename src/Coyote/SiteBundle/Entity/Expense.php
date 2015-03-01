<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Expense
 * @author Coyote
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Coyote\SiteBundle\Entity\ExpenseRepository");
 * @ORM\HasLifecycleCallbacks
 *
 */
class Expense
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var datetime
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var boolean
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @var float
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @var float
     * @ORM\Column(name="amount_TTC", type="float")
     */
    private $amount_TTC;

    /**
     * @var float
     * @ORM\Column(name="amount_HT", type="float")
     */
    private $amount_HT;

    /**
     * @var string
     * @ORM\Column(name="comment", type="string", length=255, nullable=true)
     */
    private $comment;

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
     * @ORM\ManyToOne(targetEntity="Site", inversedBy="expenses")
     * @ORM\JoinColumn(name="site_id", referencedColumnName="id")
     */
    private $site;

    /**
     * @ORM\ManyToOne(targetEntity="Currency", inversedBy="expenses")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id")
     */
    private $currency;

    /**
     * @ORM\ManyToOne(targetEntity="Business", inversedBy="expenses")
     * @ORM\JoinColumn(name="business_id", referencedColumnName="id")
     */
    private $business;

    /**
     * @ORM\ManyToOne(targetEntity="Fee", inversedBy="expenses")
     * @ORM\JoinColumn(name="fee_id", referencedColumnName="id")
     */
    private $fee;

    /**
     * @ORM\ManyToOne(targetEntity="UserFees", inversedBy="expenses")
     * @ORM\JoinColumn(name="userfees_id", referencedColumnName="id")
     */
    private $userfees;

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
     * Set date
     *
     * @param \DateTime $date
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
     * @return \DateTime
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
     * Set amount_HT
     *
     * @param float $amountHT
     * @return Expense
     */
    public function setAmountHT($amountHT)
    {
        $this->amount_HT = $amountHT;

        return $this;
    }

    /**
     * Get amount_HT
     *
     * @return float
     */
    public function getAmountHT()
    {
        return $this->amount_HT;
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
     * Add expenses
     *
     * @param \Coyote\SiteBundle\Entity\UserFees $expenses
     * @return Expense
     */
    public function addExpense(\Coyote\SiteBundle\Entity\UserFees $expenses)
    {
        $this->expenses[] = $expenses;

        return $this;
    }

    /**
     * Remove expenses
     *
     * @param \Coyote\SiteBundle\Entity\UserFees $expenses
     */
    public function removeExpense(\Coyote\SiteBundle\Entity\UserFees $expenses)
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
     * Set userfeess
     *
     * @param \Coyote\SiteBundle\Entity\UserFees $userfeess
     * @return Expense
     */
    public function setUserfeess(\Coyote\SiteBundle\Entity\UserFees $userfeess = null)
    {
        $this->userfeess = $userfeess;

        return $this;
    }

    /**
     * Get userfeess
     *
     * @return \Coyote\SiteBundle\Entity\UserFees
     */
    public function getUserfeess()
    {
        return $this->userfeess;
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
