<?php

namespace PlanIt\BudgetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ExpenseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text', array('label'  => false, 'attr' => array('placeholder' => 'Article *')))
            ->add('unit','text', array('label'  => false, 'attr' => array('placeholder' => 'Unité (ex: Litres, bouteilles, etc.) *')))
            ->add('quantity','text', array('label'  => false, 'attr' => array('placeholder' => 'Quantité *')))
            ->add('stock','text', array('label'  => false, 'attr' => array('placeholder' => 'En stock *')))
            ->add('price','text', array('label'  => false, 'attr' => array('placeholder' => 'Prix Unitaire *')))

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PlanIt\BudgetBundle\Entity\Expense'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'planit_budgetbundle_expense';
    }
}