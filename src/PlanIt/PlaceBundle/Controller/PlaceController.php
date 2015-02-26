<?php

namespace PlanIt\PlaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\PlaceBundle\Entity\Place;
use PlanIt\PlaceBundle\Form\PlaceType;
use PlanIt\PlaceBundle\Form\ContractType;
use PlanIt\PlaceBundle\Form\ImageType;

class PlaceController extends Controller
{
    public function formAction($module_id)
    {
        $module = $this->getModule($module_id);


        $place = new Place();
        $place->setModule($module);
        $form   = $this->createForm(new PlaceType("add"), $place);

        return $this->render('PlanItPlaceBundle:Place:form.html.twig', array(
            'place' => $place,
            'form'   => $form->createView(),
            'module_id' => $module_id,
        ));
    }

    public function contractAction($module_id)
    {
        $module = $this->getModule($module_id);


        $place = new Place();
        $place->setModule($module);
        $form   = $this->createForm(new ContractType(), $place);

        return $this->render('PlanItPlaceBundle:Place:contract-form.html.twig', array(
            'place' => $place,
            'form'   => $form->createView(),
            'module_id' => $module_id,
        ));
    }

    public function imageAction($module_id)
    {
        $module = $this->getModule($module_id);


        $place = new Place();
        $place->setModule($module);
        $form   = $this->createForm(new ImageType(), $place);

        return $this->render('PlanItPlaceBundle:Place:image-form.html.twig', array(
            'place' => $place,
            'form'   => $form->createView(),
            'module_id' => $module_id,
        ));
    }

    protected function getModule($module_id)
    {
        $em = $this->getDoctrine()
                    ->getEntityManager();

        $module = $em->getRepository('PlanItModuleBundle:Module')->find($module_id);

        if (!$module) {
            throw $this->createNotFoundException('Unable to find Module.');
        }

        return $module;
    }

}