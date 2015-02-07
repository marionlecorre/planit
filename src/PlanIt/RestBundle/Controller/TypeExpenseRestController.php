<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\BudgetBundle\Entity\TypeExpense;
use PlanIt\BudgetBundle\Form\TypeExpenseType;

class TypeExpenseRestController extends Controller
{

    public function postTypeexpenseAction(Request $request, $module_id)
    {

        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);

        $type_expense = new TypeExpense();
        $type_expense->setModule($module);

        $form = $this->createForm(new TypeExpenseType(), $type_expense);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($type_expense);
            $em->flush();

            return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $type_expense->getModule()->getEvent()->getId(),
                'module_id'   => $type_expense->getModule()->getId()
            )));
        }
        return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
            'event_id'    => $type_expense->getModule()->getEvent()->getId(),
            'module_id'   => $type_expense->getModule()->getId()
        )));
    }

}
