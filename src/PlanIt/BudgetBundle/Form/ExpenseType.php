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
            ->add('name','text', array('label'  => 'form.expense.item'))
            ->add('quantity','text', array('label'  => 'form.expense.quantity'))
            ->add('unit','text', array('label'  => 'form.expense.unit', 'attr' => array('placeholder' => 'form.expense.unit_placeholder')))
            ->add('stock','text', array('label'  => 'form.expense.stock'))
            ->add('price','text', array('label'  => 'form.expense.unit_price'))

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