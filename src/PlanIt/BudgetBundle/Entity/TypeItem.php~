<?php

namespace PlanIt\BudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PlanIt\ModuleBundle\Entity\Module;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @ORM\Entity(repositoryClass="PlanIt\BudgetBundle\Repository\TypeItemRepository")
 * @ORM\Entity
 * @ORM\Table(name="type_item")
 */
class TypeItem 
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
     * @ORM\Column(type="boolean")
     */
    // 0=> dépense, 1 => apport
    protected $type;

    /**
     * @ORM\ManyToOne(targetEntity="PlanIt\BudgetBundle\Entity\BudgetModule", inversedBy="type_item")
     * @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     */
    protected $module;

    /**
     * @ORM\OneToMany(targetEntity="PlanIt\BudgetBundle\Entity\Item", mappedBy="type_item")
     */
    protected $items;

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
     * @return TypeItem
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
     * Set type
     *
     * @param boolean $type
     * @return TypeItem
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return boolean 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set module
     *
     * @param \PlanIt\BudgetBundle\Entity\BudgetModule $module
     * @return TypeItem
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
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add items
     *
     * @param \PlanIt\BudgetBundle\Entity\Item $items
     * @return TypeItem
     */
    public function addItem(\PlanIt\BudgetBundle\Entity\Item $items)
    {
        $this->items[] = $items;

        return $this;
    }

    /**
     * Remove items
     *
     * @param \PlanIt\BudgetBundle\Entity\Item $items
     */
    public function removeItem(\PlanIt\BudgetBundle\Entity\Item $items)
    {
        $this->items->removeElement($items);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItems()
    {
        return $this->items;
    }
}
