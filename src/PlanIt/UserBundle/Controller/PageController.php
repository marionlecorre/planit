<?php

namespace PlanIt\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction($id)
    {
        return $this->render('PlanItUserBundle:Page:index.html.twig', array(
            'user_id' => $id
        ));
    }

	public function translationAction($name)
	{
	    return $this->render('PlanItUserBundle:Page:translation.html.twig', array(
	      'name' => $name
	    ));
	}

}
