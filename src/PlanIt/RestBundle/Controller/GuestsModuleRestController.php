<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\GuestsBundle\Entity\GuestsModule;
use PlanIt\GuestsBundle\Form\GuestsModuleType;

class GuestsModuleRestController extends Controller
{

	public function postGuestsmoduleAction(Request $request, $event_id)
    {
        $event = $this->getDoctrine()->getRepository('PlanItEventBundle:Event')->find($event_id);

        $guests_module = new GuestsModule();
        $guests_module->setEvent($event);
        $form    = $this->createForm(new GuestsModuleType(), $guests_module);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            $guests_module->setSlug($data->getName());
            $guests_module->setIntType(1);
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($guests_module);
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
