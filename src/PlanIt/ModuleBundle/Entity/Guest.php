<?php

namespace PlanIt\ModuleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Guest")
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
    protected $slug;

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

    protected $type_paiement;
    protected $type_guest;

    /**
     * @ORM\ManyToOne(targetEntity="PlanIt\ModuleBundle\Entity\GuestsModule", inversedBy="guests")
     * @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     */
    protected $module;

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
     * Set slug
     *
     * @param string $slug
     * @return Guest
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
     * @param \PlanIt\ModuleBundle\Entity\GuestsModule $module
     * @return Guest
     */
    public function setModule(\PlanIt\ModuleBundle\Entity\GuestsModule $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \PlanIt\ModuleBundle\Entity\GuestsModule 
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
}