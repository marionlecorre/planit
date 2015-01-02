<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PlanIt\EventBundle\Entity\Event;
use PlanIt\EventBundle\Form\EventType;

class EventRestController extends Controller
{
    public function getEventAction($id){
	    $event = $this->getDoctrine()->getRepository('PlanItEventBundle:Event')->find($id);
	    if(!is_object($event)){
	      throw $this->createNotFoundException();
	    }
	    //Vérifier qu'il appartient bien au User identifié
	    return $event;
	}

	public function postEventAction(Request $request, $user_id)
    {
        $user = $this->getDoctrine()->getRepository('PlanItUserBundle:User')->find($user_id);

        $event = new Event();
        $event->setUser($user);
        $form    = $this->createForm(new EventType(), $event);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            $event->setSlug($data->getName());

            $file = $form['image']->getData();
            $extension = $file->guessExtension();
			if (!$extension) {
			    $extension = 'bin';
			}

			$rand = rand(1, 99999);
			$file->move($event->getUploadRootDir(), $user_id.'-'.$rand.'.'.$extension);
			$event->setImage($user_id.'-'.$rand.'.'.$extension);

            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($event);
            $em->flush();

           return $this->redirect($this->generateUrl('PlanItUserBundle_homepage', array(
                'id'    => $user->getId()
            )));
        }

        /*return $this->render('PlanItGuestsBundle:Page:index.html.twig', array(
            'event_id'    => $guest->getModule()->getEvent()->getId(),
            'module_id'   => $comment->getModule()->getId()
        ));*/
    }
}
