<?php

namespace PlanIt\GuestsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\GuestsBundle\Entity\PaymentMeans;
use PlanIt\GuestsBundle\Form\PaymentMeansModuleType;

class PaymentMeansController extends Controller
{
    public function formAction($module_id)
    {
        $module = $this->getModule($module_id);


        $paymentmeans = new PaymentMeans();
        $payments = $this->getDoctrine()
            ->getEntityManager()
            ->getRepository('PlanItGuestsBundle:PaymentMeans')
            ->createQueryBuilder('pp')
                ->select('pp.id')
                ->leftjoin('pp.modules', 'm')
                ->where('m.id = :module_id')
                ->setParameter('module_id', $module->getId())
                ->getQuery()
                ->getResult();
        $form   = $this->createForm(new PaymentMeansModuleType($module, $payments), $module);

        return $this->render('PlanItGuestsBundle:PaymentMeans:form.html.twig', array(
            'paymentmeans' => $paymentmeans,
            'form'   => $form->createView(),
            'module_id' => $module_id
        ));
    }

    protected function getModule($module_id)
    {
        $em = $this->getDoctrine()
                    ->getEntityManager();

        $module = $em->getRepository('PlanItModuleBundle:Module')->find($module_id);

        if (!$module) {
            throw $this->createNotFoundException('Unable to find Module.');
        }

        return $module;
    }

}