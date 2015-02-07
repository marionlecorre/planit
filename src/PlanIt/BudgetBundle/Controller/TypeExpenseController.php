<?php

namespace PlanIt\BudgetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\BudgetBundle\Entity\TypeExpense;
use PlanIt\BudgetBundle\Form\TypeExpenseType;

class TypeExpenseController extends Controller
{
    public function formAction($module_id)
    {
        $module = $this->getModule($module_id);


        $type_expense = new TypeExpense();
        $type_expense->setModule($module);
        $form   = $this->createForm(new TypeExpenseType(), $type_expense);

        return $this->render('PlanItBudgetBundle:TypeExpense:form.html.twig', array(
            'type_expense' => $type_expense,
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