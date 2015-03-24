<?php
namespace PlanIt\EventBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class EventType extends AbstractType
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
            ->add('name', 'text', array('label'  => 'form.event.name'))
            ->add('description','textarea',array('required' => false, 'attr' => array('label' => 'form.event.desc')))
            ->add('begin_date','date', array(
                                'widget' => 'single_text',
                                'input' => 'datetime',
                                'format' => 'dd/MM/yyyy',
                                'label' =>'form.event.begin_date',
                                'attr' => array('class' => 'date')
                                ))
            ->add('end_date','date', array(
                                'required' => false,
                                'widget' => 'single_text',
                                'input' => 'datetime',
                                'format' => 'dd/MM/yyyy',
                                'label' =>'form.event.end_date',
                                'attr' => array('class' => 'date')
                                ));
            if($type == "add"){
                $builder->add('image', 'file',array('required' => false, 'label'  => 'form.event.image', 'label_attr' => array('class'=>'file')));
            }
            
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PlanIt\EventBundle\Entity\Event',
            'csrf_protection' => false,
        ));
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'event_form';
    }

    public function __construct($type)
    {
        $this->type = $type;
    }
}