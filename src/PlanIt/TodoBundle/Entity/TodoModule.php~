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
     * @ORM\OneToMany(targetEntity="PlanIt\TodoBundle\Entity\TaskList", mappedBy="module")
     */
    protected $lists;
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
        $this->lists = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add lists
     *
     * @param \PlanIt\TodoBundle\Entity\TaskList $lists
     * @return TodoModule
     */
    public function addList(\PlanIt\TodoBundle\Entity\TaskList $lists)
    {
        $this->lists[] = $lists;

        return $this;
    }

    /**
     * Remove lists
     *
     * @param \PlanIt\TodoBundle\Entity\TaskList $lists
     */
    public function removeList(\PlanIt\TodoBundle\Entity\TaskList $lists)
    {
        $this->lists->removeElement($lists);
    }

    /**
     * Get lists
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLists()
    {
        return $this->lists;
    }
}
