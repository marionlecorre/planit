<?php

namespace PlanIt\GuestsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use PlanIt\GuestsBundle\Entity\PaymentMeans;
use PlanIt\GuestsBundle\Repository\PaymentMeansRepository;
use Doctrine\ORM\EntityRepository;

class PaymentMeansModuleType extends AbstractType
{

    protected $module;
    protected $payments;

    /*
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $module = $this->module;

        if(empty($paymentmeans)){
            $builder->add('PaymentMeans', 'entity', array(
                'class' => 'PlanItGuestsBundle:PaymentMeans',
                'property' => 'label',
            ));
        }else{
            $builder->add('PaymentMeans', 'entity', array(
                'class' => 'PlanItGuestsBundle:PaymentMeans',
                'query_builder' => function(EntityRepository $er) use ($module) {
                    return $er->createQueryBuilder('p')
                    ->where($er->createQueryBuilder('p')->expr()->notIn('p.id', ':ids'))
                    ->setParameter('ids', $er->createQueryBuilder('pp')
                    ->select('pp.id')
                    ->leftjoin('pp.modules', 'm')
                    ->where('m.id = :module_id')
                    ->setParameter('module_id', $module->getId())
                    ->getQuery()
                    ->getResult()
                    , \Doctrine\DBAL\Connection::PARAM_INT_ARRAY);
                },
            ));
        }
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PlanIt\GuestsBundle\Entity\GuestsModule'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'planit_guestsbundle_paymentmeans';
    }

    public function __construct(\PlanIt\ModuleBundle\Entity\Module $module, array $payments)
    {
        $this->module = $module;
        $this->payments = $payments;
    }
}