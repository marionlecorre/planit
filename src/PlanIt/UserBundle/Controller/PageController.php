<?php

namespace PlanIt\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Event\FilterUserResponseEvent;


class PageController extends Controller
{
    public function indexAction($id)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if(!$user || $user == "anon."){
            return $this->redirect($this->generateUrl('PlanItUserBundle_login'));
        }else{
            if($user->getId() != $id){
                return $this->render('PlanItUserBundle:Page:forbidden.html.twig');
            }
        }
        $em = $this->getDoctrine()->getManager();
        $user = $this->get("user_api_controller")->getUserAction($id);
        $events = $this->get("user_api_controller")->getUserEventsAction($id);
        return $this->render('PlanItUserBundle:Page:index.html.twig', array(
            'user' => $user,
            'events' => $events
        ));
    }

    public function loginAction(Request $request)
    {
        
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();
        if($session){
            $user = $this->container->get('security.context')->getToken()->getUser();
            if($user != "anon."){
                return $this->redirect($this->generateUrl('PlanItUserBundle_homepage', array(
                    'id'    => $user->getId()
                )));
            }
        }
        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContextInterface::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = null;
        }

        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);

        $csrfToken = $this->has('form.csrf_provider')
            ? $this->get('form.csrf_provider')->generateCsrfToken('authenticate')
            : null;
        return $this->render('PlanItUserBundle:Page:login.html.twig',array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'csrf_token' => $csrfToken,
        ));
    }

    public function registerAction(Request $request)
    {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user = $userManager->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

            $userManager->updateUser($user);
            $file = $form['image']->getData();
            $extension = $file->guessExtension();
            if (!$extension) {
                $extension = 'bin';
            }

            $rand = rand(1, 99999);
            $file->move($user->getUploadRootDir(), $user->getId().'-'.$rand.'.'.$extension);
            $user->setImage($user->getId().'-'.$rand.'.'.$extension);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_registration_confirmed');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
            return $this->redirect($this->generateUrl('PlanItUserBundle_homepage', array(
                    'id'    => $user->getId()
                )));

            return $response;
        }

        return $this->render('PlanItUserBundle:Page:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function logoutAction(Request $request)
    {
        $this->get('security.context')->setToken(null);
        $request->getSession()->invalidate();
        return $this->redirect($this->generateUrl('PlanItUserBundle_login'));
    }

}
