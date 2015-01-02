<?php

namespace PlanIt\EventBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use PlanIt\EventBundle\Form\EventType;
use PlanIt\EventBundle\Entity\Event;

class EventController extends Controller
{
  	public function formAction($user_id)
    {
        $user = $this->getUserEvent($user_id);


        $event = new Event();
        $event->setUser($user);
        $form   = $this->createForm(new EventType(), $event);

        return $this->render('PlanItEventBundle:Event:form.html.twig', array(
            'event' => $event,
            'form'   => $form->createView(),
            'user_id' => $user_id
        ));
    }

    protected function getUserEvent($user_id)
    {
        $em = $this->getDoctrine()
                    ->getEntityManager();

        $user = $em->getRepository('PlanItUserBundle:User')->find($user_id);

        if (!$user) {
            throw $this->createNotFoundException('Unable to find User.');
        }

        return $user;
    }
}