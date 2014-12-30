<?php

namespace PlanIt\TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction($id)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	$event = $em->getRepository('PlanItEventBundle:Event')->find($id);

        return $this->render('PlanItTodoBundle:Page:index.html.twig', array(
            'event_id' => $id,
            'user_id' => $event->getUser()->getId()
        ));
    }
}
