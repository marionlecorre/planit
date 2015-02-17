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
	    $events = $this->getDoctrine()->getRepository('PlanItEventBundle:Event')->findByUser($id);
	    return $events;
	}
}
