<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\TodoBundle\Entity\TodoModule;
use PlanIt\TodoBundle\Form\TodoModuleType;
use PlanIt\TodoBundle\Entity\Item;
use PlanIt\TodoBundle\Entity\TaskList;
use PlanIt\TodoBundle\Form\ItemType;
use PlanIt\TodoBundle\Form\TaskListType;

class TodoModuleRestController extends Controller
{

	public function postTodomoduleAction(Request $request, $event_id)
    {
        $event = $this->getDoctrine()->getRepository('PlanItEventBundle:Event')->find($event_id);

        $todo_module = new TodoModule();
        $todo_module->setEvent($event);
            $todo_module->setIntType(5);
            $todo_module->setName('Listes de tâches');
            $todo_module->setSlug($todo_module->getName());
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($todo_module);
            $em->flush();
            
            return $this->redirect($this->generateUrl('PlanItEventBundle_event', array(
                'id'    => $event->getId()
            )));

    }

    public function postTasklistAction(Request $request, $module_id)
    {
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);

        $list = new TaskList();
        $list->setModule($module);
        $form    = $this->createForm(new TaskListType(), $list);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($list);
            $em->flush();
            
            return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $list->getModule()->getEvent()->getId(),
                'module_id'   => $list->getModule()->getId()
            )));
        }
    }

    public function postItemAction(Request $request, $list_id)
    {
        $list = $this->getDoctrine()->getRepository('PlanItTodoBundle:TaskList')->find($list_id);

        $item = new Item();
        $item->setList($list);
        $form    = $this->createForm(new ItemType(), $item);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $item->setChecked(0);
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($item);
            $em->flush();
            
            return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $list->getModule()->getEvent()->getId(),
                'module_id'   => $list->getModule()->getId()
            )));
        }
    }

    public function putItemCheckedAction(Request $request, $item_id)
    {
        $item = $this->getDoctrine()->getRepository('PlanItTodoBundle:Item')->find($item_id);

        $item->setChecked($request->request->get('checked'));
        $em = $this->getDoctrine()
                   ->getEntityManager();
        $em->persist($item);
        $em->flush();
    }

    public function deleteItemAction($item_id)
    {
        $item = $this->getDoctrine()->getRepository('PlanItTodoBundle:Item')->find($item_id);
        $em = $em = $this->getDoctrine()
                       ->getEntityManager();
        $em->remove($item);
        $em->flush();
    }

    public function putItemAction(Request $request, $item_id)
    {
        $item = $this->getDoctrine()->getRepository('PlanItTodoBundle:Item')->find($item_id);

        $item->setContent($request->request->get('content'));
        $em = $this->getDoctrine()
                   ->getEntityManager();
        $em->persist($item);
        $em->flush();
    }
}
