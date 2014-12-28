<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ModuleRestController extends Controller
{
    public function getModuleAction($id){
	    $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($id);
	    if(!is_object($module)){
	      throw $this->createNotFoundException();
	    }
	    return $module;
	}
}
