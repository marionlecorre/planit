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

        /*return $this->render('PlanItGuestsBundle:Page:index.html.twig', array(
            'event_id'    => $guest->getModule()->getEvent()->getId(),
            'module_id'   => $comment->getModule()->getId()
        ));*/
    }
}
