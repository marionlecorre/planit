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
            ->add('name','text', array('label'  => 'form.transportation.name'))
            ->add('tel','text', array('label'  => 'tel', 'required' => false))
            ->add('price','text', array('label'  => 'form.transportation.price', 'required' => false))
            ->add('capacity','text', array('label'  => 'form.transportation.capacity', 'required' => false))
            ->add('website','text', array('label'  => 'form.transportation.website', 'required' => false))
            ->add('remark','text', array('label'  => 'form.transportation.remark', 'required' => false));
        if($type == "add"){
            $builder->add('contract', 'file',array('label'  => 'contract', 'required' => false, 'label_attr' => array('class'=>'file')));  
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
