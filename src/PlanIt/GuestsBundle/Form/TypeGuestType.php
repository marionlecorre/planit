<?php

namespace PlanIt\GuestsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TypeGuestType extends AbstractType
{
    
    protected $module_type;

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $module_type = $this->module_type;
        $payable = $this->payable;

        $builder
            ->add('label','text', array('label'  => false, 'attr' => array('placeholder' => 'Nom de la catégorie *')));
        if($module_type == 0){
            $builder->add('message','textarea', array('label'  => false, 'attr' => array('placeholder' => 'Contenu du mail d\'invitation *')));

        }
        if($payable == 1){
            $builder->add('price', 'text', array('label'  => false, 'attr' => array('placeholder' => 'Prix *')));
        }
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PlanIt\GuestsBundle\Entity\TypeGuest'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'planit_guestsbundle_typeguest';
    }

    public function __construct($module_type,$payable)
    {
        $this->module_type = $module_type;
        $this->payable = $payable;

    }
}