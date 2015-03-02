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
        $session = $request->getSession();
        $errors = $this->get('validator')->validate( $inflow );
        foreach( $errors as $error )
        {
            $session->getFlashBag()->add('errors', $error->getMessage());
        }
        
        return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
            'event_id'    => $type_expense->getModule()->getEvent()->getId(),
            'module_id'   => $type_expense->getModule()->getId()
        )));
    }

    public function deleteTypeexpenseAction($type_id)
    {
        $type_expense = $this->getDoctrine()->getRepository('PlanItBudgetBundle:TypeExpense')->find($type_id);
        $expenses = $type_expense->getExpenses();
        foreach($expenses as $expense){
            $em = $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->remove($expense);
        }
        
        $em = $em = $this->getDoctrine()
                       ->getEntityManager();
        $em->remove($type_expense);
        $em->flush();
        return array(
                'balance' => $this->get("budget_api_controller")->getInfosAction($type_expense->getModule()->getId())['balance'],
                'module_id' => $type_expense->getModule()->getId()
            );

    }

}
