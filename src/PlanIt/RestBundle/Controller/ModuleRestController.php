<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ModuleRestController extends Controller
{
    protected $container;
  	public function __construct(ContainerInterface $container = null)
  	{
    	$this->container = $container;
  	}
    public function getModuleAction($id){
	    $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($id);
	    if(!is_object($module)){
	      throw $this->createNotFoundException();
	    }
	    
	    return $module;
	}
}
