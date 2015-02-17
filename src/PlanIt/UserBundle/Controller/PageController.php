<?php

namespace PlanIt\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get("user_api_controller")->getUserAction($id);
        return $this->render('PlanItUserBundle:Page:index.html.twig', array(
            'user' => $user,
        ));
    }

	public function translationAction($name)
	{
	    return $this->render('PlanItUserBundle:Page:translation.html.twig', array(
	      'name' => $name
	    ));
	}

}
