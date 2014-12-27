<?php

namespace PlanIt\ModuleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PlanIt\ModuleBundle\Repository\PlaceModuleRepository")
 * @ORM\Entity
 * @ORM\Table(name="place_module")
 */
class PlaceModule extends Module
{

    /**
     * @ORM\Column(type="integer")
     */
    protected $max_capacity_p;

    /**
     * @ORM\Column(type="integer")
     */
    protected $max_price_p;

    /**
     * @ORM\Column(type="string")
     */
    protected $max_time_to_go;
    
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
     * Set max_capacity_p
     *
     * @param integer $maxCapacityP
     * @return PlaceModule
     */
    public function setMaxCapacityP($maxCapacityP)
    {
        $this->max_capacity_p = $maxCapacityP;

        return $this;
    }

    /**
     * Get max_capacity_p
     *
     * @return integer 
     */
    public function getMaxCapacityP()
    {
        return $this->max_capacity_p;
    }

    /**
     * Set max_price_p
     *
     * @param integer $maxPriceP
     * @return PlaceModule
     */
    public function setMaxPriceP($maxPriceP)
    {
        $this->max_price_p = $maxPriceP;

        return $this;
    }

    /**
     * Get max_price_p
     *
     * @return integer 
     */
    public function getMaxPriceP()
    {
        return $this->max_price_p;
    }

    /**
     * Set max_time_to_go
     *
     * @param string $maxTimeToGo
     * @return PlaceModule
     */
    public function setMaxTimeToGo($maxTimeToGo)
    {
        $this->max_time_to_go = $maxTimeToGo;

        return $this;
    }

    /**
     * Get max_time_to_go
     *
     * @return string 
     */
    public function getMaxTimeToGo()
    {
        return $this->max_time_to_go;
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
     * @return PlaceModule
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
     * @return PlaceModule
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
     * @return PlaceModule
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
     * @return PlaceModule
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
     * @return PlaceModule
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
