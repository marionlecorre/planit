<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\PlaceBundle\Entity\Place;
use PlanIt\PlaceBundle\Form\PlaceType;
use PlanIt\PlaceBundle\Form\ContractType;

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

    public function deletePlaceAction($place_id)
    {
        $place = $this->getDoctrine()->getRepository('PlanItPlaceBundle:Place')->find($place_id);
        $em = $em = $this->getDoctrine()
                       ->getEntityManager();
        $em->remove($place);
        $em->flush();
        return $place->getModule();

    }

    public function putPlaceChoseAction(Request $request, $place_id)
    {
        $choosen_place = $this->getDoctrine()->getRepository('PlanItPlaceBundle:Place')->find($place_id);
        $places = $this->getDoctrine()->getRepository('PlanItPlaceBundle:Place')->findByModule($choosen_place->getModule()->getId());
        foreach ($places as $place) {
            $place->setState(0);
            $em = $this->getDoctrine()->getManager();
            $em->persist($place);
            $em->flush();
        }

        $choosen_place->setState(1);
        $em = $this->getDoctrine()->getManager();
        $em->persist($choosen_place);
        $em->flush();
    }

    public function putPlaceAction(Request $request, $place_id)
    {
        $place = $this->getDoctrine()->getRepository('PlanItPlaceBundle:Place')->find($place_id);
        $form = $this->createForm(new PlaceType(), $place, array('method' => 'PUT'));
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($place);
            $em->flush();
            return $place->getModule();
        }
    }

    public function postPlaceContractAction(Request $request, $place_id)
    {
        $place = $this->getDoctrine()->getRepository('PlanItPlaceBundle:Place')->find($place_id);
        $place->setContract(null);
        $form = $this->createForm(new ContractType(), $place);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $file = $form['contract']->getData();
            $extension = $file->guessExtension();
            if (!$extension) {
                $extension = 'bin';
            }
            $rand = rand(1, 99999);
            $file->move($place->getUploadRootDir(), $place_id.'-'.$rand.'.'.$extension);
            $place->setContract($place_id.'-'.$rand.'.'.$extension);
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($place);
            $em->flush();

            return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $place->getModule()->getEvent()->getId(),
                'module_id'   => $place->getModule()->getId()
            )));
        }
    }



}
