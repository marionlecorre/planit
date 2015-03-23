<?php

namespace PlanIt\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class UserRestController extends Controller
{

    protected $container;
  	public function __construct(ContainerInterface $container = null)
  	{
    	$this->container = $container;
  	}

    public function getUserAction($id){
	    $user = $this->getDoctrine()->getRepository('PlanItUserBundle:User')->find($id);
	    if(!is_object($user)){
	      throw $this->createNotFoundException();
	    }
	    return $user;
	}

	public function getUserEventsAction($id){
	    $not_finished_events = $this->getDoctrine()->getRepository('PlanItEventBundle:Event')->findNotFinishedByUserid($id);
	    $finished_events = $this->getDoctrine()->getRepository('PlanItEventBundle:Event')->findFinishedByUserid($id);
	    $tab_events = array();
	    foreach ($not_finished_events as $event) {
	    	$tab_events[] = array(
	    		'id' => $event->getId(),
	    		'name' => $event->getName(),
	    		'description' => $event->getDescription(),
	    		'beginDate' => $event->getBeginDate(),
	    		'endDate' => $event->getEndDate(),
	    		'image' => $event->getImage()
	    	);
	    }

	    foreach ($finished_events as $event) {
	    	$tab_events[] = array(
	    		'id' => $event->getId(),
	    		'name' => $event->getName(),
	    		'description' => $event->getDescription(),
	    		'beginDate' => $event->getBeginDate(),
	    		'endDate' => $event->getEndDate(),
	    		'image' => $event->getImage()
	    	);
	    }
	    return $tab_events;
	}

	public function postLoginAction(Request $request){
	    $email = $request->request->get('email');
	    $password = $request->request->get('password');
	    $em = $this->getDoctrine();
	    $user = $this->getDoctrine()->getManager()->getRepository('PlanItUserBundle:User')->findOneByEmail($email);
	    if (!$user) {
	        return array('fail' => "User not found");
	    } else {
	        // Get the encoder for the users password
	        $encoder = $this->get('security.encoder_factory')->getEncoder($user);
	        if($encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt())){
	          // User + password match
	          
	          $token = new UsernamePasswordToken($user, null, "main", $user->getRoles());
	          $this->get("security.context")->setToken($token); //now the user is logged in
	           
	          //now dispatch the login event
	          $request = $this->get("request");
	          $event = new InteractiveLoginEvent($request, $token);
	          $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);
	        } else {
	          // Password bad
	          return array('success' => "fail");
	        }
	        
	    }
	    return $this->redirect($this->generateUrl('PlanItUserBundle_homepage', array(
            'id'    => $user->getId()
        )));
   }
}
