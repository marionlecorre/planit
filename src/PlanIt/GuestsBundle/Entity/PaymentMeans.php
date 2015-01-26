<?php

namespace PlanIt\GuestsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

/**
 * @ORM\Entity(repositoryClass="PlanIt\GuestsBundle\Repository\PaymentMeansRepository")
 * @ORM\Entity
 * @ORM\Table(name="PaymentMeans")
 */
class PaymentMeans
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
     * @ORM\OneToMany(targetEntity="PlanIt\GuestsBundle\Entity\Guest", mappedBy="paymentmean")
     */
    protected $guests;

    /**
     * @ORM\ManyToMany(targetEntity="PlanIt\GuestsBundle\Entity\GuestsModule", mappedBy="payment_means")
     **/
    protected $modules;

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
     * @return PaymentMeans
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
     * Set module
     *
     * @param \PlanIt\GuestsBundle\Entity\GuestsModule $module
     * @return PaymentMeans
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
     * @param \PlanIt\GuestsBundle\Entity\Guest $guests
     * @return PaymentMeans
     */
    public function addGuest(\PlanIt\GuestsBundle\Entity\Guest $guests)
    {
        $this->guests[] = $guests;

        return $this;
    }

    /**
     * Remove guests
     *
     * @param \PlanIt\GuestsBundle\Entity\Guest $guests
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

    /**
     * Add modules
     *
     * @param \PlanIt\GuestsBundle\Entity\GuestsModule $modules
     * @return PaymentMeans
     */
    public function addModule(\PlanIt\GuestsBundle\Entity\GuestsModule $modules)
    {
        $this->modules[] = $modules;

        return $this;
    }

    /**
     * Remove modules
     *
     * @param \PlanIt\GuestsBundle\Entity\GuestsModule $modules
     */
    public function removeModule(\PlanIt\GuestsBundle\Entity\GuestsModule $modules)
    {
        $this->modules->removeElement($modules);
    }

    /**
     * Get modules
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getModules()
    {
        return $this->modules;
    }
}
