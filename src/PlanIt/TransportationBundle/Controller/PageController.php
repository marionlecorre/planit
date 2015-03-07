<?php

namespace PlanIt\TransportationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\TransportationBundle\Form\TransportationModuleType;

class PageController extends Controller
{
    public function indexAction($id)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	$event = $em->getRepository('PlanItEventBundle:Event')->find($id);

        return $this->render('PlanItTransportationBundle:Page:index.html.twig', array(
            'event_id' => $id,
            'user_id' => $event->getUser()->getId()
        ));
    }

    public function updatemoduleAction($module_id)
    {
        $em = $this->getDoctrine()
                    ->getEntityManager();

        $module = $em->getRepository('PlanItTransportationBundle:TransportationModule')->find($module_id);

        $form   = $this->createForm(new TransportationModuleType(), $module);

        return $this->render('PlanItTransportationBundle:Page:update-module-form.html.twig', array(
            'module' => $module,
            'form'   => $form->createView()
        ));
    }
}
