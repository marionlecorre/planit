<?php

namespace PlanIt\TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\TodoBundle\Entity\Item;
use PlanIt\TodoBundle\Form\ItemType;
use PlanIt\TodoBundle\Form\TaskListType;
use PlanIt\TodoBundle\Entity\TaskList;

class ItemController extends Controller
{
    public function formlistAction($module_id){
        $module = $this->getModule($module_id);


        $list = new TaskList();
        $list->setModule($module);
        $form   = $this->createForm(new TaskListType(), $list);

        return $this->render('PlanItTodoBundle:Item:listform.html.twig', array(
            'list' => $list,
            'form'   => $form->createView(),
            'module_id' => $module_id,
        ));
    }
    
    public function formAction($module_id)
    {
        $module = $this->getModule($module_id);


        $item = new Item();
        $form   = $this->createForm(new ItemType(), $item);

        return $this->render('PlanItTodoBundle:Item:form.html.twig', array(
            'item' => $item,
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