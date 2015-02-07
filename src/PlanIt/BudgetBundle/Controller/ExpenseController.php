<?php

namespace PlanIt\BudgetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\BudgetBundle\Entity\Expense;
use PlanIt\BudgetBundle\Form\ExpenseType;

class ExpenseController extends Controller
{
    public function formAction($module_id)
    {
        $module = $this->getModule($module_id);


        $expense = new Expense();
        $form   = $this->createForm(new ExpenseType(), $expense);

        return $this->render('PlanItBudgetBundle:Expense:form.html.twig', array(
            'expense' => $expense,
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