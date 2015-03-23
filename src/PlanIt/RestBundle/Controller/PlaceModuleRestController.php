<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\PlaceBundle\Entity\PlaceModule;
use PlanIt\PlaceBundle\Form\PlaceModuleType;

class PlaceModuleRestController extends Controller
{

	public function postPlacemoduleAction(Request $request, $event_id)
    {
        $event = $this->getDoctrine()->getRepository('PlanItEventBundle:Event')->find($event_id);

        $place_module = new PlaceModule();
        $place_module->setEvent($event);
        $form    = $this->createForm(new PlaceModuleType(), $place_module);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $place_module->setIntType(3);
            $place_module->setName('Gestion du lieu');
            $place_module->setSlug($place_module->getName());
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($place_module);
            $em->flush();
            
            return $this->redirect($this->generateUrl('PlanItEventBundle_event', array(
                'id'    => $event->getId()
            )));
        }
        $session = $request->getSession();
        $errors = $this->get('validator')->validate( $place_module );
        foreach( $errors as $error )
        {
            $session->getFlashBag()->add('errors', $error->getMessage());
        }
        return $this->redirect($this->generateUrl('PlanItEventBundle_event', array(
                'id'    => $event->getId()
            )));
    }

    public function postPlacemoduleUpdateAction(Request $request, $module_id)
    {
        
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);
        $form    = $this->createForm(new PlaceModuleType(), $module);
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
