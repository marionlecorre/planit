<?php
namespace PlanIt\TransportationBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use PlanIt\ModuleBundle\Entity\Module;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
/**
 * @ORM\Entity(repositoryClass="PlanIt\TransportationBundle\Repository\TransportationModuleRepository")
 * @ORM\Entity
 * @ORM\Table(name="budget_module")
 */
class TransportationModule extends Module
{
    /**
     * @ORM\Column(type="integer")
     */
    protected $max_capacity_t;
    /**
     * @ORM\Column(type="integer")
     */
    protected $max_price_t;
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
     * Set max_capacity_t
     *
     * @param integer $maxCapacityT
     * @return TransportationModule
     */
    public function setMaxCapacityT($maxCapacityT)
    {
        $this->max_capacity_t = $maxCapacityT;
        return $this;
    }
    /**
     * Get max_capacity_t
     *
     * @return integer 
     */
    public function getMaxCapacityT()
    {
        return $this->max_capacity_t;
    }
    /**
     * Set max_price_t
     *
     * @param integer $maxPriceT
     * @return TransportationModule
     */
    public function setMaxPriceT($maxPriceT)
    {
        $this->max_price_t = $maxPriceT;
        return $this;
    }
    /**
     * Get max_price_t
     *
     * @return integer 
     */
    public function getMaxPriceT()
    {
        return $this->max_price_t;
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
     * @return TransportationModule
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
     * @return TransportationModule
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
     * @return TransportationModule
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
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('max_capacity_t', new NotBlank(array(
            'message' => 'Merci de renseigner la capacité maximale souhaitée'
        )));
        $metadata->addPropertyConstraint('max_capacity_t', new NotBlank(array(
            'message' => 'Merci de renseigner le prix maximal'
        )));
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
     * Set inttype
     *
     * @param integer $inttype
     * @return TransportationModule
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
