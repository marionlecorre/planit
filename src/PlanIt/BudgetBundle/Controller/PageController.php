<?php

namespace PlanIt\BudgetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
    public function indexAction($id)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	$event = $em->getRepository('PlanItEventBundle:Event')->find($id);

        return $this->render('PlanItBudgetBundle:Page:index.html.twig', array(
            'event_id' => $id,
            'user_id' => $event->getUser()->getId()
        ));
    }

    public function pdfAction($module_id){
    	$module = $this->getDoctrine()->getEntityManager()->getRepository('PlanItModuleBundle:Module')->find($module_id);
    	$html = $this->renderView('PlanItBudgetBundle:Page:pdf.html.twig', array(
					    	'module'  => $module,
					    	'types_expense' => $module->getTypesExpense()
						));

		return new Response(
					    $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
					    200,
					    array(
					        'Content-Type'          => 'application/pdf',
					        'Content-Disposition'   => 'attachment; filename="liste.pdf"'
					    )
					);
	}
}
