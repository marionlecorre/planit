<?php

namespace PlanIt\GuestsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\GuestsBundle\Entity\Guest;
use PlanIt\GuestsBundle\Form\GuestsModuleType;

class PageController extends Controller
{
    public function indexAction($id)
    {

    	$em = $this->getDoctrine()->getEntityManager();

        $event = $em->getRepository('PlanItEventBundle:Event')->find($id);
        return $this->render('PlanItGuestsBundle:Page:index.html.twig', array(
            'event_id' => $id,
            'user_id' => $event->getUser()->getId()
        ));
    }

    public function updatemoduleAction($module_id)
    {
        $em = $this->getDoctrine()
                    ->getEntityManager();

        $module = $em->getRepository('PlanItGuestsBundle:GuestsModule')->find($module_id);

        $form   = $this->createForm(new GuestsModuleType(), $module);

        return $this->render('PlanItGuestsBundle:Page:update-module-form.html.twig', array(
            'module' => $module,
            'form'   => $form->createView()
        ));
    }
}
