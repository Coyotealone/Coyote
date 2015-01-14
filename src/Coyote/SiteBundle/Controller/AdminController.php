<?php

namespace Coyote\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Compenent\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Console\Helper\ProgressBar;

use Doctrine\ORM\EntityRepository;

use Coyote\SiteBundle\Entity\Schedule;
use Coyote\SiteBundle\Entity\Timetable;
use Coyote\SiteBundle\Entity\UserInfo;
use Coyote\SiteBundle\Entity\User;
use Coyote\SiteBundle\Entity\Data;

/**
 * Admin controller.
 *
 */
class AdminController extends Controller
{

    /**
     * export expense for X3 in text file
     *
     * @access public
     * @return void
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
            $dataexpense = $em->getRepository('CoyoteSiteBundle:Expense')->findforCompta();
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
            return $this->redirect($this->generateUrl('main_accueil'));
    }

    /**
     * redirect to function fos_user_change_password.
     *
     * @access public
     * @return void
     */
    public function changePasswordAction()
    {
        /** redirect \FOS\UserBundle\Controller\ChangePasswordController */
        return $this->redirect($this->generateUrl('fos_user_change_password'));
    }

    /**
     * redirect to function fos_user_resetting_request.
     *
     * @access public
     * @return void
     */
    public function resettingAction()
    {
        /** redirect \FOS\UserBundle\Controller\ResettingController */
        return $this->redirect($this->generateUrl('fos_user_resetting_request'));
    }

    /**
     * show profil user connected.
     *
     * @access public
     * @return void
     */
    public function profilAction()
    {
        /** @var object user */
        $user = $this->container->get('security.context')->getToken()->getUser();
        /** show view */
        return $this->render('CoyoteSiteBundle:Profile:show.html.twig', array('user' => $user));
    }

    /**
     * redirect to accueil if user want edit.
     *
     * @access public
     * @return void
     */
    public function profileditAction()
    {
        /** redirect MainController:indexAction */
        return $this->redirect($this->generateUrl('main_accueil'));
    }

    /**
     * show index to choose month and year to extract data design office users.
     *
     * @access public
     * @return void
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
            return $this->redirect($this->generateUrl('main_accueil'));
    }

    /**
     * export data design office users.
     *
     * @access public
     * @return void
     */
    public function exportDataUserAction()
    {
        /** check role */
        if($this->get('security.context')->isGranted('ROLE_CHEF_BE'))
        {
            /** @var $em object doctrine request */
            $em = $this->getDoctrine()->getManager();
            /** @var $request object request */
            $request = Request::createFromGlobals();
            /** @var $data array data request */
            $data_request = $request->request->all();
            /** check @var data */
            if($data_request == null)
                /** show view */
                return $this->render('CoyoteSiteBundle:Admin:index_export.html.twig');
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
            /** redirect MainController:indexAction */
            return $this->redirect($this->generateUrl('main_accueil'));

    }

    /**
     * function registrer user.
     *
     * @access public
     * @param Request $request
     * @return void
     */
    public function registerAction(Request $request)
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

}