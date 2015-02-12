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

        /*return $this->render('PlanItGuestsBundle:Page:index.html.twig', array(
            'event_id'    => $guest->getModule()->getEvent()->getId(),
            'module_id'   => $comment->getModule()->getId()
        ));*/
    }
}
