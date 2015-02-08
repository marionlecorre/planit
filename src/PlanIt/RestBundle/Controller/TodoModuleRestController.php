<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\TodoBundle\Entity\TodoModule;
use PlanIt\TodoBundle\Form\TodoModuleType;
use PlanIt\TodoBundle\Entity\Item;
use PlanIt\TodoBundle\Form\ItemType;

class TodoModuleRestController extends Controller
{

	public function postTodomoduleAction(Request $request, $event_id)
    {
        $event = $this->getDoctrine()->getRepository('PlanItEventBundle:Event')->find($event_id);

        $todo_module = new TodoModule();
        $todo_module->setEvent($event);
        $form    = $this->createForm(new TodoModuleType(), $todo_module);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            $todo_module->setSlug($data->getName());
            $todo_module->setIntType(5);
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($todo_module);
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

    public function postItemAction(Request $request, $module_id)
    {
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);

        $item = new Item();
        $item->setModule($module);
        $form    = $this->createForm(new ItemType(), $item);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $item->setChecked(0);
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($item);
            $em->flush();
            
            return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $item->getModule()->getEvent()->getId(),
                'module_id'   => $item->getModule()->getId()
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
        
        return $item->getModule();
    }
}
