<?php

namespace PlanIt\EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label'  => false, 'attr' => array('placeholder' => 'Nom')))
            ->add('description','text',array('label'  => false, 'attr' => array('placeholder' => 'Description')))
            ->add('begin_date','date', array(
                                'widget' => 'single_text',
                                'input' => 'datetime',
                                'format' => 'dd/MM/yyyy',
                                'attr' => array('class' => 'date'),
                                'label'  => false, 
                                'attr' => array('placeholder' => 'Date de début')
                                ))
            ->add('end_date','date', array(
                                'widget' => 'single_text',
                                'input' => 'datetime',
                                'format' => 'dd/MM/yyyy',
                                'attr' => array('class' => 'date'),
                                'label'  => false, 
                                'attr' => array('placeholder' => 'Date de fin')
                                ))
            ->add('image', 'file',array('label'  => 'Choisissez une image'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PlanIt\EventBundle\Entity\Event'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'planit_eventbundle_event';
    }
}