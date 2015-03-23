<?php

namespace PlanIt\BudgetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use PlanIt\BudgetBundle\Form\BudgetModuleType;


class PageController extends Controller
{

    //Impression de la liste de courses
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

    //Formulaire de modification du module
	public function updatemoduleAction($module_id)
    {
        $em = $this->getDoctrine()
                    ->getEntityManager();

        $module = $em->getRepository('PlanItBudgetBundle:BudgetModule')->find($module_id);

        $form   = $this->createForm(new BudgetModuleType(), $module);

        return $this->render('PlanItBudgetBundle:Page:update-module-form.html.twig', array(
            'module' => $module,
            'form'   => $form->createView()
        ));
    }
}
