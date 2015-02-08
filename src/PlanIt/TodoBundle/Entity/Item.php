<?php

namespace PlanIt\TodoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PlanIt\ModuleBundle\Entity\Module;

/**
 * @ORM\Entity
 * @ORM\Table(name="item")
 * @ORM\Entity(repositoryClass="PlanIt\TodoBundle\Repository\ItemRepository")
 */
class Item
{    
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text", length=100)
     */
    protected $content;

    /**
     * @ORM\ManyToOne(targetEntity="PlanIt\TodoBundle\Entity\TodoModule", inversedBy="items")
     * @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     */
    protected $module;

    /**
     * @ORM\Column(type="integer", length=1)
     */
    //0 => no, 1 => yes
    protected $checked;
    

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
     * Set content
     *
     * @param string $content
     * @return Item
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set module
     *
     * @param \PlanIt\TodoBundle\Entity\TodoModule $module
     * @return Item
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

    /**
     * Set checked
     *
     * @param integer $checked
     * @return Item
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
}
