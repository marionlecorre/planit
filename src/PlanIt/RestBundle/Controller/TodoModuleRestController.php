<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\TodoBundle\Entity\TodoModule;
use PlanIt\TodoBundle\Form\TodoModuleType;

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
}
