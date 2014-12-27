<?php

namespace PlanIt\ModuleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PlanIt\ModuleBundle\Repository\GuestsModuleRepository")
 * @ORM\Entity
 * @ORM\Table(name="guests_module")
 */
class GuestsModule extends Module
{

    /**
     * @ORM\Column(type="integer", length=1)
     */
    protected $list_type;

    /**
     * @ORM\Column(type="integer")
     */
    protected $max_guests;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $payable;
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
     * Set list_type
     *
     * @param integer $listType
     * @return GuestsModule
     */
    public function setListType($listType)
    {
        $this->list_type = $listType;

        return $this;
    }

    /**
     * Get list_type
     *
     * @return integer 
     */
    public function getListType()
    {
        return $this->list_type;
    }

    /**
     * Set max_guests
     *
     * @param integer $maxGuests
     * @return GuestsModule
     */
    public function setMaxGuests($maxGuests)
    {
        $this->max_guests = $maxGuests;

        return $this;
    }

    /**
     * Get max_guests
     *
     * @return integer 
     */
    public function getMaxGuests()
    {
        return $this->max_guests;
    }

    /**
     * Set payable
     *
     * @param boolean $payable
     * @return GuestsModule
     */
    public function setPayable($payable)
    {
        $this->payable = $payable;

        return $this;
    }

    /**
     * Get payable
     *
     * @return boolean 
     */
    public function getPayable()
    {
        return $this->payable;
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
     * @return GuestsModule
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
     * @return GuestsModule
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
     * @return GuestsModule
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
     * @return GuestsModule
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
}
