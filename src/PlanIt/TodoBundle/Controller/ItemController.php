<?php

namespace PlanIt\TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\TodoBundle\Entity\Item;
use PlanIt\TodoBundle\Form\ItemType;

class ItemController extends Controller
{
    public function formAction($module_id)
    {
        $module = $this->getModule($module_id);


        $item = new Item();
        $item->setModule($module);
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