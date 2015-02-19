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
            ->add('label','text', array('label'  => false, 'attr' => array('placeholder' => 'form.typeguest.category')));
        if($module_type == 0){
            $builder->add('message','textarea', array('label'  => false, 'attr' => array('placeholder' => 'form.typeguest.mail')));

        }
        if($payable == 1){
            $builder->add('price', 'text', array('label'  => false, 'attr' => array('placeholder' => 'form.typeguest.price')));
        }
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PlanIt\GuestsBundle\Entity\TypeGuest',
            'csrf_protection' => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'typeguest_form';
    }

    public function __construct($module_type,$payable)
    {
        $this->module_type = $module_type;
        $this->payable = $payable;

    }
}