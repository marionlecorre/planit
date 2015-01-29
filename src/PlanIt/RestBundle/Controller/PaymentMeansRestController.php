<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\GuestsBundle\Entity\PaymentMeans;
use PlanIt\GuestsBundle\Form\PaymentMeansType;

class PaymentMeansRestController extends Controller
{

	// public function postTypeGuestAction(Request $request, $module_id)
 //    {
 //        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);

 //        $paymentmean = new PaymentMeans();
 //        $paymentmean->setModule($module);

 //        $form    = $this->createForm(new PaymentMeansType(), $paymentmean);
 //        $form->handleRequest($request);
 //        $data = $form->getData();

 //        if ($form->isValid()) {
 //            $em = $this->getDoctrine()
 //                       ->getEntityManager();
 //            $em->persist($paymentmean);
 //            $em->flush();

 //            return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
 //                'event_id'    => $module->getEvent()->getId(),
 //                'module_id'   => $module->getId()
 //            )));
 //        }
 //        return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
 //            'event_id'    => $module->getEvent()->getId(),
 //            'module_id'   => $module->getId()
 //        )));
 //    }
}