<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\GuestsBundle\Entity\TypeGuest;
use PlanIt\GuestsBundle\Form\TypeGuestType;

class TypeGuestRestController extends Controller
{

	public function getTypeguestAction($type_id){
        $type = $this->getDoctrine()->getRepository('PlanItGuestsBundle:TypeGuest')->find($type_id);
        $payable = $type->getModule()->getPayable();
        $module_type = $type->getModule()->getModuleType();
        return array(
            'type' => $type,
            'payable' => $payable,
            'module_type' => $module_type
        );
    }
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
        $session = $request->getSession();
        $errors = $this->get('validator')->validate( $typeguest );
        foreach( $errors as $error )
        {
            $session->getFlashBag()->add('errors', $error->getMessage());
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
        if($request->request->get('payable') == 'true'){
            $typeguest->setPrice($request->request->get('price'));
        }
        if($request->request->get('type') == '0'){
            $typeguest->setMessage($request->request->get('message'));
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($typeguest);
        $em->flush();
    }

    public function deleteTypeguestAction($typeguest_id)
    {
        $typeguest = $this->getDoctrine()->getRepository('PlanItGuestsBundle:TypeGuest')->find($typeguest_id);
        foreach ($typeguest->getGuests() as $guest) {
            $em = $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->remove($guest);
        }
        $em = $em = $this->getDoctrine()
                       ->getEntityManager();
        $em->remove($typeguest);
        $em->flush();
        return $this->getDoctrine()->getRepository('PlanItGuestsBundle:Guest')->countGuests($typeguest->getModule()->getEvent()->getId());
    }
}