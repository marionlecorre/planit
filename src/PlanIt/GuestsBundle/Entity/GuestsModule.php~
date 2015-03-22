<?php
namespace PlanIt\GuestsBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use PlanIt\ModuleBundle\Entity\Module;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use JMS\Serializer\Annotation\Exclude;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="PlanIt\GuestsBundle\Repository\GuestsModuleRepository")
 * @ORM\Entity
 * @ORM\Table(name="guests_module")
 */
class GuestsModule extends Module
{
    /**
     * @ORM\Column(type="integer")
     * @Assert\Type(type="numeric", message="Attention, la valeur du nombre d'invités maximum est incorrecte. Celui-ci doit être un nombre.")
     */
    protected $maxguests;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $payable;
    /**
     * @ORM\Column(type="boolean")
     */
    // invitation =>0, inscription=>1
    protected $moduletype;
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
     * @Exclude
     */
    protected $event;
    /**
     * @ORM\OneToMany(targetEntity="PlanIt\GuestsBundle\Entity\Guest", mappedBy="module")
     * @Exclude
     */
    protected $guests;
    /**
     * @ORM\OneToMany(targetEntity="PlanIt\GuestsBundle\Entity\TypeGuest", mappedBy="module")
     */
    protected $typesguests;
    /**
     * @ORM\ManyToMany(targetEntity="PaymentMeans", inversedBy="users")
     * @ORM\JoinTable(name="paymentmeans_module")
     **/
    protected $paymentmeans;
 
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
    
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('maxguests', new NotBlank(array(
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
     * Add typesguests
     *
     * @param \PlanIt\GuestsBundle\Entity\TypeGuest $typesguests
     * @return GuestsModule
     */
    public function addTypesguest(\PlanIt\GuestsBundle\Entity\TypeGuest $typesguests)
    {
        $this->typesguests[] = $typesguests;

        return $this;
    }

    /**
     * Remove typesguests
     *
     * @param \PlanIt\GuestsBundle\Entity\TypeGuest $typesguests
     */
    public function removeTypesguest(\PlanIt\GuestsBundle\Entity\TypeGuest $typesguests)
    {
        $this->typesguests->removeElement($typesguests);
    }

    /**
     * Get typesguests
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTypesguests()
    {
        return $this->typesguests;
    }

    /**
     * Add paymentmeans
     *
     * @param \PlanIt\GuestsBundle\Entity\PaymentMeans $paymentmeans
     * @return GuestsModule
     */
    public function addPaymentmean(\PlanIt\GuestsBundle\Entity\PaymentMeans $paymentmeans)
    {
        $this->paymentmeans[] = $paymentmeans;

        return $this;
    }

    /**
     * Remove paymentmeans
     *
     * @param \PlanIt\GuestsBundle\Entity\PaymentMeans $paymentmeans
     */
    public function removePaymentmean(\PlanIt\GuestsBundle\Entity\PaymentMeans $paymentmeans)
    {
        $this->paymentmeans->removeElement($paymentmeans);
    }

    /**
     * Get paymentmeans
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPaymentmeans()
    {
        return $this->paymentmeans;
    }

    /**
     * Set maxguests
     *
     * @param integer $maxguests
     * @return GuestsModule
     */
    public function setMaxguests($maxguests)
    {
        $this->maxguests = $maxguests;

        return $this;
    }

    /**
     * Get maxguests
     *
     * @return integer 
     */
    public function getMaxguests()
    {
        return $this->maxguests;
    }

    /**
     * Set moduletype
     *
     * @param boolean $moduletype
     * @return GuestsModule
     */
    public function setModuletype($moduletype)
    {
        $this->moduletype = $moduletype;

        return $this;
    }

    /**
     * Get moduletype
     *
     * @return boolean 
     */
    public function getModuletype()
    {
        return $this->moduletype;
    }

    /**
     * Set inttype
     *
     * @param integer $inttype
     * @return GuestsModule
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

    public function getTotalPrice(){
        $total = 0;
        $typeguests = $this->getTypesguests();
        foreach ($typeguests as $type) {
            $guests = $type->getGuests();
            foreach ($guests as $guest) {
                if($guest->getConfirmed() == 1){
                    $total += $type->getPrice();
                }
            }
        }

        return $total;
    }
}
