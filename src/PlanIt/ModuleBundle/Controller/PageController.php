<?php

namespace PlanIt\ModuleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
                    'user_id' => $event->getUser()->getId()
                ));
            break;
        }
        //Vérifier que le module correspond bien à l'event et au user connecté
    }
}
