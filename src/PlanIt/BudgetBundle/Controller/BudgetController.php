<?php

namespace PlanIt\BudgetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BudgetController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PlanItBudgetBundle:Default:index.html.twig', array('name' => $name));
    }
}
