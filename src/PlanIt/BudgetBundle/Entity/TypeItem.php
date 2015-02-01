<?php

namespace PlanIt\BudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PlanIt\ModuleBundle\Entity\Module;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @ORM\Entity(repositoryClass="PlanIt\BudgetBundle\Repository\TypeItemRepository")
 * @ORM\Entity
 * @ORM\Table(name="type_item")
 */
class TypeItem 
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
     * @ORM\Column(type="boolean")
     */
    // 0=> dépense, 1 => apport
    protected $type;

    /**
     * @ORM\ManyToOne(targetEntity="PlanIt\BudgetBundle\Entity\BudgetModule", inversedBy="type_item")
     * @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     */
    protected $module;

}