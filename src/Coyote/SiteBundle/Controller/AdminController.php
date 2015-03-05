<?php

namespace Coyote\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

use Doctrine\ORM\EntityRepository;

use Coyote\SiteBundle\Entity\Schedule;
use Coyote\SiteBundle\Entity\Timetable;
use Coyote\SiteBundle\Entity\User;
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
    public function exportExpenseAction()
    {
        if($this->get('security.context')->isGranted('ROLE_COMPTA'))
        {
            /** @var $filename string */
            $filename = "export".date("Ymd")."-".date("His").".txt";
            /** @var $em object doctrine request */
            $em = $this->getDoctrine()->getManager();
            /** @var $dataexpense string data file */
            $dataexpense = $em->getRepository('CoyoteSiteBundle:Expense')->fileDataExpenseCompta();
            /** update status from Expense */
            $em->getRepository('CoyoteSiteBundle:Expense')->updateStatus($em);
            /** @return file txt downloaded with data expense */
            return new Response($dataexpense, 200, array(
                'Content-Type' => 'application/force-download',
                'Content-Disposition' => 'attachment; filename="'.$filename.'"'
            ));
        }
        else
            /** redirect MainController:indexAction */
            return $this->redirect($this->generateUrl('main_menu'));
    }

    /**
     * Redirect to function fos_user_change_password.
     * @access public
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function changePasswordAction()
    {
        /** redirect \FOS\UserBundle\Controller\ChangePasswordController */
        return $this->redirect($this->generateUrl('fos_user_change_password'));
    }

    /**
     * Redirect to function fos_user_resetting_request.
     * @access public
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function resettingAction()
    {
        /** redirect \FOS\UserBundle\Controller\ResettingController */
        return $this->redirect($this->generateUrl('fos_user_resetting_request'));
    }

    /**
     * Show profil user connected.
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function profilAction()
    {
        /** @var object user */
        $user = $this->container->get('security.context')->getToken()->getUser();
        /** show view */
        return $this->render('CoyoteSiteBundle:Profile:show.html.twig', array('user' => $user));
    }

    /**
     * Redirect to accueil if user want edit.
     * @access public
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function profileditAction()
    {
        /** redirect MainController:indexAction */
        return $this->redirect($this->generateUrl('main_menu'));
    }

    /**
     * Show index to choose month and year to extract data design office users.
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function showexportAction()
    {
        if($this->get('security.context')->isGranted('ROLE_CHEF_BE'))
        {
            /** @var $data object Data */
            $data = new Data();
            /** show view */
            return $this->render('CoyoteSiteBundle:Admin:index_export.html.twig', array('month' => date('n'),
                'year' => date('Y'), 'tab_mois' => $data->getTabMonth(), 'tab_num_mois' => $data->getTabNumMonth(),
                'tab_annee' => $data->getTabYear()));
        }
        else
        /** redirect MainController:IndexAction */
            return $this->redirect($this->generateUrl('main_menu'));
    }

    /**
     * Export data design office users.
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function exportDataUserAction()
    {
        /** check role */
        if ($this->get('security.context')->isGranted('ROLE_CHEF_BE'))
        {
            /** @var $em object doctrine request */
            $em = $this->getDoctrine()->getManager();
            /** @var $request object request */
            $request = Request::createFromGlobals();
            /** @var $data array data request */
            $data_request = $request->request->all();
            /** check @var data */
            if ($data_request == null)
            {
                /** show view */
                return $this->render('CoyoteSiteBundle:Admin:index_export.html.twig');
            }
            else
            {
                /** @var $data object Entity Data */
                $data = new Data();
                $filecsv = $em->getRepository('CoyoteSiteBundle:Schedule')->fileDataUserBE($data->getTabUserIdBE(),
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
     * @return \Coyote\SiteBundle\Controller\RedirectResponse|\Symfony\Component\HttpFoundation\Response|\Symfony\Component\HttpFoundation\RedirectResponse
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

            return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.', array(
                'form' => $form->createView(),
            ));
        }
        else
             return $this->redirect($this->generateUrl('main_menu'));
    }

    /**
     * Function to choose user.
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexchoicesuserAction()
    {
        if ($this->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            $em = $this->getDoctrine()->getManager();
            $users = $em->getRepository('CoyoteSiteBundle:User')->findAllOrderById();
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
    public function choicesrolesAction()
    {
        if($this->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            /** @var $em object doctrine request */
            $em = $this->getDoctrine()->getManager();
            /** @var $request object request */
            $request = Request::createFromGlobals();
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
    public function updaterolesAction()
    {
        if ($this->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            /** @var $request object request */
            $request = Request::createFromGlobals();
            /** @var $data array data request */
            $data_request = $request->request->all();
            
            if(isset($data_request['add']))
            {
                $request = $this->getRequest();
                $message = 'admin.updaterole.flash.add';
                $this->get('session')->getFlashBag()->set('admin_updaterole', $message);
                return $this->redirect($this->generateUrl('admin_indexchoicesuser'));
            }
            if(isset($data_request['remove']))
            {
                $request = $this->getRequest();
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

}