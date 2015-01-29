<?php

namespace PlanIt\GuestsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UpdateGuestType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type_guest')
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('payed')
            ->add('confirmed')
            ->add('sent')
            ->add('paymentmean')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PlanIt\GuestsBundle\Entity\Guest'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'guest_update';
    }
}
