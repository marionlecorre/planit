<?php

namespace PlanIt\EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PlanIt\EventBundle\Repository\EventRepository")
 * @ORM\Entity
 * @ORM\Table(name="event")
 */
class Event
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
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="PlanIt\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $begin_date;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $end_date;

    /**
     * @ORM\Column(type="string")
     */
    protected $image;

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
     * @return Event
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
     * @return Event
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
     * Set description
     *
     * @param string $description
     * @return Event
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set begin_date
     *
     * @param \DateTime $beginDate
     * @return Event
     */
    public function setBeginDate($beginDate)
    {
        $this->begin_date = $beginDate;

        return $this;
    }

    /**
     * Get begin_date
     *
     * @return \DateTime 
     */
    public function getBeginDate()
    {
        return $this->begin_date;
    }

    /**
     * Set end_date
     *
     * @param \DateTime $endDate
     * @return Event
     */
    public function setEndDate($endDate)
    {
        $this->end_date = $endDate;

        return $this;
    }

    /**
     * Get end_date
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * Set user
     *
     * @param \PlanIt\UserBundle\Entity\User $user
     * @return Event
     */
    public function setUser(\PlanIt\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \PlanIt\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Event
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