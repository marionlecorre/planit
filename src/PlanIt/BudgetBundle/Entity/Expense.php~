<?php

namespace PlanIt\BudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="expense")
 * @ORM\Entity(repositoryClass="PlanIt\BudgetBundle\Repository\ExpenseRepository")
 */
class Expense
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
     * @ORM\Column(type="string", length=30)
     */
    protected $unit;

    /**
     * @ORM\Column(type="float")
     */
    protected $price;

    /**
     * @ORM\Column(type="float")
     */
    protected $stock;

    /**
     * @ORM\Column(type="float")
     */
    protected $quantity;

    /**
     * @ORM\Column(type="float")
     */
    protected $consummate;


    /**
     * @ORM\Column(type="boolean")
     */
    // 0 => non, 1 => oui
    protected $bought;

    // *
    //  * @ORM\ManyToOne(targetEntity="PlanIt\BudgetBundle\Entity\BudgetModule", inversedBy="items")
    //  * @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     
    // protected $module;

    /**
     * @ORM\ManyToOne(targetEntity="PlanIt\BudgetBundle\Entity\TypeExpense", inversedBy="expenses")
     * @ORM\JoinColumn(name="type_expense_id", referencedColumnName="id")
     */
    protected $type_expense;

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
     * @return Expense
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
     * Set price
     *
     * @param float $price
     * @return Expense
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set stock
     *
     * @param float $stock
     * @return Expense
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return float 
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set quantity
     *
     * @param float $quantity
     * @return Expense
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return float 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    // /**
    //  * Set module
    //  *
    //  * @param \PlanIt\BudgetBundle\Entity\BudgetModule $module
    //  * @return Item
    //  */
    // public function setModule(\PlanIt\BudgetBundle\Entity\BudgetModule $module = null)
    // {
    //     $this->module = $module;

    //     return $this;
    // }

    // /**
    //  * Get module
    //  *
    //  * @return \PlanIt\BudgetBundle\Entity\BudgetModule 
    //  */
    // public function getModule()
    // {
    //     return $this->module;
    // }

    /**
     * Set consummate
     *
     * @param float $consummate
     * @return Expense
     */
    public function setConsummate($consummate)
    {
        $this->consummate = $consummate;

        return $this;
    }

    /**
     * Get consummate
     *
     * @return float 
     */
    public function getConsummate()
    {
        return $this->consummate;
    }

    /**
     * Set bought
     *
     * @param boolean $bought
     * @return Expense
     */
    public function setBought($bought)
    {
        $this->bought = $bought;

        return $this;
    }

    /**
     * Get bought
     *
     * @return boolean 
     */
    public function getBought()
    {
        return $this->bought;
    }

    /**
     * Set type_expense
     *
     * @param \PlanIt\BudgetBundle\Entity\TypeExpense $typeExpense
     * @return Expense
     */
    public function setTypeExpense(\PlanIt\BudgetBundle\Entity\TypeExpense $typeExpense = null)
    {
        $this->type_expense = $typeExpense;

        return $this;
    }

    /**
     * Get type_expense
     *
     * @return \PlanIt\BudgetBundle\Entity\TypeExpense 
     */
    public function getTypeExpense()
    {
        return $this->type_expense;
    }

    /**
     * Set unit
     *
     * @param string $unit
     * @return Expense
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string 
     */
    public function getUnit()
    {
        return $this->unit;
    }
}
