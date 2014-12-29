<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\GuestsBundle\Entity\Guest;
use PlanIt\GuestsBundle\Form\GuestType;

class GuestRestController extends Controller
{
    /*public function postGuestAction($id){
	    $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($id);
	    if(!is_object($module)){
	      throw $this->createNotFoundException();
	    }
	    return $module;
	}*/

	public function postGuestAction($module_id)
    {
	    $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);

        $guest = new Guest();
        $guest->setModule($module);
        $request = $this->getRequest();
        $form    = $this->createForm(new GuestType(), $guest);
        $form->BIND($request);

        if ($form->isValid()) {
            $guest->setConfirmed(2);
            $guest->setPayed(0);
            $guest->setSent(0);
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($guest);
            $em->flush();

            return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $guest->getModule()->getEvent()->getId(),
                'module_id'   => $guest->getModule()->getId()
            )));
        }

        return $this->render('PlanItGuestsBundle:Page:index.html.twig', array(
            'event_id'    => $guest->getModule()->getEvent()->getId(),
            'module_id'   => $comment->getModule()->getId()
        ));
    }
}
