<?php

namespace PlanIt\GuestsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\GuestsBundle\Entity\TypeGuest;
use PlanIt\GuestsBundle\Form\TypeGuestType;

class TypeGuestController extends Controller
{
    public function formAction($module_id)
    {
        $module = $this->getModule($module_id);
        $module_type = $module->getModuleType();
        $paying = $module->getPayable();

        $typeguest = new TypeGuest();
        $typeguest->setModule($module);
        $form   = $this->createForm(new TypeGuestType($module_type,$paying), $typeguest);

        return $this->render('PlanItGuestsBundle:TypeGuest:form.html.twig', array(
            'typeguest' => $typeguest->getId(),
            'form'   => $form->createView(),
            'module_id' => $module_id
        ));
    }

    public function updateAction($type_id)
    {
        $em = $this->getDoctrine()
                    ->getEntityManager();

        $type_guest = $em->getRepository('PlanItGuestsBundle:TypeGuest')->find($type_id);
        $module_type = $type_guest->getModule()->getModuleType();
        $paying = $type_guest->getModule()->getPayable();

        $form   = $this->createForm(new TypeGuestType($module_type,$paying), $type_guest);

        return $this->render('PlanItGuestsBundle:TypeGuest:update-form.html.twig', array(
            'type_guest' => $type_guest,
            'form'   => $form->createView(),
            'module_id' => $type_guest->getModule()->getId(),
        ));
    }

    protected function getModule($module_id)
    {
        $em = $this->getDoctrine()
                    ->getEntityManager();

        $module = $em->getRepository('PlanItModuleBundle:Module')->find($module_id);

        if (!$module) {
            throw $this->createNotFoundException('Unable to find Module.');
        }

        return $module;
    }

}