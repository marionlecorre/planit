<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventRestController extends Controller
{
    public function getEventAction($id){
	    $event = $this->getDoctrine()->getRepository('PlanItEventBundle:Event')->find($id);
	    if(!is_object($event)){
	      throw $this->createNotFoundException();
	    }
	    //Vérifier qu'il appartient bien au User identifié
	    return $event;
	}
}
