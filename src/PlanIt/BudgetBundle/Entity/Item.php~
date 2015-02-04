<?php

namespace PlanIt\BudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PlanIt\ModuleBundle\Entity\Module;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @ORM\Entity(repositoryClass="PlanIt\BudgetBundle\Repository\ItemRepository")
 * @ORM\Entity
 * @ORM\Table(name="item")
 */
class Item 
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
     * @ORM\ManyToOne(targetEntity="PlanIt\BudgetBundle\Entity\TypeItem", inversedBy="items")
     * @ORM\JoinColumn(name="type_item_id", referencedColumnName="id")
     */
    protected $type_item;

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
     * @return Item
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
     * @return Item
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
     * @return Item
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
     * @return Item
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
     * Set type_item
     *
     * @param \PlanIt\BudgetBundle\Entity\TypeItem $typeItem
     * @return Item
     */
    public function setTypeItem(\PlanIt\BudgetBundle\Entity\TypeItem $typeItem = null)
    {
        $this->type_item = $typeItem;

        return $this;
    }

    /**
     * Get type_item
     *
     * @return \PlanIt\BudgetBundle\Entity\TypeItem 
     */
    public function getTypeItem()
    {
        return $this->type_item;
    }

    /**
     * Set consummate
     *
     * @param float $consummate
     * @return Item
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
     * @return Item
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
}
