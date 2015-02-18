<?php

namespace PlanIt\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\GuestsBundle\Entity\GuestsModule;
use PlanIt\GuestsBundle\Form\GuestsModuleType;
use PlanIt\TodoBundle\Entity\TodoModule;
use PlanIt\TodoBundle\Form\TodoModuleType;
use PlanIt\PlaceBundle\Entity\PlaceModule;
use PlanIt\PlaceBundle\Form\PlaceModuleType;
use PlanIt\BudgetBundle\Entity\BudgetModule;
use PlanIt\BudgetBundle\Form\BudgetModuleType;
use PlanIt\TransportationBundle\Entity\TransportationModule;
use PlanIt\TransportationBundle\Form\TransportationModuleType;

class PageController extends Controller
{
	public function eventAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $data = $this->get("event_api_controller")->getEventAction($id);
        $notUsesModules = $this->get("event_api_controller")->getEventNotusemodulesAction($id);

        return $this->render('PlanItEventBundle:Page:event.html.twig', array(
            'event' => $data['event'],
            'nbGuests' => $data['nbGuests'],
            'balance' => $data['balance'],
            'user' => $data['event']->getUser(),
            'notUsesModules' => $notUsesModules
        ));
    }

    public function formAction()
    {
        $type = $this->get('request')->query->get('type');
        $event_id = $this->get('request')->query->get('event_id');
	    switch( $type ) {
	        case 1:
	            $form = $this->createForm(new GuestsModuleType, new GuestsModule);
	            $type = 'guests';
	            break;
	        case 2:
	            $form = $this->createForm(new BudgetModuleType, new BudgetModule);
	            $type = 'budget';
	            break;
	        case 3:
	            $form = $this->createForm(new PlaceModuleType, new PlaceModule);
	            $type = 'place';
	            break;
	        case 4:
	            $form = $this->createForm(new TransportationModuleType, new TransportationModule);
	            $type = 'transportation';
	            break;
	        case 5:
	            $form = $this->createForm(new TodoModuleType, new TodoModule);
	            $type = 'todo';
	            break;
	    }

	    return $this->render('PlanItEventBundle:Page:form.html.twig', array(
	       'form' => $form->createView(),
	       'type' => $type,
	       'event_id' => $event_id
	    ));
    }
}
