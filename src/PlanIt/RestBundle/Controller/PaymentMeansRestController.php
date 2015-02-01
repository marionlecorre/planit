<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\GuestsBundle\Entity\PaymentMeans;
use PlanIt\GuestsBundle\Form\PaymentMeansModuleType;

class PaymentMeansRestController extends Controller
{

	public function postPaymentmeansAction(Request $request, $module_id)
    {
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);
        $paymentmean = $this->getDoctrine()->getRepository('PlanItGuestsBundle:PaymentMeans')->find($request->request->get('planit_guestsbundle_paymentmeans')['PaymentMeans']);
        $module->addPaymentMean($paymentmean);

        $em = $this->getDoctrine()
                   ->getEntityManager();
        $em->persist($module);
        $em->flush();

        return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
            'event_id'    => $module->getEvent()->getId(),
            'module_id'   => $module->getId()
        )));
    }
}