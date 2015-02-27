<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserRestController extends Controller
{

    protected $container;
  	public function __construct(ContainerInterface $container = null)
  	{
    	$this->container = $container;
  	}

    public function getUserAction($id){
	    $user = $this->getDoctrine()->getRepository('PlanItUserBundle:User')->find($id);
	    if(!is_object($user)){
	      throw $this->createNotFoundException();
	    }
	    return $user;
	}

	public function getUserEventsAction($id){
	    $not_finished_events = $this->getDoctrine()->getRepository('PlanItEventBundle:Event')->findNotFinishedByUserid($id);
	    $finished_events = $this->getDoctrine()->getRepository('PlanItEventBundle:Event')->findFinishedByUserid($id);
	    $tab_events = array();
	    foreach ($not_finished_events as $event) {
	    	$tab_events[] = array(
	    		'id' => $event->getId(),
	    		'name' => $event->getName(),
	    		'description' => $event->getDescription(),
	    		'beginDate' => $event->getBeginDate(),
	    		'endDate' => $event->getEndDate(),
	    		'image' => $event->getImage()
	    	);
	    }

	    foreach ($finished_events as $event) {
	    	$tab_events[] = array(
	    		'id' => $event->getId(),
	    		'name' => $event->getName(),
	    		'description' => $event->getDescription(),
	    		'beginDate' => $event->getBeginDate(),
	    		'endDate' => $event->getEndDate(),
	    		'image' => $event->getImage()
	    	);
	    }
	    return $tab_events;
	}
}
