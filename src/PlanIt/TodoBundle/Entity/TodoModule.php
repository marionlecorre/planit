<?php
namespace PlanIt\TodoBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use PlanIt\ModuleBundle\Entity\Module;
/**
 * @ORM\Entity(repositoryClass="PlanIt\TodoBundle\Repository\TodoModuleRepository")
 * @ORM\Entity
 * @ORM\Table(name="todo_module")
 */
class TodoModule extends Module
{
    
    
    /**
     * @var integer
     */
    protected $id;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $slug;
    /**
     * @var integer
     */
    protected $inttype;
    /**
     * @var \PlanIt\EventBundle\Entity\Event
     */
    protected $event;
    /**
     * @ORM\OneToMany(targetEntity="PlanIt\TodoBundle\Entity\Item", mappedBy="module")
     */
    protected $items;
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
     * @return TodoModule
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
     * @return TodoModule
     */
    public function setSlug($slug)
    {
        $this->slug = $this->slugify($slug);
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
     * Set event
     *
     * @param \PlanIt\EventBundle\Entity\Event $event
     * @return TodoModule
     */
    public function setEvent(\PlanIt\EventBundle\Entity\Event $event = null)
    {
        $this->event = $event;
        return $this;
    }
    /**
     * Get event
     *
     * @return \PlanIt\EventBundle\Entity\Event 
     */
    public function getEvent()
    {
        return $this->event;
    }
    public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('#[^\\pL\d]+#u', '-', $text);
        // trim
        $text = trim($text, '-');
        // transliterate
        if (function_exists('iconv'))
        {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }
        // lowercase
        $text = strtolower($text);
        // remove unwanted characters
        $text = preg_replace('#[^-\w]+#', '', $text);
        if (empty($text))
        {
            return 'n-a';
        }
        return $text;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Add items
     *
     * @param \PlanIt\TodoBundle\Entity\Item $items
     * @return TodoModule
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
     * Set inttype
     *
     * @param integer $inttype
     * @return TodoModule
     */
    public function setInttype($inttype)
    {
        $this->inttype = $inttype;

        return $this;
    }

    /**
     * Get inttype
     *
     * @return integer 
     */
    public function getInttype()
    {
        return $this->inttype;
    }
}
