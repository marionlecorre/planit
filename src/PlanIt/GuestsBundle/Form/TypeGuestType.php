<?php

namespace PlanIt\GuestsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TypeGuestType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label','text', array('label'  => false, 'attr' => array('placeholder' => 'Nom *')))
            ->add('message','text', array('label'  => false, 'attr' => array('placeholder' => 'Contenu du mail d\'invitation *')))
            ->add('price', 'text', array('label'  => false, 'attr' => array('placeholder' => 'Prix *')))
        ;
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
}