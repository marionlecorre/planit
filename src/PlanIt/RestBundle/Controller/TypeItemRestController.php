<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\BudgetBundle\Entity\TypeItem;
use PlanIt\BudgetBundle\Form\TypeItemType;

class TypeItemRestController extends Controller
{

    public function postTypeItemAction(Request $request, $type, $module_id)
    {

        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);

        $type_item = new TypeItem();
        $type_item->setModule($module);

        $form = $this->createForm(new TypeItemType(), $type_item);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $type_item->setType($type);
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($type_item);
            $em->flush();

            return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $type_item->getModule()->getEvent()->getId(),
                'module_id'   => $type_item->getModule()->getId()
            )));
        }
        return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
            'event_id'    => $type_item->getModule()->getEvent()->getId(),
            'module_id'   => $type_item->getModule()->getId()
        )));
    }

}
