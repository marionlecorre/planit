<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PlanIt\EventBundle\Entity\Event;
use PlanIt\EventBundle\Form\EventType;

class EventRestController extends Controller
{

    public function getEventAction($event_id){
	    $event = $this->getDoctrine()->getRepository('PlanItEventBundle:Event')->find($event_id);
        $nbGuests = $this->getEventNbguestsAction($event_id);
	    if(!is_object($event)){
	      throw $this->createNotFoundException();
	    }
	    return array(
                    'nbGuests' => $nbGuests,
                    'event' => $event
                );
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

    public function deleteModuleAction($module_id)
    {
        
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);
        $event = $module->getEvent();
        $nbGuests = $this->getEventNbguestsAction($event->getId());

        $em = $this->getDoctrine()
                       ->getEntityManager();
        switch($module->getIntType()){
            case 1: //guests
                $types_guests = $module->getTypeGuest();
                foreach ($types_guests as $type) {
                    $guests = $type->getGuests();
                    foreach ($guests as $guest) {
                        $em->remove($guest);
                        $em->flush();
                    }
                    $em->remove($type);
                    $em->flush();
                }
                $payments = $module->getPaymentMeans();
                foreach ($payments as $payment) {
                    $em->remove($payment);
                    $em->flush();
                }
                //return 'ok'
            break;

            case 2: //budget
                $types_expense = $module->getTypesExpense();
                foreach ($types_expense as $type) {
                    $expenses = $type->getExpenses();
                    foreach ($expenses as $expense) {
                        $em->remove($expense);
                        $em->flush();
                    }
                    $em->remove($type);
                    $em->flush();
                }
                $inflows = $module->getInflows();
                foreach ($inflows as $inflow) {
                    $em->remove($inflow);
                    $em->flush();
                }

            break;


            case 3: //place
                $places = $module->getPlaces();
                foreach ($places as $place) {
                    $em->remove($place);
                    $em->flush();
                }
            break;

            case 4:

            break;

            case 5: //todo
                $items = $module->getItems();
                foreach ($items as $item) {
                    $em->remove($item);
                    $em->flush();
                }
            break;


        }
        $em->remove($module);
        $em->flush();
        return array(
                    'nbGuests' => $nbGuests,
                    'event' => $event
                );

    }

    public function getEventNbguestsAction($event_id){
        return $nbGuests = $this->getDoctrine()->getRepository('PlanItGuestsBundle:Guest')->countGuests($event_id);
    }
}
