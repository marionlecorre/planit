<?php

namespace PlanIt\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // add your custom field
        $builder->add('firstname', 'text', array('label' => false, 'translation_domain' => 'FOSUserBundle', 'attr'=> array('placeholder'=>'Prénom')))
                ->add('lastname', 'text', array('label' => false, 'translation_domain' => 'FOSUserBundle', 'attr'=> array('placeholder'=>'Nom')))
                ->add('email', 'email', array('label' => false, 'translation_domain' => 'FOSUserBundle', 'attr'=> array('placeholder'=>'Email')))
                ->add('plainPassword', 'repeated', array(
                    'type' => 'password',
                    'options' => array('translation_domain' => 'FOSUserBundle'),
                    'first_options' => array('label' => false, 'attr'=>array('placeholder'=>'form.password')),
                    'second_options' => array('label'=> false, 'attr'=>array('placeholder'=>'form.password_confirmation')),
                    'invalid_message' => 'fos_user.password.mismatch',
                ))
                ->add('image', 'file',array('required' => false, 'label' => false, 'label_attr' => array('class'=>'file')));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PlanIt\UserBundle\Entity\User',
            'intention'  => 'registration',
        ));
    }

    public function getName()
    {
        return 'planit_user_registration';
    }
}