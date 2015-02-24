<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PlanIt\EventBundle\Entity\Event;
use PlanIt\GuestsBundle\Entity\GuestsModule;
use PlanIt\BudgetBundle\Entity\BudgetModule;
use PlanIt\PlaceBundle\Entity\PlaceModule;
use PlanIt\TransportationBundle\Entity\TransportationModule;
use PlanIt\TodoBundle\Entity\TodoModule;
use PlanIt\EventBundle\Form\EventType;
use Symfony\Component\DependencyInjection\ContainerInterface;


class EventRestController extends Controller
{

    protected $container;
    public function __construct(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function getEventNotusemodulesAction($event_id){
        $event = $this->getDoctrine()->getRepository('PlanItEventBundle:Event')->find($event_id);
        $modules_tab = array(
            1 => "Gestion des invités",
            2 => "Gestion du budget",
            3 => "Gestion du lieu",
            4 => "Gestion du transport",
            5 => "Liste de tâches"
        );

           foreach($modules_tab as $type => $name){
                foreach($event->getModules() as $module){
                    if($type == $module->getIntType()){
                        unset($modules_tab[$type]);
                    }
               }
           }
           $notUseModules = [];
           foreach($modules_tab as $type=>$name){
                if($type == 1){
                    $module = new GuestsModule();
                    $module->setIntType(1);
                    $module->setName('Gestion des invités');
                }elseif($type == 2){
                    $module = new BudgetModule();
                    $module->setIntType(2);
                    $module->setName('Gestion du budget');
                }elseif($type == 3){
                    $module = new PlaceModule();
                    $module->setIntType(3);
                    $module->setName('Gestion du lieu');
                }elseif($type == 4){
                    $module = new TransportationModule();
                    $module->setIntType(4);
                    $module->setName('Gestion du transport');
                }elseif($type == 5){
                    $module = new TodoModule();
                    $module->setIntType(5);
                    $module->setName('Listes de tâches');
                }
                $notUseModules[] = $module;
           }
           return $notUseModules;
    }
    
    public function getEventAction($event_id){
	    $event = $this->getDoctrine()->getRepository('PlanItEventBundle:Event')->find($event_id);
        $nbGuests = $this->getEventNbguestsAction($event_id);
	    if(!is_object($event)){
	      throw $this->createNotFoundException();
	    }
        $balance = "Empty";
        foreach ($event->getModules() as $value) {
            if ($value->getIntType() == 2){
                $balance = $value->getBalance();
            }            
        }
        $modules = array();
        foreach($event->getModules() as $module){
            $modules[] = array(
                'id' => $module->getId(),
                'name' => $module->getName(),
                'inttype' => $module->getInttype()
            );
        }

	    return array(
                    'nbGuests' => $nbGuests,
                    'event' => array(
                        'id' => $event->getId(),
                        'name' => $event->getName(),
                        'description' => $event->getDescription(),
                        'beginDate' => $event->getBeginDate(),
                        'endDate' => $event->getEndDate(),
                        'image' => $event->getImage(),
                        'modules' => $modules,
                        'user' => $event->getUser()
                    ),
                    'balance' => $balance,
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
                $types_guests = $module->getTypesGuests();
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

    public function deleteEventAction($event_id)
    {
        $event = $this->getDoctrine()->getRepository('PlanItEventBundle:Event')->find($event_id);
        $em = $em = $this->getDoctrine()
                       ->getEntityManager();
        $em->remove($event);
        $em->flush();
    }

    public function postEventUpdateAction(Request $request, $event_id)
    {
        
        $event = $this->getDoctrine()->getRepository('PlanItEventBundle:Event')->find($event_id);
        $type = "update";
        $form    = $this->createForm(new EventType($type), $event);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($event);
            $em->flush();
            
            return $this->redirect($this->generateUrl('PlanItUserBundle_homepage', array(
                'id'    => $event->getUser()->getId()
            )));
        }

        return $this->redirect($this->generateUrl('PlanItUserBundle_homepage', array(
                'id'    => $event->getUser()->getId()
            )));
    }

    public function getEventNbguestsAction($event_id){
        return $nbGuests = $this->getDoctrine()->getRepository('PlanItGuestsBundle:Guest')->countGuests($event_id);
    }
}
