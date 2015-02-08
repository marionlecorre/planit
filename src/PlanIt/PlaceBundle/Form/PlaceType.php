<?php

namespace PlanIt\PlaceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlaceType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('name','text', array('label'  => false, 'attr' => array('placeholder' => 'Nom *')))
            ->add('address','text', array('label'  => false, 'attr' => array('placeholder' => 'Adresse *')))
            ->add('tel','text', array('label'  => false, 'required' => false, 'attr' => array('placeholder' => 'Téléphone')))
            ->add('distance','text', array('label'  => false, 'required' => false, 'attr' => array('placeholder' => 'Distance')))
            ->add('price','text', array('label'  => false, 'required' => false, 'attr' => array('placeholder' => 'Prix')))
            ->add('capacity','text', array('label'  => false, 'required' => false, 'attr' => array('placeholder' => 'Capacité')))
            ->add('website','text', array('label'  => false, 'required' => false, 'attr' => array('placeholder' => 'Site web')))
            ->add('latitude','text', array('label'  => false, 'required' => false, 'attr' => array('placeholder' => 'Latitude')))
            ->add('longitude','text', array('label'  => false, 'required' => false, 'attr' => array('placeholder' => 'Longitude')))
            ->add('remark','text', array('label'  => false, 'required' => false, 'attr' => array('placeholder' => 'Remarque')));

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PlanIt\PlaceBundle\Entity\Place'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'place';
    }
}
