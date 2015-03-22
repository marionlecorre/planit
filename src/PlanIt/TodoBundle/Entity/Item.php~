<?php

namespace PlanIt\TodoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToOne(targetEntity="PlanIt\TodoBundle\Entity\TaskList", inversedBy="items")
     * @ORM\JoinColumn(name="list_id", referencedColumnName="id")
     */
    protected $list;

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

    /**
     * Set list
     *
     * @param \PlanIt\TodoBundle\Entity\TaskList $list
     * @return Item
     */
    public function setList(\PlanIt\TodoBundle\Entity\TaskList $list = null)
    {
        $this->list = $list;

        return $this;
    }

    /**
     * Get list
     *
     * @return \PlanIt\TodoBundle\Entity\TaskList 
     */
    public function getList()
    {
        return $this->list;
    }
}
