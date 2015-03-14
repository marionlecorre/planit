<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PlanIt\PlaceBundle\Entity\Place;
use PlanIt\PlaceBundle\Form\PlaceType;
use PlanIt\PlaceBundle\Form\PlaceModuleType;
use PlanIt\PlaceBundle\Form\ContractType;
use PlanIt\PlaceBundle\Form\ImageType;

class PlaceRestController extends Controller
{

    public function getPlacesAction(Request $request, $module_id){
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);
        return $module->getPlaces();
    }
    public function postPlaceAction(Request $request, $module_id)
    {
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);

        $place = new Place();
        $place->setModule($module);
        if($request->request->get('place_form') == null){
            $place->setName($request->request->get('name'));
            $place->setAddress($request->request->get('address'));
            $place->setTel($request->request->get('tel'));
            $place->setDistance($request->request->get('distance'));
            $place->setPrice($request->request->get('price'));
            $place->setCapacity($request->request->get('capacity'));
            $place->setWebsite($request->request->get('website'));
            $place->setLatitude($request->request->get('latitude'));
            $place->setLongitude($request->request->get('longitude'));
            $place->setRemark($request->request->get('remark'));
            $place->setState($request->request->get('state'));
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
            $form = $this->createForm(new PlaceType("add"), $place);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()
                           ->getEntityManager();
                $em->persist($place);
                $em->flush();

                if($form['contract']->getData() != null){
                    $file = $form['contract']->getData();
                    $extension = $file->guessExtension();
                    if (!$extension) {
                        $extension = 'bin';
                    }
                    $rand = rand(1, 99999);
                    $file->move($place->getUploadRootDir(), $place->getId().'-'.$rand.'.'.$extension);
                    $place->setContract($place->getId().'-'.$rand.'.'.$extension);
                }

                if($form['image']->getData() != null){
                    $file = $form['image']->getData();
                    $extension = $file->guessExtension();
                    if (!$extension) {
                        $extension = 'bin';
                    }
                    $rand = rand(1, 99999);
                    $file->move($place->getImageUploadRootDir(), $place->getId().'-'.$rand.'.'.$extension);
                    $place->setImage($place->getId().'-'.$rand.'.'.$extension);
                }
                $em = $this->getDoctrine()
                           ->getEntityManager();
                $em->persist($place);
                $em->flush();

                return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                    'event_id'    => $place->getModule()->getEvent()->getId(),
                    'module_id'   => $place->getModule()->getId()
                )));
            }
            $session = $request->getSession();
            $errors = $this->get('validator')->validate( $place );
            foreach( $errors as $error )
            {
                $session->getFlashBag()->add('errors', $error->getMessage());
            }
            return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $place->getModule()->getEvent()->getId(),
                'module_id'   => $place->getModule()->getId()
            )));
        }
    }

    public function deletePlaceAction($place_id)
    {
        $place = $this->getDoctrine()->getRepository('PlanItPlaceBundle:Place')->find($place_id);
        $em = $em = $this->getDoctrine()
                       ->getEntityManager();
        $em->remove($place);
        $em->flush();
        return $place->getModule();

    }

    public function putPlaceChoseAction(Request $request, $place_id)
    {
        $choosen_place = $this->getDoctrine()->getRepository('PlanItPlaceBundle:Place')->find($place_id);
        $places = $this->getDoctrine()->getRepository('PlanItPlaceBundle:Place')->findByModule($choosen_place->getModule()->getId());
        foreach ($places as $place) {
            if($place->getState() == 1){
                $place->setState($place->getOldstate());
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($place);
            $em->flush();
        }
        $choosen_place->setOldstate($choosen_place->getState());
        $choosen_place->setState($request->request->get('check'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($choosen_place);
        $em->flush();
        $states = array();
        foreach ($places as $place) {
            $states[$place->getId()] = $place->getState();
        }
        return $states;
    }

    public function putPlaceAction(Request $request, $place_id)
    {
        $place = $this->getDoctrine()->getRepository('PlanItPlaceBundle:Place')->find($place_id);
        $form = $this->createForm(new PlaceType("update"), $place, array('method' => 'PUT'));
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($place);
            $em->flush();
            return $place->getModule();
        }
    }

    public function postPlaceContractAction(Request $request, $place_id)
    {
        $place = $this->getDoctrine()->getRepository('PlanItPlaceBundle:Place')->find($place_id);
        $place->setContract(null);
        $form = $this->createForm(new ContractType(), $place);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $file = $form['contract']->getData();
            $extension = $file->guessExtension();
            if (!$extension) {
                $extension = 'bin';
            }
            $rand = rand(1, 99999);
            $file->move($place->getUploadRootDir(), $place_id.'-'.$rand.'.'.$extension);
            $place->setContract($place_id.'-'.$rand.'.'.$extension);
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($place);
            $em->flush();

            return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $place->getModule()->getEvent()->getId(),
                'module_id'   => $place->getModule()->getId()
            )));
        }
    }

    public function postPlaceImageAction(Request $request, $place_id)
    {
        $place = $this->getDoctrine()->getRepository('PlanItPlaceBundle:Place')->find($place_id);
        $place->setImage(null);
        $form = $this->createForm(new ImageType(), $place);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $file = $form['image']->getData();
            $extension = $file->guessExtension();
            if (!$extension) {
                $extension = 'bin';
            }
            $rand = rand(1, 99999);
            $file->move($place->getImageUploadRootDir(), $place_id.'-'.$rand.'.'.$extension);
            $place->setImage($place_id.'-'.$rand.'.'.$extension);
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($place);
            $em->flush();

            return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $place->getModule()->getEvent()->getId(),
                'module_id'   => $place->getModule()->getId()
            )));
        }
    }

    public function postPlacemoduleUpdateAction(Request $request, $module_id)
    {
        
        $module = $this->getDoctrine()->getRepository('PlanItModuleBundle:Module')->find($module_id);
        $form    = $this->createForm(new PlaceModuleType(), $module);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($module);
            $em->flush();
            
            return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $module->getEvent()->getId(),
                'module_id'   => $module->getId()
            )));
        }

        return $this->redirect($this->generateUrl('PlanItModuleBundle_module', array(
                'event_id'    => $module->getEvent()->getId(),
                'module_id'   => $module->getId()
            )));
    }


}
