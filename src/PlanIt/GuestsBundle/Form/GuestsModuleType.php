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
            ->add('guestmodule_type', 'choice', array('label'  => false,'choices'  => array('0' => 'Invitation', '1' => 'Inscription')))
            ->add('max_guests' , 'text', array('label'  => false, 'attr' => array('placeholder' => 'Nombre d\'invité maximum')))
            ->add('payable', 'checkbox', array('label'  => 'Événement payant?'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PlanIt\GuestsBundle\Entity\GuestsModule'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'planit_guestsbundle_guestsmodule';
    }
}
