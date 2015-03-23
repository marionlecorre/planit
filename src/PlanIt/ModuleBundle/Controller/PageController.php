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
        $module = $this->get("module_api_controller")->getModuleAction($module_id);

        $user = $this->container->get('security.context')->getToken()->getUser();
        $user_id_module = $event->getUser()->getId();
        if(!$user || $user == "anon."){
            return $this->redirect($this->generateUrl('PlanItUserBundle_login'));
        }else{
            if($user->getId() != $user_id_module){
                return $this->render('PlanItUserBundle:Page:forbidden.html.twig');
            }
        }
        switch($module->getIntType()){
            case 1:
                $link = $this->get("guests_api_controller")->getGuestsmoduleInscriptionlinkAction($module_id);
                $paymentmeans = $this->get("guests_api_controller")->getGuestsmodulePaymentmeansAction($module_id);
                $nb_guests = $this->getDoctrine()->getRepository('PlanItGuestsBundle:Guest')->countGuests($event_id);
                return $this->render('PlanItGuestsBundle:Page:index.html.twig', array(
                    'event_id' => $event_id,
                    'module_id' => $module->getId(),
                    'module' => $module,
                    'link' => $link,
                    'paymentmeans' =>$paymentmeans,
                    'nb_guests' => $nb_guests,
                    'user' => $event->getUser(),
                ));
            break;

            case 2:
                $infos = $this->get("budget_api_controller")->getInfosAction($module_id);
                return $this->render('PlanItBudgetBundle:Page:index.html.twig', array(
                    'event_id' => $event_id,
                    'module_id' => $module->getId(),
                    'module' => $module,
                    'user' => $event->getUser(),
                    'infos' => $infos
                ));
            break;

            case 3:
                return $this->render('PlanItPlaceBundle:Page:index.html.twig', array(
                    'event_id' => $event_id,
                    'module_id' => $module->getId(),
                    'module' => $module,
                    'user' => $event->getUser()
                ));
            break;

            case 4:
                return $this->render('PlanItTransportationBundle:Page:index.html.twig', array(
                    'event_id' => $event_id,
                    'module_id' => $module->getId(),
                    'module' => $module,
                    'user' => $event->getUser()
                ));
            break;

            case 5:
                return $this->render('PlanItTodoBundle:Page:index.html.twig', array(
                    'event_id' => $event_id,
                    'module_id' => $module->getId(),
                    'module' => $module,
                    'user' => $event->getUser()
                ));
            break;
        }
        //Vérifier que le module correspond bien à l'event et au user connecté
    }
}
