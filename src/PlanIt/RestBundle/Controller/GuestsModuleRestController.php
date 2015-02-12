<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\GuestsBundle\Entity\GuestsModule;
use PlanIt\GuestsBundle\Form\GuestsModuleType;

class GuestsModuleRestController extends Controller
{

	public function getGuestsmoduleInscriptionlinkAction($module_id){
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);
        return 'http://planit.dev:8888/app_dev.php/inscription/'.base64_encode($module->getId());
    }

    public function getGuestsmodulePaymentmeansAction($module_id){
        $payments = $this->getDoctrine()->getRepository('PlanItGuestsBundle:PaymentMeans')->findByGuestsModule($module_id);
        return $payments;
    }

    public function postGuestsmoduleAction(Request $request, $event_id)
    {
        $event = $this->getDoctrine()->getRepository('PlanItEventBundle:Event')->find($event_id);

        $guests_module = new GuestsModule();
        $guests_module->setEvent($event);
        $form    = $this->createForm(new GuestsModuleType(), $guests_module);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $guests_module->setIntType(1);
            $guests_module->setName('Gestion des invités');
            $guests_module->setSlug($guests_module->getName());
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($guests_module);
            $em->flush();
            
            return $this->redirect($this->generateUrl('PlanItEventBundle_event', array(
                'id'    => $event->getId()
            )));
        }

        return $this->redirect($this->generateUrl('PlanItEventBundle_event', array(
            'id'    => $event_id
        )));
    }

    public function putGuestsmodulePayableAction(Request $request, $module_id)
    {
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);
        $module->setPayable($request->request->get('payable'));
        $em = $this->getDoctrine()
                   ->getEntityManager();
        $em->persist($module);
        $em->flush();

        $link           = $this->getGuestsmoduleInscriptionlinkAction($module_id);
        $paymentmeans   = $this->getGuestsmodulePaymentmeansAction($module_id);
        return array(
            'module' => $module,
            'link' => $link,
            'paymentmeans' => $paymentmeans,
        );
    }

    public function postGuestsmoduleUpdateAction(Request $request, $module_id)
    {
        
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);
        $form    = $this->createForm(new GuestsModuleType(), $module);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($module);
            $em->flush();
            
            return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $module->getEvent()->getId(),
                'module_id'   => $module->getId()
            )));
        }

        return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $module->getEvent()->getId(),
                'module_id'   => $module->getId()
            )));
    }
}
