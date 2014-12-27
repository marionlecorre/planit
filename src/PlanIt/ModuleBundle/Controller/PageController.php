<?php

namespace PlanIt\ModuleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function moduleAction($event_id, $module_id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $event = $em->getRepository('PlanItEventBundle:Event')->find($event_id);

        //Vérifier que le module correspond bien à l'event et au user connecté
        return $this->render('PlanItModuleBundle:Page:module.html.twig', array(
            'event_id' => $event_id,
            'module_id' => $module_id,
            'user_id' => $event->getUser()->getId()
        ));
    }
}
