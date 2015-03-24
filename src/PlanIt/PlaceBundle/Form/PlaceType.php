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
            ->add('name','text', array('label'  => 'form.place.name'))
            ->add('address','text', array('label'  => 'form.place.address'))
            ->add('tel','text', array('label'  => 'tel', 'required' => false))
            ->add('distance','text', array('label'  => 'distance', 'required' => false))
            ->add('price','text', array('label'  => 'form.place.price', 'required' => false))
            ->add('capacity','text', array('label'  => 'capacity', 'required' => false))
            ->add('website','text', array('label'  => 'form.place.website', 'required' => false))
            ->add('remark','textarea', array('label'  => 'form.place.remark', 'required' => false));
        if($type == "add"){
            $builder->add('image', 'file',array('label'  => 'form.place.image', 'required' => false, 'label_attr' => array('class'=>'file bt_file')))            
                    ->add('contract', 'file',array('label'  => 'contract', 'required' => false, 'label_attr' => array('class'=>'file bt_file')));  
        } 
        $builder->add('state','choice', array(
                                        'choices'   => array(
                                            '' => '',
                                            0   => 'refused',
                                            2 => 'contacted',
                                            3 => 'tocontact',
                                        ), 'label'  => false, 'attr' => array('placeholder' => 'form.place.state')));

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
