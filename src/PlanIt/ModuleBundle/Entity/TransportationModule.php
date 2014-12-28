<?php

namespace PlanIt\ModuleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PlanIt\ModuleBundle\Repository\TransportationModuleRepository")
 * @ORM\Entity
 * @ORM\Table(name="budget_module")
 */
class TransportationModule extends Module
{

    /**
     * @ORM\Column(type="integer")
     */
    protected $max_capacity_t;

    /**
     * @ORM\Column(type="integer")
     */
    protected $max_price_t;
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
     * Set max_capacity_t
     *
     * @param integer $maxCapacityT
     * @return TransportationModule
     */
    public function setMaxCapacityT($maxCapacityT)
    {
        $this->max_capacity_t = $maxCapacityT;

        return $this;
    }

    /**
     * Get max_capacity_t
     *
     * @return integer 
     */
    public function getMaxCapacityT()
    {
        return $this->max_capacity_t;
    }

    /**
     * Set max_price_t
     *
     * @param integer $maxPriceT
     * @return TransportationModule
     */
    public function setMaxPriceT($maxPriceT)
    {
        $this->max_price_t = $maxPriceT;

        return $this;
    }

    /**
     * Get max_price_t
     *
     * @return integer 
     */
    public function getMaxPriceT()
    {
        return $this->max_price_t;
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
     * @return TransportationModule
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
     * @return TransportationModule
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

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
     * @return TransportationModule
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
     * @return TransportationModule
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
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $guests;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->guests = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add guests
     *
     * @param \PlanIt\ModuleBundle\Entity\Guest $guests
     * @return TransportationModule
     */
    public function addGuest(\PlanIt\ModuleBundle\Entity\Guest $guests)
    {
        $this->guests[] = $guests;

        return $this;
    }

    /**
     * Remove guests
     *
     * @param \PlanIt\ModuleBundle\Entity\Guest $guests
     */
    public function removeGuest(\PlanIt\ModuleBundle\Entity\Guest $guests)
    {
        $this->guests->removeElement($guests);
    }

    /**
     * Get guests
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGuests()
    {
        return $this->guests;
    }
}
