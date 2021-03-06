<?php

namespace Coyote\Bundle\ExpenseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Fee
 * @author Coyote
 * @ORM\Entity
 * @ORM\Table(name="fee")
 */
class Fee
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=6, unique=true)
     */
    private $code;

    /**
     *
     * @var string
     * @ORM\Column(name="name", type="string", length=45, unique=true)
     */
    private $name;

    /**
     * @var float
     * @ORM\Column(name="rate", type="float")
     */
    private $rate;

    /**
     * @var string
     * @ORM\Column(name="code_rate", type="string", length=4)
     */
    private $code_rate;

    /**
    * @ORM\OneToMany(targetEntity="Expense", mappedBy="fee", cascade={"persist", "merge"})
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
     * @return Fee
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
     * @return Fee
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
     * Set rate
     *
     * @param float $rate
     * @return Fee
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set code_rate
     *
     * @param string $codeRate
     * @return Fee
     */
    public function setCodeRate($codeRate)
    {
        $this->code_rate = $codeRate;

        return $this;
    }

    /**
     * Get code_rate
     *
     * @return string
     */
    public function getCodeRate()
    {
        return $this->code_rate;
    }

    /**
     * Add expenses
     *
     * @param \Coyote\Bundle\ExpenseBundle\Entity\Expense $expenses
     * @return Fee
     */
    public function addExpense(\Coyote\Bundle\ExpenseBundle\Entity\Expense $expenses)
    {
        $this->expenses[] = $expenses;

        return $this;
    }

    /**
     * Remove expenses
     *
     * @param \Coyote\Bundle\ExpenseBundle\Entity\Expense $expenses
     */
    public function removeExpense(\Coyote\Bundle\ExpenseBundle\Entity\Expense $expenses)
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
     * @return String code : name
     */
    public function __toString()
    {
        return $this->code." : ".$this->name;
    }
}
