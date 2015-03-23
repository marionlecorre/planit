<?php

namespace PlanIt\PlaceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use PlanIt\ModuleBundle\Form\ModuleType;

class PlaceModuleType extends ModuleType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('max_capacity_p', 'text', array('required' => false, 'label'  => 'form.module.max_capacity'))
            ->add('max_price_p', 'text', array('label'  => 'form.module.price'))
            ->add('max_time_to_go', 'text', array('label'  => 'form.module.time'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PlanIt\PlaceBundle\Entity\PlaceModule',
            'csrf_protection' => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'placemodule_form';
    }
}
