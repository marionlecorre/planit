<?php

namespace PlanIt\TransportationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="transportation")
 * @ORM\Entity(repositoryClass="PlanIt\TransportationBundle\Repository\TransportationRepository")
 */
class Transportation
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
     * @ORM\Column(type="string", length=30,nullable=true)
     */
    protected $tel;

     /**
     * @ORM\Column(type="float",nullable=true)
     * @Assert\Type(type="numeric", message="Attention, le prix est incorrect. Celui-ci doit être un nombre.")
     */
    protected $price;

     /**
     * @ORM\Column(type="float",nullable=true)
     * @Assert\Type(type="numeric", message="Attention, la valeur de la capacité est incorrecte. Celle-ci doit être un nombre.")
     */
    protected $capacity;

    /**
     * @ORM\Column(type="text",nullable=true)
     */
    protected $website;

    /**
     * @ORM\Column(type="text",nullable=true)
     */
    protected $remark;

    /**
     * @ORM\Column(type="text",nullable=true)
     */
    protected $contract;

    /**
     * @ORM\Column(type="integer", length=1)
     */
    //0 => refusé, 1 => choisi, 2 => contacté, 3 => a contacter
    protected $state;

    /**
     * @ORM\Column(type="integer", length=1,nullable=true)
     */
    //0 => refusé, 1 => choisi, 2 => contacté, 3 => a contacter
    protected $oldstate;

    /**
     * @ORM\ManyToOne(targetEntity="PlanIt\TransportationBundle\Entity\TransportationModule", inversedBy="transportations")
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
     * Set name
     *
     * @param string $name
     * @return Transportation
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
     * Set tel
     *
     * @param string $tel
     * @return Transportation
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Transportation
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
     * Set capacity
     *
     * @param float $capacity
     * @return Transportation
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return float 
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return Transportation
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Transportation
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set contract
     *
     * @param string $contract
     * @return Transportation
     */
    public function setContract($contract)
    {
        $this->contract = $contract;

        return $this;
    }

    /**
     * Get contract
     *
     * @return string 
     */
    public function getContract()
    {
        return $this->contract;
    }

    /**
     * Set state
     *
     * @param integer $state
     * @return Transportation
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return integer 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set oldstate
     *
     * @param integer $oldstate
     * @return Transportation
     */
    public function setOldstate($oldstate)
    {
        $this->oldstate = $oldstate;

        return $this;
    }

    /**
     * Get oldstate
     *
     * @return integer 
     */
    public function getOldstate()
    {
        return $this->oldstate;
    }

    /**
     * Set module
     *
     * @param \PlanIt\PlaceBundle\Entity\PlaceModule $module
     * @return Transportation
     */
    public function setModule(\PlanIt\TransportationBundle\Entity\TransportationModule $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \PlanIt\PlaceBundle\Entity\PlaceModule 
     */
    public function getModule()
    {
        return $this->module;
    }

    public function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'files/transportation/contracts';
    }

    public function getImageUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/'.$this->getImageUploadDir();
    }

    protected function getImageUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'images/transportation/transportations_pictures';
    }

    /**
     * Set remark
     *
     * @param string $remark
     * @return Transportation
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;

        return $this;
    }

    /**
     * Get remark
     *
     * @return string 
     */
    public function getRemark()
    {
        return $this->remark;
    }
}
