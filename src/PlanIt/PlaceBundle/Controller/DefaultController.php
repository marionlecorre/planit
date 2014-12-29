<?php

namespace PlanIt\PlaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PlanItPlaceBundle:Default:index.html.twig', array('name' => $name));
    }
}
