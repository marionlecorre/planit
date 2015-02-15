<?php
namespace PlanIt\GuestsBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use PlanIt\ModuleBundle\Entity\Module;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
/**
 * @ORM\Entity(repositoryClass="PlanIt\GuestsBundle\Repository\GuestsModuleRepository")
 * @ORM\Entity
 * @ORM\Table(name="guests_module")
 */
class GuestsModule extends Module
{
    /**
     * @ORM\Column(type="integer", length=1)
     */
    protected $listType;
    /**
     * @ORM\Column(type="integer")
     */
    protected $max_guests;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $payable;
    /**
     * @ORM\Column(type="boolean")
     */
    // invitation =>0, inscription=>1
    protected $guestmodule_type;
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
    protected $int_type;
    /**
     * @var \PlanIt\EventBundle\Entity\Event
     */
    protected $event;
    /**
     * @ORM\OneToMany(targetEntity="PlanIt\GuestsBundle\Entity\Guest", mappedBy="module")
     */
    protected $guests;
    /**
     * @ORM\OneToMany(targetEntity="PlanIt\GuestsBundle\Entity\TypeGuest", mappedBy="module")
     */
    protected $type_guest;
    /**
     * @ORM\ManyToMany(targetEntity="PaymentMeans", inversedBy="users")
     * @ORM\JoinTable(name="paymentmeans_module")
     **/
    protected $payment_means;
 
    /**
     * Set list_type
     *
     * @param integer $listType
     * @return GuestsModule
     */
    public function setListType($listType)
    {
        $this->listType = $listType;
        return $this;
    }
    /**
     * Get list_type
     *
     * @return integer 
     */
    public function getListType()
    {
        return $this->listType;
    }
    /**
     * Set max_guests
     *
     * @param integer $maxGuests
     * @return GuestsModule
     */
    public function setMaxGuests($maxGuests)
    {
        $this->max_guests = $maxGuests;
        return $this;
    }
    /**
     * Get max_guests
     *
     * @return integer 
     */
    public function getMaxGuests()
    {
        return $this->max_guests;
    }
    /**
     * Set payable
     *
     * @param boolean $payable
     * @return GuestsModule
     */
    public function setPayable($payable)
    {
        $this->payable = $payable;
        return $this;
    }
    /**
     * Get payable
     *
     * @return boolean 
     */
    public function getPayable()
    {
        return $this->payable;
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
     * @return GuestsModule
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
     * @return GuestsModule
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
     * Set int_type
     *
     * @param integer $intType
     * @return GuestsModule
     */
    public function setIntType($intType)
    {
        $this->int_type = $intType;
        return $this;
    }
    /**
     * Get int_type
     *
     * @return integer 
     */
    public function getIntType()
    {
        return $this->int_type;
    }
    /**
     * Set event
     *
     * @param \PlanIt\EventBundle\Entity\Event $event
     * @return GuestsModule
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->guests = new \Doctrine\Common\Collections\ArrayCollection();
        $this->type_guest = new \Doctrine\Common\Collections\ArrayCollection();
        $this->payment_means = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Add guests
     *
     * @param \PlanIt\GuestsBundle\Entity\Guest $guests
     * @return GuestsModule
     */
    public function addGuest(\PlanIt\GuestsBundle\Entity\Guest $guests)
    {
        $this->guests[] = $guests;
        return $this;
    }
    /**
     * Remove guests
     *
     * @param \PlanIt\GuestsBundle\Entity\Guest $guests
     */
    public function removeGuest(\PlanIt\GuestsBundle\Entity\Guest $guests)
    {
        $this->guests->removeElement($guests);
    }
    /**
     * Get guests
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGuests()
    {
        return $this->guests;
    }
    /**
     * Add type_guest
     *
     * @param \PlanIt\GuestsBundle\Entity\TypeGuest $typeGuest
     * @return GuestsModule
     */
    public function addTypeGuest(\PlanIt\GuestsBundle\Entity\TypeGuest $typeGuest)
    {
        $this->type_guest[] = $typeGuest;
        return $this;
    }
    /**
     * Remove type_guest
     *
     * @param \PlanIt\GuestsBundle\Entity\TypeGuest $typeGuest
     */
    public function removeTypeGuest(\PlanIt\GuestsBundle\Entity\TypeGuest $typeGuest)
    {
        $this->type_guest->removeElement($typeGuest);
    }
    /**
     * Get type_guest
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTypeGuest()
    {
        return $this->type_guest;
    }
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('max_guests', new NotBlank(array(
            'message' => 'Merci de renseigner le nombre maximal d\'invités'
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
     * Add payment_means
     *
     * @param \PlanIt\GuestsBundle\Entity\PaymentMeans $paymentMeans
     * @return GuestsModule
     */
    public function addPaymentMean(\PlanIt\GuestsBundle\Entity\PaymentMeans $paymentMeans)
    {
        $this->payment_means[] = $paymentMeans;
        return $this;
    }
    /**
     * Remove payment_means
     *
     * @param \PlanIt\GuestsBundle\Entity\PaymentMeans $paymentMeans
     */
    public function removePaymentMean(\PlanIt\GuestsBundle\Entity\PaymentMeans $paymentMeans)
    {
        $this->payment_means->removeElement($paymentMeans);
    }
    /**
     * Get payment_means
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPaymentMeans()
    {
        return $this->payment_means;
    }
    /**
     * Set guestmodule_type
     *
     * @param boolean $guestmoduleType
     * @return GuestsModule
     */
    public function setGuestmoduleType($guestmoduleType)
    {
        $this->guestmodule_type = $guestmoduleType;
        return $this;
    }
    /**
     * Get guestmodule_type
     *
     * @return boolean 
     */
    public function getGuestmoduleType()
    {
        return $this->guestmodule_type;
    }
}
