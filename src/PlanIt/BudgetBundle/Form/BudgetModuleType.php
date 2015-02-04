<?php

namespace PlanIt\BudgetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use PlanIt\ModuleBundle\Form\ModuleType;

class BudgetModuleType extends ModuleType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('max_budget', 'text', array('label'  => false,'required' => false, 'attr' => array('placeholder' => 'Budget maximum (€)'), 'empty_data' => 0 ))
            ->add('base', 'text', array('label'  => false,'required' => false, 'attr' => array('placeholder' => 'Apport de base (€)'), 'empty_data' => 0))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PlanIt\BudgetBundle\Entity\BudgetModule'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'planit_budgetbundle_budgetmodule';
    }
}
