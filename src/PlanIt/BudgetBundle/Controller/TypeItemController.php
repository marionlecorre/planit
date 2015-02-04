<?php

namespace PlanIt\BudgetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\BudgetBundle\Entity\TypeItem;
use PlanIt\BudgetBundle\Form\TypeItemType;

class TypeItemController extends Controller
{
    public function formAction($module_id)
    {
        $module = $this->getModule($module_id);


        $type_item = new TypeItem();
        $type_item->setModule($module);
        $form   = $this->createForm(new TypeItemType(), $type_item);

        return $this->render('PlanItBudgetBundle:TypeItem:form.html.twig', array(
            'type_item' => $type_item,
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