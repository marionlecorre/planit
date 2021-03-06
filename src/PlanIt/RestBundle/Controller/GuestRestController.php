<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\GuestsBundle\Entity\Guest;
use PlanIt\GuestsBundle\Form\GuestType;
use PlanIt\GuestsBundle\Form\UpdateGuestType;
use PlanIt\GuestsBundle\Form\GuestAnswerType;
use PlanIt\GuestsBundle\Form\GuestInscriptionType;


class GuestRestController extends Controller
{

    public function postGuestAction(Request $request, $typeguest_id)
    {
	    $typeguest = $this->getDoctrine()->getRepository('PlanItGuestsBundle:TypeGuest')->find($typeguest_id);
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($typeguest->getModule()->getId());

        $guest = new Guest();
        $guest->setModule($module);

        $form = $this->createForm(new GuestType(), $guest);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $guest->setConfirmed(2);
            $guest->setPayed(0);
            $guest->setSent(0);
            $guest->setTypeguest($typeguest);
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($guest);
            $em->flush();

            return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $guest->getModule()->getEvent()->getId(),
                'module_id'   => $guest->getModule()->getId()
            )));
        }
        $session = $request->getSession();
        $errors = $this->get('validator')->validate( $guest );
        foreach( $errors as $error )
        {
            $session->getFlashBag()->add('errors', $error->getMessage());
        }
        return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
            'event_id'    => $guest->getModule()->getEvent()->getId(),
            'module_id'   => $guest->getModule()->getId()
        )));
    }

    public function deleteGuestAction($guest_id)
    {
        $guest = $this->getDoctrine()->getRepository('PlanItGuestsBundle:Guest')->find($guest_id);
        $em = $em = $this->getDoctrine()
                       ->getEntityManager();
        $em->remove($guest);
        $em->flush();
        return $this->getDoctrine()->getRepository('PlanItGuestsBundle:Guest')->countGuests($guest->getTypeguest()->getModule()->getEvent()->getId());
    }

    public function putGuestAction(Request $request, $guest_id)
    {
        $guest = $this->getDoctrine()->getRepository('PlanItGuestsBundle:Guest')->find($guest_id);
        $form = $this->createForm(new UpdateGuestType(), $guest, array('method' => 'PUT'));
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($guest);
            $em->flush();
            return $this->getDoctrine()->getRepository('PlanItGuestsBundle:Guest')->countGuests($guest->getTypeguest()->getModule()->getEvent()->getId());

        }
    }

    public function postGuestAnswerAction(Request $request, $guest_id)
    {
        $guest = $this->getDoctrine()->getRepository('PlanItGuestsBundle:Guest')->find($guest_id);
        $form = $this->createForm(new GuestAnswerType(), $guest);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($guest);
            $em->flush();

            return $this->redirect($this->generateUrl('PlanItGuestBundle_answer', array(
                'guest_id_encode'    => base64_encode($guest_id),
                'type_encode' => base64_encode('ok')
            )));
        }
    }

    public function postGuestInscriptionAction(Request $request, $module_id)
    {
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);

        $guest = new Guest();
        $guest->setModule($module);

        $form = $this->createForm(new GuestInscriptionType($module), $guest);
        $form->handleRequest($request);
        if ($form->isValid()) {
            if($this->getDoctrine()->getRepository('PlanItGuestsBundle:Guest')->countGuests($module->getEvent()->getId()) > $this->getDoctrine()->getRepository('PlanItGuestsBundle:GuestsModule')->find($module_id)->getMaxGuests()){
                return $this->redirect($this->generateUrl('PlanItGuestBundle_inscritpion', array(
                    'module_id_encode'    => base64_encode($module_id),
                    'type_encode' => base64_encode('full')
                )));
            }
            $guest->setConfirmed(1);
            $guest->setPayed(0);
            $guest->setSent(1);
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($guest);
            $em->flush();

            return $this->redirect($this->generateUrl('PlanItGuestBundle_inscritpion', array(
                'module_id_encode'    => base64_encode($module_id),
                'type_encode' => base64_encode('ok')
            )));
        }
    }

    public function postGuestMailAction(Request $request, $guest_id)
    {
        $guest = $this->getDoctrine()->getRepository('PlanItGuestsBundle:Guest')->find($guest_id);
        $event = $this->getDoctrine()->getRepository('PlanItEventBundle:Event')->find($guest->getModule()->getEvent()->getId());
        $message = \Swift_Message::newInstance()
            ->setSubject('Invitation à l\'évènement : '.$event->getName())
            ->setFrom($event->getUser()->getEmail())
            ->setTo($guest->getEmail())
            ->setBody($guest->getTypeguest()->getMessage().'<br/> 
                Le prix de l\'évènement est de '.$guest->getTypeguest()->getPrice().'€ par personne <br/> 
                Merci de confirmer votre présence grâce au lien suivant : <br/>
                http://planit.dev:8888/app_dev.php/'.$request->getLocale().'/answer/'.base64_encode($guest->getId()).'/'.base64_encode('form').'<br>'
                .$event->getUser()->getFirstname().' '.$event->getUser()->getLastname(), 'text/html');
        $this->get('mailer')->send($message);
        $guest->setSent(1);
        $em = $this->getDoctrine()->getManager();
            $em->persist($guest);
            $em->flush();

        return $guest->getModule();
    }



}
