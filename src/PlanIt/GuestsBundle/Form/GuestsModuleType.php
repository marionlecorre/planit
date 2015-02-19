<?php

namespace PlanIt\GuestsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use PlanIt\ModuleBundle\Form\ModuleType;

class GuestsModuleType extends ModuleType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('moduletype', 'choice', array('label'  => false,'choices'  => array('0' => 'form.module.invitation', '1' => 'form.module.inscription')))
            ->add('maxguests' , 'text', array('label'  => false, 'attr' => array('placeholder' => 'form.module.nb_guests')))
            ->add('payable', 'checkbox', array('required' => false, 'label'  => 'form.module.payable'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PlanIt\GuestsBundle\Entity\GuestsModule',
            'csrf_protection' => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'guestsmodule_form';
    }
}
