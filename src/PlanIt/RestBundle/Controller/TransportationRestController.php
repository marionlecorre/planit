<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\TransportationBundle\Entity\Transportation;
use PlanIt\TransportationBundle\Form\TransportationType;
use PlanIt\TransportationBundle\Form\ContractType;
use PlanIt\TransportationBundle\Form\ImageType;

class TransportationRestController extends Controller
{

    public function postTransportationAction(Request $request, $module_id)
    {
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);

        $transportation = new Transportation();
        $transportation->setModule($module);
        if($request->request->get('transportation_form') == null){
            $transportation->setName($request->request->get('name'));
            $transportation->setTel($request->request->get('tel'));
            $transportation->setPrice($request->request->get('price'));
            $transportation->setCapacity($request->request->get('capacity'));
            $transportation->setWebsite($request->request->get('website'));
            $transportation->setRemark($request->request->get('remark'));
            $transportation->setState($request->request->get('state'));
            $file = $request->files->get('image');
            $extension = $file->guessExtension();
            if($request->files->get('image') != null){
                $file = $request->files->get('image');
                $extension = $file->guessExtension();
                if (!$extension) {
                    $extension = 'bin';
                }

                $rand = rand(1, 99999);
                $file->move($place->getImageUploadRootDir(), $place->getId().'-'.$rand.'.'.$extension);
                $place->setImage($place->getId().'-'.$rand.'.'.$extension);
            }

            if($request->files->get('contract') != null){
                $contract = $request->files->get('contract');
                $extension = $contract->guessExtension();
                if (!$extension) {
                    $extension = 'bin';
                }

                $rand = rand(1, 99999);
                $contract->move($place->getUploadRootDir(), $place->getId().'-'.$rand.'.'.$extension);
                $place->setContract($place->getId().'-'.$rand.'.'.$extension);
            }
            $em = $this->getDoctrine()
                           ->getEntityManager();
                $em->persist($place);
                $em->flush();
            return 'ok';      
        }else{
            $form = $this->createForm(new TransportationType("add"), $transportation);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()
                           ->getEntityManager();
                $em->persist($transportation);
                $em->flush();

                if($form['contract']->getData() != null){
                    $file = $form['contract']->getData();
                    $extension = $file->guessExtension();
                    if (!$extension) {
                        $extension = 'bin';
                    }
                    $rand = rand(1, 99999);
                    $file->move($transportation->getUploadRootDir(), $transportation->getId().'-'.$rand.'.'.$extension);
                    $transportation->setContract($transportation->getId().'-'.$rand.'.'.$extension);
                }

                if($form['image']->getData() != null){
                    $file = $form['image']->getData();
                    $extension = $file->guessExtension();
                    if (!$extension) {
                        $extension = 'bin';
                    }
                    $rand = rand(1, 99999);
                    $file->move($transportation->getImageUploadRootDir(), $transportation->getId().'-'.$rand.'.'.$extension);
                    $transportation->setImage($transportation->getId().'-'.$rand.'.'.$extension);
                }
                $em = $this->getDoctrine()
                           ->getEntityManager();
                $em->persist($transportation);
                $em->flush();

                return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                    'event_id'    => $transportation->getModule()->getEvent()->getId(),
                    'module_id'   => $transportation->getModule()->getId()
                )));
            }
            $session = $request->getSession();
            $errors = $this->get('validator')->validate( $transportation );
            foreach( $errors as $error )
            {
                $session->getFlashBag()->add('errors', $error->getMessage());
            }
            return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $transportation->getModule()->getEvent()->getId(),
                'module_id'   => $transportation->getModule()->getId()
            )));
        }
    }

    public function deleteTransportationAction($transportation_id)
    {
        $transportation = $this->getDoctrine()->getRepository('PlanItTransportationBundle:Transportation')->find($transportation_id);
        $em = $em = $this->getDoctrine()
                       ->getEntityManager();
        $em->remove($transportation);
        $em->flush();
        return $transportation->getModule();

    }

    public function putTransportationChoseAction(Request $request, $transportation_id)
    {
        $choosen_transportation = $this->getDoctrine()->getRepository('PlanItTransportationBundle:Transportation')->find($transportation_id);
        $transportations = $this->getDoctrine()->getRepository('PlanItTransportationBundle:Transportation')->findByModule($choosen_transportation->getModule()->getId());
        foreach ($transportations as $transportation) {
            if($transportation->getState() == 1){
                $transportation->setState($transportation->getOldstate());
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($transportation);
            $em->flush();
        }
        $choosen_transportation->setOldstate($choosen_transportation->getState());
        $choosen_transportation->setState($request->request->get('check'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($choosen_transportation);
        $em->flush();
        $states = array();
        foreach ($transportations as $transportation) {
            $states[$transportation->getId()] = $transportation->getState();
        }
        return $states;
    }

    public function putTransportationAction(Request $request, $transportation_id)
    {
        $transportation = $this->getDoctrine()->getRepository('PlanItTransportationBundle:Transportation')->find($transportation_id);
        $form = $this->createForm(new TransportationType("update"), $transportation, array('method' => 'PUT'));
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($transportation);
            $em->flush();
            return $transportation->getModule();
        }
    }

    public function postTransportationContractAction(Request $request, $transportation_id)
    {
        $transportation = $this->getDoctrine()->getRepository('PlanItTransportationBundle:Transportation')->find($transportation_id);
        $transportation->setContract(null);
        $form = $this->createForm(new ContractType(), $transportation);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $file = $form['contract']->getData();
            $extension = $file->guessExtension();
            if (!$extension) {
                $extension = 'bin';
            }
            $rand = rand(1, 99999);
            $file->move($transportation->getUploadRootDir(), $transportation_id.'-'.$rand.'.'.$extension);
            $transportation->setContract($transportation_id.'-'.$rand.'.'.$extension);
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($transportation);
            $em->flush();

            return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $transportation->getModule()->getEvent()->getId(),
                'module_id'   => $transportation->getModule()->getId()
            )));
        }
    }

    public function postTransportationImageAction(Request $request, $transportation_id)
    {
        $transportation = $this->getDoctrine()->getRepository('PlanItTransportationBundle:Transportation')->find($transportation_id);
        $transportation->setImage(null);
        $form = $this->createForm(new ImageType(), $transportation);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $file = $form['image']->getData();
            $extension = $file->guessExtension();
            if (!$extension) {
                $extension = 'bin';
            }
            $rand = rand(1, 99999);
            $file->move($transportation->getImageUploadRootDir(), $transportation_id.'-'.$rand.'.'.$extension);
            $transportation->setImage($transportation_id.'-'.$rand.'.'.$extension);
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($transportation);
            $em->flush();

            return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $transportation->getModule()->getEvent()->getId(),
                'module_id'   => $transportation->getModule()->getId()
            )));
        }
    }

    // public function postPlacemoduleUpdateAction(Request $request, $module_id)
    // {
        
    //     $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);
    //     $form    = $this->createForm(new PlaceModuleType(), $module);
    //     $form->handleRequest($request);
    //     if ($form->isValid()) {
    //         $data = $form->getData();
    //         $em = $this->getDoctrine()
    //                    ->getEntityManager();
    //         $em->persist($module);
    //         $em->flush();
            
    //         return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
    //             'event_id'    => $module->getEvent()->getId(),
    //             'module_id'   => $module->getId()
    //         )));
    //     }

    //     return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
    //             'event_id'    => $module->getEvent()->getId(),
    //             'module_id'   => $module->getId()
    //         )));
    // }


}
