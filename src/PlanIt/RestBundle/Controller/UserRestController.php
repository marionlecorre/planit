<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserRestController extends Controller
{
    public function getUserAction($id){
	    $user = $this->getDoctrine()->getRepository('PlanItUserBundle:User')->find($id);
	    if(!is_object($user)){
	      throw $this->createNotFoundException();
	    }
	    return $user;
	}
}
