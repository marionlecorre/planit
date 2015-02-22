<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\GuestsBundle\Entity\TypeGuest;
use PlanIt\GuestsBundle\Form\TypeGuestType;

class TypeGuestRestController extends Controller
{

	public function postTypeguestAction(Request $request, $module_id)
    {
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);

        $typeguest = new TypeGuest();
        $typeguest->setModule($module);

        $form    = $this->createForm(new TypeGuestType($module->getModuleType(), $module->getPayable()), $typeguest);
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

    public function putTypeguestAction(Request $request, $typeguest_id)
    {
        $typeguest = $this->getDoctrine()->getRepository('PlanItGuestsBundle:TypeGuest')->find($typeguest_id);
        $typeguest->setLabel($request->request->get('name'));
        if($request->request->get('type') == 'payable'){
            $typeguest->setPrice($request->request->get('price'));
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($typeguest);
        $em->flush();
    }

    public function deleteTypeguestAction($typeguest_id)
    {
        $typeguest = $this->getDoctrine()->getRepository('PlanItGuestsBundle:TypeGuest')->find($typeguest_id);
        $em = $em = $this->getDoctrine()
                       ->getEntityManager();
        $em->remove($typeguest);
        $em->flush();

    }
}