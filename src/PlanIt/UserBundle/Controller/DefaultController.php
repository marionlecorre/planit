<?php

namespace PlanIt\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PlanItUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
