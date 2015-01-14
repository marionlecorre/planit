<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\GuestsBundle\Entity\TypeGuest;
use PlanIt\GuestsBundle\Form\TypeGuestType;

class TypeGuestRestController extends Controller
{

	public function postTypeGuestAction(Request $request, $module_id)
    {
	    //var_dump("coucou");
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);

        $typeguest = new TypeGuest();
        $typeguest->setModule($module);

        $form    = $this->createForm(new TypeGuestType(), $typeguest);
        $form->handleRequest($request);
        $data = $form->getData();

        if ($form->isValid()) {
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($typeguest);
            $em->flush();

            return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $module->getEvent()->getId(),
                'module_id'   => $module->getId()
            )));
        }
        return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
            'event_id'    => $module->getEvent()->getId(),
            'module_id'   => $module->getId()
        )));
    }
}