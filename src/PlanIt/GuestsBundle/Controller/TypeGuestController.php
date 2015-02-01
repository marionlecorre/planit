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


        $typeguest = new TypeGuest();
        $typeguest->setModule($module);
        $form   = $this->createForm(new TypeGuestType(), $typeguest);

        return $this->render('PlanItGuestsBundle:TypeGuest:form.html.twig', array(
            'typeguest' => $typeguest->getId(),
            'form'   => $form->createView(),
            'module_id' => $module_id
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