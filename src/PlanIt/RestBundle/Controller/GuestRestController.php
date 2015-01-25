<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\GuestsBundle\Entity\Guest;
use PlanIt\GuestsBundle\Form\GuestType;

class GuestRestController extends Controller
{

	public function postGuestAction(Request $request, $module_id)
    {
	    $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);

        $guest = new Guest();
        $guest->setModule($module);

        $form    = $this->createForm(new GuestType(), $guest);
        $form->handleRequest($request);
        $data = $form->getData();
        // var_dump($data);
        // $guest->test();

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
        return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
            'event_id'    => $guest->getModule()->getEvent()->getId(),
            'module_id'   => $guest->getModule()->getId()
        )));
    }

    public function deleteGuestAction($guest_id){
        //alert("coucou");
        //$guest = $this->getDoctrine()->getRepository('PlanItGuestsBundle:Module')->find($guest_id);
        // $em = $em = $this->getDoctrine()
        //                ->getEntityManager();
        //     $em->remove($guest);
        //     $em->flush();
    }
}
