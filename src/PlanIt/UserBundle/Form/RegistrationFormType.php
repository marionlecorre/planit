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
        $builder->add('firstname', 'text', array('label' => 'Prénom', 'translation_domain' => 'FOSUserBundle'))
                ->add('lastname', 'text', array('label' => 'Nom', 'translation_domain' => 'FOSUserBundle'))
                ->add('email', 'email', array('label' => 'Email', 'translation_domain' => 'FOSUserBundle'))
                ->add('image', 'file',array('required' => false, 'label'  => 'form.registration.image', 'label_attr' => array('class'=>'file')))
                ->add('plainPassword', 'repeated', array(
                    'type' => 'password',
                    'options' => array('translation_domain' => 'FOSUserBundle'),
                    'first_options' => array('label' => 'form.password'),
                    'second_options' => array('label' => 'form.password_confirmation'),
                    'invalid_message' => 'fos_user.password.mismatch',
                ));

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