<?php

namespace PlanIt\TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PlanItTodoBundle:Default:index.html.twig', array('name' => $name));
    }
}
