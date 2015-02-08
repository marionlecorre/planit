<?php

namespace PlanIt\PlaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\PlaceBundle\Entity\Place;
use PlanIt\PlaceBundle\Form\PlaceType;

class PlaceController extends Controller
{
    public function formAction($module_id)
    {
        $module = $this->getModule($module_id);


        $place = new Place();
        $place->setModule($module);
        $form   = $this->createForm(new PlaceType(), $place);

        return $this->render('PlanItPlaceBundle:Place:form.html.twig', array(
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