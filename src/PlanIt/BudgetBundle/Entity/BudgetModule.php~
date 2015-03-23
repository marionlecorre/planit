<?php
namespace PlanIt\BudgetBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use PlanIt\ModuleBundle\Entity\Module;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use JMS\Serializer\Annotation\Exclude;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="PlanIt\BudgetBundle\Repository\BudgetModuleRepository")
 * @ORM\Entity
 * @ORM\Table(name="budget_module")
 */
class BudgetModule extends Module
{
    /**
     * @ORM\Column(type="integer")
     * @Assert\Type(type="numeric", message="Attention, la valeur du champs budget est incorrecte. Le budget doit être un nombre.")
     */
    protected $max_budget;
    /**
     * @ORM\Column(type="integer")
     * @Assert\Type(type="numeric", message="Attention, la valeur du champs apport est incorrecte. L'apport doit être un nombre.")
     */
    protected $base;
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
     * @ORM\OneToMany(targetEntity="PlanIt\BudgetBundle\Entity\TypeExpense", mappedBy="module")
     */
    protected $typesexpense;
    /**
     * @ORM\OneToMany(targetEntity="PlanIt\BudgetBundle\Entity\Inflow", mappedBy="module")
     */
    protected $inflows;
    // *
    //  * @ORM\OneToMany(targetEntity="PlanIt\BudgetBundle\Entity\Expense", mappedBy="module")
     
    // protected $expenses;
    /**
     * Set max_budget
     *
     * @param integer $maxBudget
     * @return BudgetModule
     */
    public function setMaxBudget($maxBudget)
    {
        $this->max_budget = $maxBudget;
        return $this;
    }
    /**
     * Get max_budget
     *
     * @return integer 
     */
    public function getMaxBudget()
    {
        return $this->max_budget;
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
     * @return BudgetModule
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
     * @return BudgetModule
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
     * @return BudgetModule
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
        $metadata->addPropertyConstraint('max_budget', new NotBlank(array(
            'message' => 'Merci de renseigner un bdget maximum'
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
     * Constructor
     */
    public function __construct()
    {
        $this->typesexpense = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Set base
     *
     * @param integer $base
     * @return BudgetModule
     */
    public function setBase($base)
    {
        $this->base = $base;
        return $this;
    }
    /**
     * Get base
     *
     * @return integer 
     */
    public function getBase()
    {
        return $this->base;
    }
    /**
     * Add inflows
     *
     * @param \PlanIt\BudgetBundle\Entity\Inflow $inflows
     * @return BudgetModule
     */
    public function addInflow(\PlanIt\BudgetBundle\Entity\Inflow $inflows)
    {
        $this->inflows[] = $inflows;
        return $this;
    }
    /**
     * Remove inflows
     *
     * @param \PlanIt\BudgetBundle\Entity\Inflow $inflows
     */
    public function removeInflow(\PlanIt\BudgetBundle\Entity\Inflow $inflows)
    {
        $this->inflows->removeElement($inflows);
    }
    /**
     * Get inflows
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInflows()
    {
        return $this->inflows;
    }

    public function getBalance()
    {
        $balance = 0;
        foreach ($this->getInflows() as $inflow) {
            $balance += $inflow->getAmount();
        }
        foreach ($this->getTypesExpense() as $typeExpense){
            foreach ($typeExpense->getExpenses() as $expense){
                $expenses = $expense->getPrice()* ($expense->getQuantity() - $expense->getStock());
                $balance -= $expenses;
            }
        }
        return $balance;
    }

    public function getTotalInflows()
    {
        $total = 0;
        foreach ($this->getInflows() as $inflow) {
            $total += $inflow->getAmount();
        }
        return $total;
    }

    public function getTotalExpenses()
    {
        $total = $this->getBase();
        foreach ($this->getTypesExpense() as $typeExpense){
            foreach ($typeExpense->getExpenses() as $expense){
                $expenses = $expense->getPrice()* ($expense->getQuantity() - $expense->getStock());
                $total += $expenses;
            }
        }
        return $total;
    }

    /**
     * Set inttype
     *
     * @param integer $inttype
     * @return BudgetModule
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
     * Add typesexpense
     *
     * @param \PlanIt\BudgetBundle\Entity\TypeExpense $typesexpense
     * @return BudgetModule
     */
    public function addTypesexpense(\PlanIt\BudgetBundle\Entity\TypeExpense $typesexpense)
    {
        $this->typesexpense[] = $typesexpense;

        return $this;
    }

    /**
     * Remove typesexpense
     *
     * @param \PlanIt\BudgetBundle\Entity\TypeExpense $typesexpense
     */
    public function removeTypesexpense(\PlanIt\BudgetBundle\Entity\TypeExpense $typesexpense)
    {
        $this->typesexpense->removeElement($typesexpense);
    }

    /**
     * Get typesexpense
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTypesexpense()
    {
        return $this->typesexpense;
    }
}
