<?php

namespace PlanIt\BudgetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\BudgetBundle\Entity\Inflow;
use PlanIt\BudgetBundle\Form\InflowType;

class InflowController extends Controller
{
    public function formAction($module_id)
    {
        $module = $this->getModule($module_id);


        $inflow = new Inflow();
        $inflow->setModule($module);
        $form   = $this->createForm(new InflowType(), $inflow);

        return $this->render('PlanItBudgetBundle:Inflow:form.html.twig', array(
            'inflow' => $inflow,
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