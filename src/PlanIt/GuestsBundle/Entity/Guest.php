<?php

namespace PlanIt\GuestsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

/**
 * @ORM\Entity
 * @ORM\Table(name="guest")
 * @ORM\Entity(repositoryClass="PlanIt\GuestsBundle\Repository\GuestRepository")
 */
class Guest
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
    protected $firstname;

    /**
     * @ORM\Column(type="string", length=30)
     */
    protected $lastname;

    /**
     * @ORM\Column(type="string", length=30)
     */
    protected $email;

    /**
     * @ORM\Column(type="integer", length=1)
     */
    //0 => no, 1 => yes, 2 => waiting
    protected $confirmed;

    /**
     * @ORM\Column(type="integer", length=1)
     */
    //0 => no, 1 => yes
    protected $payed;

    /**
     * @ORM\Column(type="boolean")
     */
    //0 => no, 1 => yes, 2 => waiting
    protected $sent;


    /**
     * @ORM\ManyToOne(targetEntity="PlanIt\GuestsBundle\Entity\TypeGuest", inversedBy="guests")
     * @ORM\JoinColumn(name="type_guest_id", referencedColumnName="id")
     */
    protected $type_guest;

    /**
     * @ORM\ManyToOne(targetEntity="PlanIt\GuestsBundle\Entity\GuestsModule", inversedBy="guests")
     * @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     */
    protected $module;

    /**
     * @ORM\ManyToOne(targetEntity="PlanIt\GuestsBundle\Entity\PaymentMeans", inversedBy="guests")
     * @ORM\JoinColumn(name="paymentmean_id", referencedColumnName="id")
     */
    protected $paymentmean;

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
     * Set firstname
     *
     * @param string $firstname
     * @return Guest
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Guest
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Guest
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set id_module
     *
     * @param \PlanIt\ModuleBundle\Entity\Module $idModule
     * @return Guest
     */
    public function setIdModule(\PlanIt\ModuleBundle\Entity\Module $idModule = null)
    {
        $this->id_module = $idModule;

        return $this;
    }

    /**
     * Get id_module
     *
     * @return \PlanIt\ModuleBundle\Entity\Module 
     */
    public function getIdModule()
    {
        return $this->id_module;
    }

    /**
     * Set module
     *
     * @param \PlanIt\GuestsBundle\Entity\GuestsModule $module
     * @return Guest
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
     * Set confirmed
     *
     * @param boolean $confirmed
     * @return Guest
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    /**
     * Get confirmed
     *
     * @return boolean 
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * Set payed
     *
     * @param boolean $payed
     * @return Guest
     */
    public function setPayed($payed)
    {
        $this->payed = $payed;

        return $this;
    }

    /**
     * Get payed
     *
     * @return boolean 
     */
    public function getPayed()
    {
        return $this->payed;
    }

    /**
     * Set sent
     *
     * @param boolean $sent
     * @return Guest
     */
    public function setSent($sent)
    {
        $this->sent = $sent;

        return $this;
    }

    /**
     * Get sent
     *
     * @return boolean 
     */
    public function getSent()
    {
        return $this->sent;
    }



    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('firstname', new NotBlank(array(
            'message' => 'Merci de renseigner le prénom de l\'invité'
        )));
        $metadata->addPropertyConstraint('firstname', new Length(array(
            'max' => "30"
        )));

        $metadata->addPropertyConstraint('lastname', new NotBlank(array(
            'message' => 'Merci de renseigner le nom de famille de l\'invité'
        )));
        $metadata->addPropertyConstraint('lastname', new Length(array(
            'max' => "30"
        )));

        $metadata->addPropertyConstraint('email', new Email(array(
            'message' => 'Merci de renseigner une adresse mail valide'
        )));
    }

    /**
     * Set type_guest
     *
     * @param \PlanIt\GuestsBundle\Entity\TypeGuest $typeGuest
     * @return Guest
     */

    public function setTypeGuest(\PlanIt\GuestsBundle\Entity\TypeGuest $typeGuest = null)
    {
        $this->type_guest = $typeGuest;

        return $this;
    }

    /**
     * Get type_guest
     *
     * @return \PlanIt\GuestsBundle\Entity\TypeGuest 
     */
    public function getTypeGuest()
    {
        return $this->type_guest;
    }

    protected function test(){
        echo 'test';
    }

    /**
     * Set paymentmean
     *
     * @param \PlanIt\GuestsBundle\Entity\PaymentMeans $paymentmean
     * @return Guest
     */
    public function setPaymentmean(\PlanIt\GuestsBundle\Entity\PaymentMeans $paymentmean = null)
    {
        $this->paymentmean = $paymentmean;

        return $this;
    }

    /**
     * Get paymentmean
     *
     * @return \PlanIt\GuestsBundle\Entity\PaymentMeans 
     */
    public function getPaymentmean()
    {
        return $this->paymentmean;
    }
}
