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

        $event = $em->getRepository('PlanItEventBundle:Event')->find($id);

        return $this->render('PlanItEventBundle:Page:event.html.twig', array(
            'event_id' => $id,
            'user_id' => $event->getUser()->getId()
        ));
    }

    public function formAction()
    {
        $type = $this->get('request')->query->get('type');
        $event_id = $this->get('request')->query->get('event_id');
	    switch( $type ) {
	        case 'guests':
	            $form = $this->createForm(new GuestsModuleType, new GuestsModule);
	            break;
	        case 'todo':
	            $form = $this->createForm(new TodoModuleType, new TodoModule);
	            break;
	        case 'place':
	            $form = $this->createForm(new PlaceModuleType, new PlaceModule);
	            break;
	        case 'budget':
	            $form = $this->createForm(new BudgetModuleType, new BudgetModule);
	            break;
	        case 'transportation':
	            $form = $this->createForm(new TransportationModuleType, new TransportationModule);
	            break;
	    }

	    return $this->render('PlanItEventBundle:Page:form.html.twig', array(
	       'form' => $form->createView(),
	       'type' => $type,
	       'event_id' => $event_id
	    ));
    }
}
