<?php

namespace PlanIt\TransportationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
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
}
