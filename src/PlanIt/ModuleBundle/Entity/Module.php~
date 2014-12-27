<?php

namespace PlanIt\ModuleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PlanIt\ModuleBundle\Repository\ModuleRepository")
 * @ORM\Entity
 * @ORM\Table(name="module")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap( {"guests" = "GuestsModule", "budget" = "BudgetModule", "todo" = "TodoModule", "place" = "PlaceModule", "transportation" = "TransportationModule"} )
 */
class Module
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
    protected $slug;

    /**
     * @ORM\Column(type="integer", length=1)
     */
    protected $int_type; //Pouvoir récupérer le type (Invitation, budget, etc.) sous forme de int

    /**
     * @ORM\ManyToOne(targetEntity="PlanIt\EventBundle\Entity\Event")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
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
     * @return Module
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
     * @return Module
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
     * @return Module
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
     * @return Module
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
     * @return Module
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
