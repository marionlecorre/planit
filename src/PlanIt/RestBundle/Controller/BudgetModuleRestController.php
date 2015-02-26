<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\BudgetBundle\Entity\BudgetModule;
use PlanIt\BudgetBundle\Form\BudgetModuleType;
use PlanIt\BudgetBundle\Form\InflowType;
use PlanIt\BudgetBundle\Entity\Inflow;
use PlanIt\BudgetBundle\Form\ExpenseType;
use PlanIt\BudgetBundle\Form\UpdateExpenseType;
use PlanIt\BudgetBundle\Entity\Expense;
use Symfony\Component\DependencyInjection\ContainerInterface;


class BudgetModuleRestController extends Controller
{

	protected $container;
    public function __construct(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function postBudgetmoduleAction(Request $request, $event_id)
    {
        $event = $this->getDoctrine()->getRepository('PlanItEventBundle:Event')->find($event_id);

        $budget_module = new BudgetModule();
        $budget_module->setEvent($event);
        $form    = $this->createForm(new BudgetModuleType(), $budget_module);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $budget_module->setIntType(2);
            $budget_module->setName('Gestion du budget');
            $budget_module->setSlug($budget_module->getName());
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($budget_module);
            $em->flush();
            
            return $this->redirect($this->generateUrl('PlanItEventBundle_event', array(
                'id'    => $event->getId()
            )));
        }
    }

    public function postBudgetmoduleUpdateAction(Request $request, $module_id)
    {
        
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);
        $form    = $this->createForm(new BudgetModuleType(), $module);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($module);
            $em->flush();
            
            return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $module->getEvent()->getId(),
                'module_id'   => $module->getId()
            )));
        }

        return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $module->getEvent()->getId(),
                'module_id'   => $module->getId()
            )));
    }

    public function postExpenseAction(Request $request, $type_expense)
    {

        $type_expense = $this->getDoctrine()->getRepository('PlanItBudgetBundle:TypeExpense')->find($type_expense);

        $expense = new Expense();
        $expense->setTypeExpense($type_expense);

        $form = $this->createForm(new ExpenseType(), $expense);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $expense->setConsummate(0);
            $expense->setBought(0);

            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($expense);
            $em->flush();

            return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $expense->getTypeExpense()->getModule()->getEvent()->getId(),
                'module_id'   => $expense->getTypeExpense()->getModule()->getId()
            )));
        }
        return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
            'event_id'    => $expense->getTypeExpense()->getModule()->getEvent()->getId(),
            'module_id'   => $expense->getTypeExpense()->getModule()->getId()
        )));
    }

    public function putExpenseAction(Request $request, $expense_id)
    {
        $expense = $this->getDoctrine()->getRepository('PlanItBudgetBundle:Expense')->find($expense_id);
        $type_id = $expense->getTypeExpense()->getId();
        $form = $this->createForm(new UpdateExpenseType(), $expense, array('method' => 'PUT'));
        $form->handleRequest($request);
        if ($form->isValid()) {
            $expense->setBought($form["bought"]->getData());
            $em = $this->getDoctrine()->getManager();
            $em->persist($expense);
            $em->flush();
            return array(
                        'module' => $expense->getTypeExpense()->getModule(),
                        'type_id' => $type_id
                    );
        }
    }

    public function deleteExpenseAction($expense_id)
    {
        $expense = $this->getDoctrine()->getRepository('PlanItBudgetBundle:Expense')->find($expense_id);
        $type_id = $expense->getTypeExpense()->getId();
        $em = $em = $this->getDoctrine()
                       ->getEntityManager();
        $em->remove($expense);
        $em->flush();
        return array(
                    'module' => $expense->getTypeExpense()->getModule(),
                    'type_id' => $type_id
                );

    }

    public function postInflowAction(Request $request, $module_id)
    {

        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);

        $inflow = new Inflow();
        $inflow->setModule($module);

        $form = $this->createForm(new InflowType(), $inflow);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($inflow);
            $em->flush();

            return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $inflow->getModule()->getEvent()->getId(),
                'module_id'   => $inflow->getModule()->getId()
            )));
        }
        return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
            'event_id'    => $inflow->getModule()->getEvent()->getId(),
            'module_id'   => $inflow->getModule()->getId()
        )));
    }

    public function putInflowAction(Request $request, $inflow_id)
    {
        $inflow = $this->getDoctrine()->getRepository('PlanItBudgetBundle:Inflow')->find($inflow_id);
        $form = $this->createForm(new InflowType(), $inflow, array('method' => 'PUT'));
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($inflow);
            $em->flush();
            return $inflow->getModule();
        }
    }

    public function deleteInflowAction($inflow_id)
    {
        $inflow = $this->getDoctrine()->getRepository('PlanItBudgetBundle:Inflow')->find($inflow_id);
        $em = $em = $this->getDoctrine()
                       ->getEntityManager();
        $em->remove($inflow);
        $em->flush();
        return $inflow->getModule();

    }

    public function getListInflowAction($module_id){
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);
        if(!is_object($module)){
          throw $this->createNotFoundException();
        }
        $inflows = $module->getInflows();
        return array(
            'inflows' => $inflows,
            'base' => $module->getBase()
            );
    }

    public function getListExpenseAction($module_id){
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);
        if(!is_object($module)){
          throw $this->createNotFoundException();
        }
        $expenses = $module->getTypesExpense();
        return $expenses;
    }

    public function getGuestsinflowAction($module_id){
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);

        $modules = $module->getEvent()->getModules();
        foreach ($modules as $event_module) {
            if($event_module->getIntType() == 1){
                $guest_module = $event_module;
            }
        }
        if(isset($guest_module)){
            if($guest_module->getPayable()){
                $guests_inflow = $guest_module->getTotalPrice();
                return $guests_inflow;
            }else{
                return null;
            }
        }else{
            return null;
        }

    }

    public function getInfosAction($module_id){
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);
        if(!is_object($module)){
          throw $this->createNotFoundException();
        }

        $balance = $module->getBalance();

        $guests_inflow = $this->getGuestsinflowAction($module_id);
        if(isset($guests_inflow)){
            return array(
                'module' => $module,
                'balance' => $balance,
                'budget' => $module->getMaxBudget(),
                'guestsInflow' => $guests_inflow
            );
        }
        return array(
            'module' => $module,
            'balance' => $balance,
            'budget' => $module->getMaxBudget(),
        );
    }
}
