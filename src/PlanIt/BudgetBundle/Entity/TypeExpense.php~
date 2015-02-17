<?php

namespace PlanIt\BudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="type_expense")
 * @ORM\Entity(repositoryClass="PlanIt\BudgetBundle\Repository\TypeExpenseRepository")
 */
class TypeExpense
{
   /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="PlanIt\BudgetBundle\Entity\BudgetModule", inversedBy="typesexpense")
     * @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     */
    protected $module;

    /**
     * @ORM\OneToMany(targetEntity="PlanIt\BudgetBundle\Entity\Expense", mappedBy="type_expense")
     */
    protected $expenses;

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
     * Set name
     *
     * @param string $name
     * @return TypeExpense
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
     * Set module
     *
     * @param \PlanIt\BudgetBundle\Entity\BudgetModule $module
     * @return TypeExpense
     */
    public function setModule(\PlanIt\BudgetBundle\Entity\BudgetModule $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \PlanIt\BudgetBundle\Entity\BudgetModule 
     */
    public function getModule()
    {
        return $this->module;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->expenses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add expenses
     *
     * @param \PlanIt\BudgetBundle\Entity\Expense $expenses
     * @return TypeExpense
     */
    public function addExpense(\PlanIt\BudgetBundle\Entity\Expense $expenses)
    {
        $this->expenses[] = $expenses;

        return $this;
    }

    /**
     * Remove expenses
     *
     * @param \PlanIt\BudgetBundle\Entity\Expense $expenses
     */
    public function removeExpense(\PlanIt\BudgetBundle\Entity\Expense $expenses)
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
}
