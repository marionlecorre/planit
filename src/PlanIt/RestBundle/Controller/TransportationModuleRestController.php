<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\TransportationBundle\Entity\TransportationModule;
use PlanIt\TransportationBundle\Form\TransportationModuleType;

class TransportationModuleRestController extends Controller
{

	public function postTransportationmoduleAction(Request $request, $event_id)
    {
        $event = $this->getDoctrine()->getRepository('PlanItEventBundle:Event')->find($event_id);

        $transportation_module = new TransportationModule();
        $transportation_module->setEvent($event);
        $form    = $this->createForm(new TransportationModuleType(), $transportation_module);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $transportation_module->setIntType(4);
            $transportation_module->setName('Gestion du transport');
            $transportation_module->setSlug($transportation_module->getName());
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($transportation_module);
            $em->flush();
            
            return $this->redirect($this->generateUrl('PlanItEventBundle_event', array(
                'id'    => $event->getId()
            )));
        }

        $session = $request->getSession();
        $errors = $this->get('validator')->validate( $transportation_module );
        foreach( $errors as $error )
        {
            $session->getFlashBag()->add('errors', $error->getMessage());
        }
        return $this->redirect($this->generateUrl('PlanItEventBundle_event', array(
                'id'    => $event->getId()
            )));
    }

    public function postTransportationmoduleUpdateAction(Request $request, $module_id)
    {
        
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);
        $form    = $this->createForm(new TransportationModuleType(), $module);
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
