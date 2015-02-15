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
            ->add('quantity','text', array('label'  => false, 'attr' => array('placeholder' => 'Quantité *')))
            ->add('unit','text', array('label'  => false, 'attr' => array('placeholder' => 'Unité (ex: Litres, bouteilles, etc.) *')))
            ->add('stock','text', array('label'  => false, 'attr' => array('placeholder' => 'Déjà en stock *')))
            ->add('price','text', array('label'  => false, 'attr' => array('placeholder' => 'Prix Unitaire *')))

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PlanIt\BudgetBundle\Entity\Expense',
            'csrf_protection' => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'expense_form';
    }
}