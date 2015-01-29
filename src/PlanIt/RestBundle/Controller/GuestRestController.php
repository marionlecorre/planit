<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\GuestsBundle\Entity\Guest;
use PlanIt\GuestsBundle\Form\GuestType;
use PlanIt\GuestsBundle\Form\UpdateGuestType;

class GuestRestController extends Controller
{

	public function postGuestAction(Request $request, $module_id)
    {
	    $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);

        $guest = new Guest();
        $guest->setModule($module);

        $form = $this->createForm(new GuestType(), $guest);
        $form->handleRequest($request);
        $data = $form->getData();
        if ($form->isValid()) {
            $guest->setConfirmed(0);
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

    public function deleteGuestAction($guest_id)
    {
        $guest = $this->getDoctrine()->getRepository('PlanItGuestsBundle:Guest')->find($guest_id);
        $em = $em = $this->getDoctrine()
                       ->getEntityManager();
        $em->remove($guest);
        $em->flush();

    }

    public function putGuestAction(Request $request, $guest_id)
    {
        $guest = $this->getDoctrine()->getRepository('PlanItGuestsBundle:Guest')->find($guest_id);
        $form = $this->createForm(new UpdateGuestType(), $guest, array('method' => 'PUT'));
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($guest);
            $em->flush();
        }
    }   



}
