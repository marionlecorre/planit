<?php

namespace PlanIt\TodoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="task_list")
*/
class TaskList
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text", length=50)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="PlanIt\TodoBundle\Entity\Item", mappedBy="list")
     */
    protected $items;

    /**
     * @ORM\ManyToOne(targetEntity="PlanIt\TodoBundle\Entity\TodoModule", inversedBy="lists")
     * @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     */
    protected $module;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return TaskList
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
     * Set checked
     *
     * @param integer $checked
     * @return TaskList
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;

        return $this;
    }

    /**
     * Get checked
     *
     * @return integer 
     */
    public function getChecked()
    {
        return $this->checked;
    }

    /**
     * Add items
     *
     * @param \PlanIt\TodoBundle\Entity\Item $items
     * @return TaskList
     */
    public function addItem(\PlanIt\TodoBundle\Entity\Item $items)
    {
        $this->items[] = $items;

        return $this;
    }

    /**
     * Remove items
     *
     * @param \PlanIt\TodoBundle\Entity\Item $items
     */
    public function removeItem(\PlanIt\TodoBundle\Entity\Item $items)
    {
        $this->items->removeElement($items);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set module
     *
     * @param \PlanIt\TodoBundle\Entity\TodoModule $module
     * @return TaskList
     */
    public function setModule(\PlanIt\TodoBundle\Entity\TodoModule $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \PlanIt\TodoBundle\Entity\TodoModule 
     */
    public function getModule()
    {
        return $this->module;
    }
}
