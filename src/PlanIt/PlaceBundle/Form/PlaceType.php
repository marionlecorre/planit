<?php

namespace PlanIt\PlaceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlaceType extends AbstractType
{
    protected $type;

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $type = $this->type;
        $builder
            ->add('name','text', array('label'  => false, 'attr' => array('placeholder' => 'form.place.name')))
            ->add('address','text', array('label'  => false, 'attr' => array('placeholder' => 'form.place.address')))
            ->add('tel','text', array('label'  => false, 'required' => false, 'attr' => array('placeholder' => 'tel')))
            ->add('distance','text', array('label'  => false, 'required' => false, 'attr' => array('placeholder' => 'distance')))
            ->add('price','text', array('label'  => false, 'required' => false, 'attr' => array('placeholder' => 'form.place.price')))
            ->add('capacity','text', array('label'  => false, 'required' => false, 'attr' => array('placeholder' => 'capacity')))
            ->add('website','text', array('label'  => false, 'required' => false, 'attr' => array('placeholder' => 'website')))
            ->add('latitude','text', array('label'  => false, 'required' => false, 'attr' => array('placeholder' => 'form.place.latitude')))
            ->add('longitude','text', array('label'  => false, 'required' => false, 'attr' => array('placeholder' => 'form.place.longitude')))
            ->add('remark','text', array('label'  => false, 'required' => false, 'attr' => array('placeholder' => 'remark')));
        if($type == "add"){
            $builder->add('image', 'file',array('label'  => 'form.place.image', 'label_attr' => array('class'=>'file')))            
                    ->add('contract', 'file',array('label'  => 'contract', 'label_attr' => array('class'=>'file')));  
        } 
        $builder->add('state','choice', array(
                                        'choices'   => array(
                                            '' => '',
                                            0   => 'refused',
                                            2 => 'contacted',
                                            1   => 'accepted',
                                        ), 'label'  => false, 'attr' => array('placeholder' => 'state')));

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PlanIt\PlaceBundle\Entity\Place',
            'csrf_protection' => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'place_form';
    }

    public function __construct($type)
    {
        $this->type = $type;
    }
}
