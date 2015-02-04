<?php

namespace PlanIt\BudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PlanIt\ModuleBundle\Entity\Module;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @ORM\Entity(repositoryClass="PlanIt\BudgetBundle\Repository\BudgetModuleRepository")
 * @ORM\Entity
 * @ORM\Table(name="budget_module")
 */
class BudgetModule extends Module
{

    /**
     * @ORM\Column(type="integer")
     */
    protected $max_budget;
    /**
     * @ORM\Column(type="integer")
     */
    protected $base;
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var integer
     */
    protected $int_type;

    /**
     * @var \PlanIt\EventBundle\Entity\Event
     */
    protected $event;

    /**
     * @ORM\OneToMany(targetEntity="PlanIt\BudgetBundle\Entity\TypeItem", mappedBy="module")
     */
    protected $type_item;

    // *
    //  * @ORM\OneToMany(targetEntity="PlanIt\BudgetBundle\Entity\Item", mappedBy="module")
     
    // protected $items;


    /**
     * Set max_budget
     *
     * @param integer $maxBudget
     * @return BudgetModule
     */
    public function setMaxBudget($maxBudget)
    {
        $this->max_budget = $maxBudget;

        return $this;
    }

    /**
     * Get max_budget
     *
     * @return integer 
     */
    public function getMaxBudget()
    {
        return $this->max_budget;
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
     * Set name
     *
     * @param string $name
     * @return BudgetModule
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
     * Set slug
     *
     * @param string $slug
     * @return BudgetModule
     */
    public function setSlug($slug)
    {
        $this->slug = $this->slugify($slug);

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set int_type
     *
     * @param integer $intType
     * @return BudgetModule
     */
    public function setIntType($intType)
    {
        $this->int_type = $intType;

        return $this;
    }

    /**
     * Get int_type
     *
     * @return integer 
     */
    public function getIntType()
    {
        return $this->int_type;
    }

    /**
     * Set event
     *
     * @param \PlanIt\EventBundle\Entity\Event $event
     * @return BudgetModule
     */
    public function setEvent(\PlanIt\EventBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \PlanIt\EventBundle\Entity\Event 
     */
    public function getEvent()
    {
        return $this->event;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('max_budget', new NotBlank(array(
            'message' => 'Merci de renseigner un bdget maximum'
        )));

    }

    public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('#[^\\pL\d]+#u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        if (function_exists('iconv'))
        {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('#[^-\w]+#', '', $text);

        if (empty($text))
        {
            return 'n-a';
        }

        return $text;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->type_item = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add type_item
     *
     * @param \PlanIt\BudgetBundle\Entity\TypeItem $typeItem
     * @return BudgetModule
     */
    public function addTypeItem(\PlanIt\BudgetBundle\Entity\TypeItem $typeItem)
    {
        $this->type_item[] = $typeItem;

        return $this;
    }

    /**
     * Remove type_item
     *
     * @param \PlanIt\BudgetBundle\Entity\TypeItem $typeItem
     */
    public function removeTypeItem(\PlanIt\BudgetBundle\Entity\TypeItem $typeItem)
    {
        $this->type_item->removeElement($typeItem);
    }

    /**
     * Get type_item
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTypeItem()
    {
        return $this->type_item;
    }

    // /**
    //  * Add items
    //  *
    //  * @param \PlanIt\BudgetBundle\Entity\Item $items
    //  * @return BudgetModule
    //  */
    // public function addItem(\PlanIt\BudgetBundle\Entity\Item $items)
    // {
    //     $this->items[] = $items;

    //     return $this;
    // }

    // *
    //  * Remove items
    //  *
    //  * @param \PlanIt\BudgetBundle\Entity\Item $items
     
    // public function removeItem(\PlanIt\BudgetBundle\Entity\Item $items)
    // {
    //     $this->items->removeElement($items);
    // }

    // /**
    //  * Get items
    //  *
    //  * @return \Doctrine\Common\Collections\Collection 
    //  */
    // public function getItems()
    // {
    //     return $this->items;
    // }

    /**
     * Set base
     *
     * @param integer $base
     * @return BudgetModule
     */
    public function setBase($base)
    {
        $this->base = $base;

        return $this;
    }

    /**
     * Get base
     *
     * @return integer 
     */
    public function getBase()
    {
        return $this->base;
    }
}
