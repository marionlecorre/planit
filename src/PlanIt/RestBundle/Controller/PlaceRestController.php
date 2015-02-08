<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\PlaceBundle\Entity\Place;
use PlanIt\PlaceBundle\Form\PlaceType;

class PlaceRestController extends Controller
{

    public function postPlaceAction(Request $request, $module_id)
    {
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);

        $place = new Place();
        $place->setModule($module);

        $form = $this->createForm(new PlaceType(), $place);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $place->setState(2);
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($place);
            $em->flush();

            return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $place->getModule()->getEvent()->getId(),
                'module_id'   => $place->getModule()->getId()
            )));
        }
        return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
            'event_id'    => $place->getModule()->getEvent()->getId(),
            'module_id'   => $place->getModule()->getId()
        )));
    }

    // public function deleteGuestAction($guest_id)
    // {
    //     $guest = $this->getDoctrine()->getRepository('PlanItGuestsBundle:Guest')->find($guest_id);
    //     $em = $em = $this->getDoctrine()
    //                    ->getEntityManager();
    //     $em->remove($guest);
    //     $em->flush();
    //     return $guest->getModule();

    // }

    // public function putGuestAction(Request $request, $guest_id)
    // {
    //     $guest = $this->getDoctrine()->getRepository('PlanItGuestsBundle:Guest')->find($guest_id);
    //     $form = $this->createForm(new UpdateGuestType(), $guest, array('method' => 'PUT'));
    //     $form->handleRequest($request);
    //     if ($form->isValid()) {
    //         $em = $this->getDoctrine()->getManager();
    //         $em->persist($guest);
    //         $em->flush();
    //         return $guest->getModule();
    //     }
    // }



}
