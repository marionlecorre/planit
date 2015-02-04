<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\GuestsBundle\Entity\GuestsModule;
use PlanIt\GuestsBundle\Form\GuestsModuleType;

class GuestsModuleRestController extends Controller
{

	public function getGuestsmoduleInscritpionlinkAction($id){
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($id);
        return 'http://planit.dev:8888/app_dev.php/inscription/'.base64_encode($module->getId());
    }

    public function getGuestsmoduleIPaymentmeansAction($id){
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($id);
        return 'http://planit.dev:8888/app_dev.php/inscription/'.base64_encode($module->getId());
    }

    public function postGuestsmoduleAction(Request $request, $event_id)
    {
        $event = $this->getDoctrine()->getRepository('PlanItEventBundle:Event')->find($event_id);

        $guests_module = new GuestsModule();
        $guests_module->setEvent($event);
        $form    = $this->createForm(new GuestsModuleType(), $guests_module);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            $guests_module->setSlug($data->getName());
            $guests_module->setIntType(1);
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($guests_module);
            $em->flush();
            
            return $this->redirect($this->generateUrl('PlanItEventBundle_event', array(
                'id'    => $event->getId()
            )));
        }

        return $this->redirect($this->generateUrl('PlanItEventBundle_event', array(
            'id'    => $event_id
        )));
    }

    public function putGuestsmodulePayableAction(Request $request, $module_id)
    {
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);
        $module->setPayable($request->request->get('payable'));
        $em = $this->getDoctrine()
                   ->getEntityManager();
        $em->persist($module);
        $em->flush();

        $link = 'http://planit.dev:8888/app_dev.php/inscription/'.base64_encode($module->getId());
        return array(
            'module' => $module,
            'link' => $link
            );
    }
}
