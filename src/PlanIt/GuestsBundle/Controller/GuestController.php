<?php

namespace PlanIt\GuestsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\GuestsBundle\Entity\Guest;
use PlanIt\GuestsBundle\Form\GuestType;
use PlanIt\GuestsBundle\Form\GuestAnswerType;
use PlanIt\GuestsBundle\Form\GuestInscriptionType;

class GuestController extends Controller
{
    public function formAction($module_id)
    {
        $module = $this->getModule($module_id);


        $guest = new Guest();
        $guest->setModule($module);
        $form   = $this->createForm(new GuestType(), $guest);
        if($this->getDoctrine()->getRepository('PlanItGuestsBundle:Guest')->countGuests($module->getEvent()->getId()) >= $this->getDoctrine()->getRepository('PlanItGuestsBundle:GuestsModule')->find($module_id)->getMaxGuests()){
                $is_max = true;
        }else{
                $is_max = false;
        }

        return $this->render('PlanItGuestsBundle:Guest:form.html.twig', array(
            'guest' => $guest,
            'form'   => $form->createView(),
            'module_id' => $module_id,
            'is_max' => $is_max
        ));
    }

    public function answerAction($guest_id_encode, $type_encode)
    {
        $em = $this->getDoctrine()
                    ->getEntityManager();

        $guest = $em->getRepository('PlanItGuestsBundle:Guest')->find(base64_decode($guest_id_encode));

        $form   = $this->createForm(new GuestAnswerType(), $guest);

        return $this->render('PlanItGuestsBundle:Guest:form-answer.html.twig', array(
            'guest' => $guest,
            'form'   => $form->createView(),
            'type' => base64_decode($type_encode)
        ));
    }

    public function inscriptionAction($module_id_encode, $type_encode)
    {
        $em = $this->getDoctrine()
                    ->getEntityManager();

        $module = $em->getRepository('PlanItModuleBundle:Module')->find(base64_decode($module_id_encode));


        $guest = new Guest();
        $guest->setModule($module);
        $form   = $this->createForm(new GuestInscriptionType($module), $guest);

        return $this->render('PlanItGuestsBundle:Guest:form-inscription.html.twig', array(
            'guest' => $guest,
            'form'   => $form->createView(),
            'module_id' => $module->getId(),
            'type' => base64_decode($type_encode)
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