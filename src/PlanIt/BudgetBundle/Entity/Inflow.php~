<?php

namespace PlanIt\BudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="inflow")
 * @ORM\Entity(repositoryClass="PlanIt\BudgetBundle\Repository\InflowRepository")
 */
class Inflow
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
     * @ORM\Column(type="float")
     */
    protected $amount;

    /**
     * @ORM\ManyToOne(targetEntity="PlanIt\BudgetBundle\Entity\BudgetModule", inversedBy="inflows")
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
     * @return Inflow
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
     * Set amount
     *
     * @param float $amount
     * @return Inflow
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set module
     *
     * @param \PlanIt\BudgetBundle\Entity\BudgetModule $module
     * @return Inflow
     */
    public function setModule(\PlanIt\BudgetBundle\Entity\BudgetModule $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \PlanIt\BudgetBundle\Entity\BudgetModule 
     */
    public function getModule()
    {
        return $this->module;
    }
}
