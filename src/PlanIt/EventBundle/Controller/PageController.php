<?php

namespace PlanIt\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
	public function eventAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $user = $em->getRepository('PlanItUserBundle:User')->find($id);

        return $this->render('PlanItEventBundle:Page:event.html.twig', array(
            'id' => $id
        ));
    }
}
