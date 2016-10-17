<?php

namespace Coyote\Bundle\ExpenseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Expense
 * @author Coyote
 * @ORM\Entity
 * @ORM\Table(name="expense")
 * @ORM\Entity(repositoryClass="Coyote\Bundle\ExpenseBundle\Entity\ExpenseRepository");
 * @ORM\HasLifecycleCallbacks
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
     * @var \Date
     * @ORM\Column(name="date", type="date")
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
     * @ORM\Column(name="amount_TVA", type="float")
     */
    private $amount_TVA;

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
     * @ORM\JoinColumn(name="site_id", referencedColumnName="id", nullable=false)
     */
    private $site;

    /**
     * @ORM\ManyToOne(targetEntity="Currency", inversedBy="expenses")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id", nullable=false)
     */
    private $currency;

    /**
     * @ORM\ManyToOne(targetEntity="Business", inversedBy="expenses")
     * @ORM\JoinColumn(name="business_id", referencedColumnName="id", nullable=false)
     */
    private $business;

    /**
     * @ORM\ManyToOne(targetEntity="Fee", inversedBy="expenses")
     * @ORM\JoinColumn(name="fee_id", referencedColumnName="id", nullable=false)
     */
    private $fee;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->expenses = new \Doctrine\Common\Collections\ArrayCollection();
        //$this->site = 9;
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
     * @param \Coyote\Bundle\ExpenseBundle\Entity\Site $site
     * @return Expense
     */
    public function setSite(\Coyote\Bundle\ExpenseBundle\Entity\Site $site = null)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return \Coyote\Bundle\ExpenseBundle\Entity\Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set currency
     *
     * @param \Coyote\Bundle\ExpenseBundle\Entity\Currency $currency
     * @return Expense
     */
    public function setCurrency(\Coyote\Bundle\ExpenseBundle\Entity\Currency $currency = null)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \Coyote\Bundle\ExpenseBundle\Entity\Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set business
     *
     * @param \Coyote\Bundle\ExpenseBundle\Entity\Business $business
     * @return Expense
     */
    public function setBusiness(\Coyote\Bundle\ExpenseBundle\Entity\Business $business = null)
    {
        $this->business = $business;

        return $this;
    }

    /**
     * Get business
     *
     * @return \Coyote\Bundle\ExpenseBundle\Entity\Business
     */
    public function getBusiness()
    {
        return $this->business;
    }

    /**
     * Set fee
     *
     * @param \Coyote\Bundle\ExpenseBundle\Entity\Fee $fee
     * @return Expense
     */
    public function setFee(\Coyote\Bundle\ExpenseBundle\Entity\Fee $fee = null)
    {
        $this->fee = $fee;

        return $this;
    }

    /**
     * Get fee
     *
     * @return \Coyote\Bundle\ExpenseBundle\Entity\Fee
     */
    public function getFee()
    {
        return $this->fee;
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
     * Set user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     * @return Expense
     */
    public function setUser(\Application\Sonata\UserBundle\Entity\User $user)
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
