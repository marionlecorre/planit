<?php

namespace PlanIt\GuestsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($id)
    {
        return $this->render('PlanItGuestsBundle:Default:index.html.twig', array(
            'user_id' => $id
        ));
    }
}
