<?php

namespace PlanIt\PlaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\PlaceBundle\Form\PlaceModuleType;


class PageController extends Controller
{
    public function indexAction($id)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	$event = $em->getRepository('PlanItEventBundle:Event')->find($id);

        return $this->render('PlanItPlaceBundle:Page:index.html.twig', array(
            'event_id' => $id,
            'user_id' => $event->getUser()->getId()
        ));
    }

    public function updatemoduleAction($module_id)
    {
        $em = $this->getDoctrine()
                    ->getEntityManager();

        $module = $em->getRepository('PlanItPlaceBundle:PlaceModule')->find($module_id);

        $form   = $this->createForm(new PlaceModuleType(), $module);

        return $this->render('PlanItPlaceBundle:Page:update-module-form.html.twig', array(
            'module' => $module,
            'form'   => $form->createView()
        ));
    }
}
