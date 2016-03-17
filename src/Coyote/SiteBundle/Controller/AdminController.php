<?php

namespace Coyote\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FilterUserResponseEvent;

use Coyote\SiteBundle\Entity\Data;

/**
 * Admin controller.
 *
 */
class AdminController extends Controller
{
    /**
     * Export expense for X3 in text file.
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function getexportExpenseAction()
    {
        if($this->get('security.context')->isGranted('ROLE_COMPTA'))
        {
            /** @var $filename string */
            $filename = "export".date("Ymd")."-".date("His").".txt";
            /** @var $em object doctrine request */
            $em = $this->getDoctrine()->getManager();
            /** @var $dataexpense string data file */
            $dataexpense = $em->getRepository('CoyoteSiteBundle:Expense')->createFileExpense();
            /** update status from Expense */
            $em->getRepository('CoyoteSiteBundle:Expense')->updateStatusTo0();
            /** @return file txt downloaded with data expense */
            if (count($dataexpense)>1)
                return new Response($dataexpense, 200, array(
                    'Content-Type' => 'application/force-download',
                    'Content-Disposition' => 'attachment; filename="'.$filename.'"'));
            else
                return $this->redirect($this->generateUrl('main_menu'));
        }
        else
            /** redirect MainController:indexAction */
            return $this->redirect($this->generateUrl('main_menu'));
    }

    /**
     * Export data design office users.
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function getexportDataUserAction()
    {
        /** check role */
        if ($this->get('security.context')->isGranted('ROLE_CHEF_BE'))
        {
            /** @var $em object doctrine request */
            $em = $this->getDoctrine()->getManager();
            /** @var $data array data request */
            $request = $this->getRequest();
            $data_request = $request->request->all();
            
            if ($data_request == null)
            {
	            $tab_month = $em->getRepository('CoyoteSiteBundle:User')->findMonth();
	            $tab_num_month = $em->getRepository('CoyoteSiteBundle:User')->findNumMonth();
	            $tab_year = $em->getRepository('CoyoteSiteBundle:User')->findYear();
                /** show view */
	            return $this->render('CoyoteSiteBundle:Admin:index_export.html.twig', array('month' => date('n'),
	                'year' => date('Y'), 'tab_mois' => $tab_month, 'tab_num_mois' => $tab_num_month,
	                'tab_annee' => $tab_year));
            }
            else
            {
	            $ids_user_be = $em->getRepository('CoyoteSiteBundle:User')->findUserBe("%ROLE_BE_USER%");
	            $filecsv = $em->getRepository('CoyoteSiteBundle:Schedule')->createFileUserBE($ids_user_be,
                    $data_request['month'], $data_request['year']);
                /** @var $filename string file name CSV */
                $filename = 'datauser'.$data_request['month'].'/'.$data_request['year'].'.csv';
                /** @return file csv downloaded with data user schedule */
                return new Response($filecsv, 200, array(
                    'Content-Type' => 'application/force-download',
                    'Content-Disposition' => 'attachment; filename="'.$filename.'"'
                ));
            }
        }
        else
        {
            /** redirect MainController:indexAction */
            return $this->redirect($this->generateUrl('main_menu'));
        }
    }

    /**
     * Registrer user.
     * @access public
     * @param Request $request
     * @return \Coyote\SiteBundle\Controller\RedirectResponse|\Symfony\Component\HttpFoundation\Response|
     * \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function registerAction(Request $request)
    {
        if($this->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
            $formFactory = $this->container->get('fos_user.registration.form.factory');
            /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
            $userManager = $this->container->get('fos_user.user_manager');
            /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
            $dispatcher = $this->container->get('event_dispatcher');

            $user = $userManager->createUser();
            $user->setEnabled(true);

            $event = new GetResponseUserEvent($user, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

            if (null !== $event->getResponse()) {
                return $event->getResponse();
            }

            $form = $formFactory->createForm();
            $form->setData($user);
            $request = $this->getRequest();
            if ('POST' === $request->getMethod()) {
                $form->bind($request);

                if ($form->isValid()) {
                    $event = new FormEvent($form, $request);
                    $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

                    $userManager->updateUser($user);

                    if (null === $response = $event->getResponse()) {
                        $url = $this->container->get('router')->generate('fos_user_registration_confirmed');
                        $response = new RedirectResponse($url);
                    }

                    $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user,
                        $request, $response));

                    return $response;
                }
            }

            return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.', 
            		array('form' => $form->createView(),));
        }
        else
             return $this->redirect($this->generateUrl('main_menu'));
    }

    /**
     * Function to choose user.
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function getchoicesUserAction()
    {
        if ($this->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            $em = $this->getDoctrine()->getManager();
            $users = $em->getRepository('CoyoteSiteBundle:User')->findEnabledOrderByName();
            return $this->render('CoyoteSiteBundle:Admin:index_choicesuser.html.twig', array('users' => $users));
        }
        else
        {
            return $this->redirect($this->generateUrl('main_menu'));
        }
    }

    /**
     * Function to choose roles user.
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function postchoicesrolesUserAction()
    {
        if($this->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            /** @var $em object doctrine request */
            $em = $this->getDoctrine()->getManager();
            $request = $this->getRequest();
            /** @var $data array data request */
            $data_request = $request->request->all();
            /** check @var data */
            if ($data_request == null)
            {
                /** show view */
                return $this->render('CoyoteSiteBundle:Admin:index_choicesroles.html.twig');
            }
            else
            {
                $request = $this->getRequest();
                $session = $request->getSession();
                $session->set('choicesroles', $data_request['user']);
                $user = $em->getRepository('CoyoteSiteBundle:User')->find($data_request['user']);
                return $this->render('CoyoteSiteBundle:Admin:choicesroles.html.twig', array('user' => $user));
            }
        }
        else
        {
            return $this->redirect($this->generateUrl('main_menu'));
        }
    }

    /**
     * Function to update roles user.
     * @access public
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function postrolesUserAction()
    {
        if ($this->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            $request = $this->getRequest();
            /** @var $data array data request */
            $data_request = $request->request->all();

            $res = null;
            $session = $this->getRequest()->getSession();

            if(isset($data_request['add']))
            {
            	$request = $this->getRequest();
            	$em = $this->getDoctrine()->getManager();
            	$user_choice = $em->getRepository("CoyoteSiteBundle:User")->findOneById($session->get("choicesroles"));
                $res = $em->getRepository("CoyoteSiteBundle:User")->updateRoles(
                		$user_choice, $data_request, "add");
                if ($res == "OK")
                	$message = 'admin.updaterole.flash.add';
                $this->get('session')->getFlashBag()->set('admin_updaterole', $message);
                return $this->redirect($this->generateUrl('admin_indexchoicesuser'));
            }
            if(isset($data_request['remove']))
            {
                $request = $this->getRequest();
                $em = $this->getDoctrine()->getManager();
                $user_choice = $em->getRepository("CoyoteSiteBundle:User")->findOneById($session->get("choicesroles"));
                $res = $em->getRepository("CoyoteSiteBundle:User")->updateRoles(
                		$user_choice, $data_request, "remove");
                if($res == "OK")
                	$message = 'admin.updaterole.flash.remove';
                $this->get('session')->getFlashBag()->set('admin_updaterole', $message);
                return $this->redirect($this->generateUrl('admin_indexchoicesuser'));
            }
            else
            {
                return $this->redirect($this->generateUrl('main_menu'));
            }
        }
        else
        {
            return $this->redirect($this->generateUrl('main_menu'));
        }
    }

    /**
     * Function to show Expense save.
     * @access public
     * @param integer $page
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function getExpensesAction($page)
    {
    	if($this->get('security.context')->isGranted('ROLE_COMPTA'))
    	{
    		$user = $this->get('security.context')->getToken()->getUser();
    		if ($user == "anon.")
    		{
    			return $this->redirect($this->generateUrl('fos_user_security_login'));
    		}
    		else
    		{
    			$em = $this->getDoctrine()->getManager();
    			$maxItems = 10;
    			$data_expense = $em->getRepository('CoyoteSiteBundle:Expense')->findAllAboutStatus();
    			$expenses_count = count($data_expense);
    			$pagination = array(
    					'page' => $page,
    					'route' => 'admin_showadmin',
    					'pages_count' => ceil($expenses_count / $maxItems),
    					'route_params' => array()
    			);
    			$entities = $this->getDoctrine()->getRepository('CoyoteSiteBundle:Expense')->getListAboutStatus(
    					$page, $maxItems);

    			return $this->render('CoyoteSiteBundle:Expense:showadmin.html.twig', array(
    					'data' => $entities,
    					'pagination' => $pagination));
    		}
    	}
    	else
    	{
    		return $this->redirect($this->generateUrl('main_menu'));
    	}
    }

    public function getScheduleUserAction()
    {
        /** @var $em object doctrine request */
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        /** @var $dataexpense string data file */
        $data_request = $request->request->all();

        if ($request->getMethod() == 'GET' && filter_input(INPUT_GET, 'pay_period', FILTER_UNSAFE_RAW))
    	{
            $year = explode('/', filter_input(INPUT_GET, 'pay_period', FILTER_UNSAFE_RAW));
            $date_start = $year[0]."-06-01";
            $date_end = $year[1]."-05-31";
            $user = $em->getRepository('CoyoteSiteBundle:User')->findOneById(filter_input(INPUT_GET, 'user', FILTER_UNSAFE_RAW));
            /** @var $filename string */
            $filename = "export_period".$date_start."-".$date_end.$user->getName().".csv";

            $data_schedule = $em->getRepository('CoyoteSiteBundle:Schedule')->createFileUser($user, $date_start,
                $date_end);
            /** @return file txt downloaded with data expense */
            return new Response($data_schedule, 200, array(
                'Content-Type' => 'application/force-download',
                'Content-Disposition' => 'attachment; filename="'.$filename.'"'
            ));
        }
        else
        {
            $date = date('Y-m-d');
            $tab_period = $em->getRepository('CoyoteSiteBundle:User')->findPeriod();
            $doctrine = $this->getDoctrine();
        	$em = $doctrine->getManager();
        	$period = $em->getRepository('CoyoteSiteBundle:Schedule')->findPeriodByDate($date);
        	$tab_user = $em->getRepository('CoyoteSiteBundle:User')->findEnabledOrderByName();
            /** show view */
            return $this->render('CoyoteSiteBundle:Admin:indexscheduleuserexcel.html.twig', array(
                'period' => $period, 'tab_period' => $tab_period, 'tab_user' => $tab_user));
        }
    }

}