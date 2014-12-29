<?php

namespace PlanIt\ModuleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\ModuleBundle\Entity\Module;
use PlanIt\ModuleBundle\Form\ModuleType;

class ModuleController extends Controller
{
    public function formAction($event_id)
    {
        $event = $this->getEvent($event_id);


        $module = new Module();
        $module->setEvent($event);
        $form   = $this->createForm(new ModuleType(), $module);

        return $this->render('PlanItEventBundle:Page:form.html.twig', array(
            'module' => $module,
            'form'   => $form->createView(),
            'event_id' => $event_id
        ));
    }

    protected function getEvent($event_id)
    {
        $em = $this->getDoctrine()
                    ->getEntityManager();

        $event = $em->getRepository('PlanItEventBundle:Event')->find($event_id);

        if (!$event) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $event;
    }
}
