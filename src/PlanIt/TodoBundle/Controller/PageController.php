<?php

namespace PlanIt\TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class PageController extends Controller
{
    public function indexAction($id)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	$event = $em->getRepository('PlanItEventBundle:Event')->find($id);

        return $this->render('PlanItTodoBundle:Page:index.html.twig', array(
            'event_id' => $id,
            'user_id' => $event->getUser()->getId()
        ));
    }

    public function pdfAction($module_id){
    	$module = $this->getDoctrine()->getEntityManager()->getRepository('PlanItModuleBundle:Module')->find($module_id);
        $items = array();
        foreach($module->getLists() as $list){
            foreach ($list->getItems() as $item) {
                $items[]=$item;
            }
        }
    	$html = $this->renderView('PlanItTodoBundle:Page:pdf.html.twig', array(
					    	'items'  => $items
						));

		return new Response(
					    $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
					    200,
					    array(
					        'Content-Type'          => 'application/pdf',
					        'Content-Disposition'   => 'attachment; filename="todolist.pdf"'
					    )
					);
	}
}
