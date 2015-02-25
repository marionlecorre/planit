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
        $type = "add";
        $form   = $this->createForm(new EventType($type), $event);

        return $this->render('PlanItEventBundle:Event:form.html.twig', array(
            'event' => $event,
            'form'   => $form->createView(),
            'user_id' => $user_id
        ));
    }

    public function updateformAction($event_id)
    {
        $em = $this->getDoctrine()
                    ->getEntityManager();

        $event = $em->getRepository('PlanItEventBundle:Event')->find($event_id);
        $type = "lol";
        $form   = $this->createForm(new EventType($type), $event);

        return $this->render('PlanItEventBundle:Event:updateform.html.twig', array(
            'event' => $event,
            'form'   => $form->createView(),
            'user_id' => $event->getUser()->getId()
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