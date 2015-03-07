<?php

namespace PlanIt\TransportationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\TransportationBundle\Entity\Transportation;
use PlanIt\TransportationBundle\Form\TransportationType;
use PlanIt\TransportationBundle\Form\ContractType;
use PlanIt\TransportationBundle\Form\ImageType;

class TransportationController extends Controller
{
    public function formAction($module_id)
    {
        $module = $this->getModule($module_id);


        $transportation = new Transportation();
        $transportation->setModule($module);
        $form   = $this->createForm(new TransportationType("add"), $transportation);

        return $this->render('PlanItTransportationBundle:Transportation:form.html.twig', array(
            'transportation' => $transportation,
            'form'   => $form->createView(),
            'module_id' => $module_id,
        ));
    }

    public function contractAction($module_id)
    {
        $module = $this->getModule($module_id);


        $transportation = new Transportation();
        $transportation->setModule($module);
        $form   = $this->createForm(new ContractType(), $transportation);

        return $this->render('PlanItTransportationBundle:Transportation:contract-form.html.twig', array(
            'transportation' => $transportation,
            'form'   => $form->createView(),
            'module_id' => $module_id,
        ));
    }

    public function imageAction($module_id)
    {
        $module = $this->getModule($module_id);


        $transportation = new Transportation();
        $transportation->setModule($module);
        $form   = $this->createForm(new ImageType(), $transportation);

        return $this->render('PlanItTransportationBundle:Transportation:image-form.html.twig', array(
            'transportation' => $transportation,
            'form'   => $form->createView(),
            'module_id' => $module_id,
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