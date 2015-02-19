<?php

namespace PlanIt\GuestsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

/**
 * @ORM\Entity
 * @ORM\Table(name="type_guest")
 */
class TypeGuest
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
    protected $label;

    /**
     * @ORM\Column(type="text", length=100)
     */
    protected $message;

    /**
     * @ORM\Column(type="float")
     */
    protected $price;

    /**
     * @ORM\ManyToOne(targetEntity="PlanIt\GuestsBundle\Entity\GuestsModule", inversedBy="type_guest")
     * @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     */
    protected $module;

    /**
     * @ORM\OneToMany(targetEntity="PlanIt\GuestsBundle\Entity\Guest", mappedBy="typeguest")
     */
    protected $guests;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->guests = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set label
     *
     * @param string $label
     * @return TypeGuest
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return TypeGuest
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return TypeGuest
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
     * Set module
     *
     * @param \PlanIt\GuestsBundle\Entity\GuestsModule $module
     * @return TypeGuest
     */
    public function setModule(\PlanIt\GuestsBundle\Entity\GuestsModule $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \PlanIt\GuestsBundle\Entity\GuestsModule 
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Add guests
     *
     * @param \PlanIt\ModuleBundle\Entity\Guest $guests
     * @return TypeGuest
     */
    public function addGuest(\PlanIt\GuestsBundle\Entity\Guest $guests)
    {
        $this->guests[] = $guests;

        return $this;
    }

    /**
     * Remove guests
     *
     * @param \PlanIt\ModuleBundle\Entity\Guest $guests
     */
    public function removeGuest(\PlanIt\GuestsBundle\Entity\Guest $guests)
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

    public function __toString()
    {
        return $this->getLabel();
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('label', new NotBlank(array(
            'message' => 'Merci de renseigner le nom du type d\'invité'
        )));
        $metadata->addPropertyConstraint('message', new Length(array(
            'max' => "300"
        )));

        $metadata->addPropertyConstraint('price', new NotBlank(array(
            'message' => 'Merci de renseigner le prix pour ce type d\'invité'
        )));
    }
}
