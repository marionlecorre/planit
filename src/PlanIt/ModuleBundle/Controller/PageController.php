<?php

namespace PlanIt\ModuleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\GuestsBundle\Entity\GuestsModule;


class PageController extends Controller
{
    public function moduleAction($event_id, $module_id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $event = $em->getRepository('PlanItEventBundle:Event')->find($event_id);
        $module = $em->getRepository('PlanItModuleBundle:Module')->find($module_id);
        switch($module->getIntType()){
            case 1:
                return $this->render('PlanItGuestsBundle:Page:index.html.twig', array(
                    'event_id' => $event_id,
                    'module_id' => $module_id,
                    'user_id' => $event->getUser()->getId(),
                    'module_type' => $module->getGuestmoduleType(),
                    'payable' => $module->getPayable()
                ));
            break;

            case 2:
                return $this->render('PlanItBudgetBundle:Page:index.html.twig', array(
                    'event_id' => $event_id,
                    'module_id' => $module_id,
                    'user_id' => $event->getUser()->getId()
                ));
            break;

            case 3:
                return $this->render('PlanItPlaceBundle:Page:index.html.twig', array(
                    'event_id' => $event_id,
                    'module_id' => $module_id,
                    'user_id' => $event->getUser()->getId()
                ));
            break;

            case 4:
                return $this->render('PlanItTransportationBundle:Page:index.html.twig', array(
                    'event_id' => $event_id,
                    'module_id' => $module_id,
                    'user_id' => $event->getUser()->getId()
                ));
            break;

            case 5:
                return $this->render('PlanItTodoBundle:Page:index.html.twig', array(
                    'event_id' => $event_id,
                    'module_id' => $module_id,
                    'user_id' => $event->getUser()->getId()
                ));
            break;
        }
        //Vérifier que le module correspond bien à l'event et au user connecté
    }
}
