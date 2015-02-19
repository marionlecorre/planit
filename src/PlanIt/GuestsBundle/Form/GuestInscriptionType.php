<?php

namespace PlanIt\GuestsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class GuestInscriptionType extends AbstractType
{
    protected $module;

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $module = $this->module;
        $builder
            ->add('firstname','text', array('label'  => false, 'attr' => array('placeholder' => 'form.guest.firstname')))
            ->add('lastname','text', array('label'  => false, 'attr' => array('placeholder' => 'form.guest.lastname')))
            ->add('email','text', array('label'  => false, 'attr' => array('placeholder' => 'form.guest.mail')))
            ->add('TypeGuest', 'entity', array(
                'class' => 'PlanItGuestsBundle:TypeGuest',
                'query_builder' => function(EntityRepository $er) use ($module) {
                    return $er->createQueryBuilder('t')
                    ->where('t.module = :module_id')
                    ->setParameter('module_id', $module->getId());
                },
                'label'  => 'form.guest.category',
            ));
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PlanIt\GuestsBundle\Entity\Guest',
            'csrf_protection' => false,

        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'inscription_form';
    }

    public function __construct(\PlanIt\ModuleBundle\Entity\Module $module)
    {
        $this->module = $module;
    }
}
