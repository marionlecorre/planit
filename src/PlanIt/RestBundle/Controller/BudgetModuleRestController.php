<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\BudgetBundle\Entity\BudgetModule;
use PlanIt\BudgetBundle\Form\BudgetModuleType;

class BudgetModuleRestController extends Controller
{

	public function postBudgetmoduleAction(Request $request, $event_id)
    {
        $event = $this->getDoctrine()->getRepository('PlanItEventBundle:Event')->find($event_id);

        $budget_module = new BudgetModule();
        $budget_module->setEvent($event);
        $form    = $this->createForm(new BudgetModuleType(), $budget_module);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            $budget_module->setSlug($data->getName());
            $budget_module->setIntType(2);
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($budget_module);
            $em->flush();
            
            return $this->redirect($this->generateUrl('PlanItEventBundle_event', array(
                'id'    => $event->getId()
            )));
        }

        /*return $this->render('PlanItGuestsBundle:Page:index.html.twig', array(
            'event_id'    => $guest->getModule()->getEvent()->getId(),
            'module_id'   => $comment->getModule()->getId()
        ));*/
    }

    public function getListInflowAction($module_id){
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);
        if(!is_object($module)){
          throw $this->createNotFoundException();
        }
        $list= array();
        $items = $module->getTypeItem();
        foreach ($items as $type){
            if($type->getType()== 1) {
                array_push($list,$type);
            }
        }
        return $list;
    }

    public function getListExpenseAction($module_id){
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);
        if(!is_object($module)){
          throw $this->createNotFoundException();
        }
        $list= array();
        $items = $module->getTypeItem();
        foreach ($items as $type){
            if($type->getType()== 0) {
                array_push($list,$type);
            }
        }
        return $list;
    }
}
