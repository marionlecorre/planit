<?php

namespace PlanIt\PlaceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @ORM\Entity
 * @ORM\Table(name="place")
 * @ORM\Entity(repositoryClass="PlanIt\PlaceBundle\Repository\PlaceRepository")
 */
class Place
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
     * @ORM\Column(type="text",nullable=true)
     */
    protected $address;

    /**
     * @ORM\Column(type="string", length=30,nullable=true)
     */
    protected $tel;

    /**
     * @ORM\Column(type="float",nullable=true)
     */
    protected $distance;

     /**
     * @ORM\Column(type="float",nullable=true)
     */
    protected $price;

     /**
     * @ORM\Column(type="float",nullable=true)
     */
    protected $capacity;

    /**
     * @ORM\Column(type="text",nullable=true)
     */
    protected $website;

    /**
     * @ORM\Column(type="float",nullable=true)
     */
    protected $latitude;

    /**
     * @ORM\Column(type="float",nullable=true)
     */
    protected $longitude;

    /**
     * @ORM\Column(type="text",nullable=true)
     */
    protected $remark;

    /**
     * @ORM\Column(type="text",nullable=true)
     */
    protected $image;

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
     * @ORM\ManyToOne(targetEntity="PlanIt\PlaceBundle\Entity\PlaceModule", inversedBy="places")
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
     * @return Place
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
     * Set address
     *
     * @param string $address
     * @return Place
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return Place
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
     * Set distance
     *
     * @param float $distance
     * @return Place
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Get distance
     *
     * @return float 
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Place
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
     * @return Place
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
     * @return Place
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
     * Set remark
     *
     * @param string $remark
     * @return Place
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

    /**
     * Set state
     *
     * @param integer $state
     * @return Place
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
     * Set map
     *
     * @param string $map
     * @return Place
     */
    public function setMap($map)
    {
        $this->map = $map;

        return $this;
    }

    /**
     * Get map
     *
     * @return string 
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * Set module
     *
     * @param \PlanIt\PlaceBundle\Entity\PlaceModule $module
     * @return Place
     */
    public function setModule(\PlanIt\PlaceBundle\Entity\PlaceModule $module = null)
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

    /**
     * Set latitude
     *
     * @param float $latitude
     * @return Place
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     * @return Place
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set contract
     *
     * @param string $contract
     * @return Place
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

    public function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'files/place/contracts';
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
        return 'images/place/places_pictures';
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Place
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
}
