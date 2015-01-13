<?php

namespace PlanIt\GuestsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\GuestsBundle\Entity\Guest;
use PlanIt\GuestsBundle\Form\GuestType;

class GuestController extends Controller
{
    public function formAction($module_id)
    {
        $module = $this->getModule($module_id);


        $guest = new Guest();
        $guest->setModule($module);
        $form   = $this->createForm(new GuestType(), $guest);

        return $this->render('PlanItGuestsBundle:Guest:form.html.twig', array(
            'guest' => $guest,
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