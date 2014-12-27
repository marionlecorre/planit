<?php

namespace PlanIt\ModuleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PlanIt\ModuleBundle\Repository\TodoModuleRepository")
 * @ORM\Entity
 * @ORM\Table(name="todo_module")
 */
class TodoModule extends Module
{
    
    
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
     * @return TodoModule
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
     * @return TodoModule
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
     * @return TodoModule
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
     * @return TodoModule
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
     * @return TodoModule
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
