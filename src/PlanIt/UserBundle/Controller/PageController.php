<?php

namespace PlanIt\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction($id)
    {
        return $this->render('PlanItUserBundle:Page:index.html.twig', array(
            'id' => $id
        ));
    }

    public function eventAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $em->getRepository('PlanItUserBundle:User')->find($id);

        return $this->render('PlanItUserBundle:Page:event.html.twig', array(
            'user' => $user
        ));
    }

    /*public function eventAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $em->getRepository('PlanItUserBundle:User')->find($id);

        return $this->render('PlanItUserBundle:Page:event.html.twig', array(
            'user' => $user
        ));
    }*/
}
