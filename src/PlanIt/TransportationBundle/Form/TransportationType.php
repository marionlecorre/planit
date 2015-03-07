<?php

namespace PlanIt\TransportationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TransportationType extends AbstractType
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
            ->add('name','text', array('label'  => false, 'attr' => array('placeholder' => 'form.transportation.name')))
            ->add('tel','text', array('label'  => false, 'required' => false, 'attr' => array('placeholder' => 'tel')))
            ->add('price','text', array('label'  => false, 'required' => false, 'attr' => array('placeholder' => 'form.transportation.price')))
            ->add('capacity','text', array('label'  => false, 'required' => false, 'attr' => array('placeholder' => 'capacity')))
            ->add('website','text', array('label'  => false, 'required' => false, 'attr' => array('placeholder' => 'website')));
        if($type == "add"){
            $builder->add('image', 'file',array('label'  => 'form.transportation.image', 'required' => false, 'label_attr' => array('class'=>'file')))            
                    ->add('contract', 'file',array('label'  => 'contract', 'required' => false, 'label_attr' => array('class'=>'file')));  
        } 
        $builder->add('state','choice', array(
                                        'choices'   => array(
                                            '' => '',
                                            0   => 'refused',
                                            2 => 'contacted',
                                            3 => 'tocontact',
                                            1   => 'accepted',
                                        ), 'label'  => false, 'attr' => array('placeholder' => 'form.transportation.state')));

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PlanIt\TransportationBundle\Entity\Transportation',
            'csrf_protection' => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'transportation_form';
    }

    public function __construct($type)
    {
        $this->type = $type;
    }
}
