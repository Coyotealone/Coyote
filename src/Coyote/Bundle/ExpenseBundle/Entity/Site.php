<?php

namespace Coyote\Bundle\ExpenseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Site
 * @author Coyote
 * @ORM\Entity
 * @ORM\Table(name="site")
 * @ORM\Entity(repositoryClass="Coyote\Bundle\ExpenseBundle\Entity\SiteRepository");
 */
class Site
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
     * @ORM\Column(name="code", type="string", length=3)
     */
    private $code;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=45)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Expense", mappedBy="site", cascade={"persist", "merge"})
     */
    private $expenses;

    /**
     * @var text
     * @ORM\Column(name="roles", type="text", nullable=true)
     */
    private $roles;

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
     * @return Site
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
     * @return Site
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
     * Add expenses
     *
     * @param \Coyote\Bundle\ExpenseBundle\Entity\Expense $expenses
     * @return Site
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
     * @return String name
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Set roles
     *
     * @param string $roles
     *
     * @return Site
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return string
     */
    public function getRoles()
    {
        return $this->roles;
    }
}
