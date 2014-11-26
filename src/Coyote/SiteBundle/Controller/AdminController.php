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
            /** @var string date yyyymmdd */
            $date = date("Ymd");
            /** @var string heure hhmmss */
            $heure = date("His");
            /** @var string filename txt */
            $filename = "export".$date."-".$heure.".txt";
            /** @var object em doctrine request */
            $em = $this->getDoctrine()->getManager();
            /** @var string dataexpense data file */
            $dataexpense = $em->getRepository('CoyoteSiteBundle:Expense')->findforCompta();
            $em->getRepository('CoyoteSiteBundle:Expense')->updateStatus($em);
            /** @return file txt downloaded with data expense */
            return new Response($dataexpense, 200, array(
                'Content-Type' => 'application/force-download',
                'Content-Disposition' => 'attachment; filename="'.$filename.'"'
            ));
        }
        else
            return $this->redirect($this->generateUrl('accueil'));
    }

    /**
     * redirect to function fos_user_change_password.
     *
     * @access public
     * @return void
     */
    public function changePasswordAction()
    {
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
        return $this->redirect($this->generateUrl('accueil'));
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
            /** @var string month mm */
            $month = date('n');
            /** @var string year yyyy */
            $year = date('Y');
            /** @var array tab_mois */
            $tab_mois = array( 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre' );
            /** @var array tab_num_mois */
            $tab_num_mois = array( '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12' );
            /** @var array tab_annee */
            $tab_annee = array( '2013', '2014', '2015');
            return $this->render('CoyoteSiteBundle:Admin:index_export.html.twig',
                array('month' => $month, 'year' => $year, 'tab_mois' => $tab_mois, 'tab_num_mois' => $tab_num_mois, 'tab_annee' => $tab_annee));
        }
        else
            return $this->redirect($this->generateUrl('accueil'));
    }

    /**
     * export data design office users.
     *
     * @access public
     * @return void
     */
    public function exportDataUserAction()
    {
        if($this->get('security.context')->isGranted('ROLE_CHEF_BE'))
        {
            /** @var object em doctrine request */
            $em = $this->getDoctrine()->getManager();
            /** @var array tabuserid design office users id*/
            $tabuserid = array(14, 17, 41, 44, 45, 46, 49, 50, 52, 54, 62, 70);
            /** @var object request */
            $request = Request::createFromGlobals();
            /** @var array data request */
            $data = $request->request->all();
            /** check @var data */
            if($data == null)
                return $this->render('CoyoteSiteBundle:Admin:index_export.html.twig');
            else
            {
                /** @var string date mm/yyyy */
                $date = $data['month'].'/'.$data['year'];
                /** @var string year yyyy */
                $year = $data['year'];
                /** @var string result */
                $result = '';
                /** file in the text file */
                for($i=0;$i<count($tabuserid);$i++)
                {
                    $user = $tabuserid[$i];
                    $datauser = $em->getRepository('CoyoteSiteBundle:User')->find($user);
                    $user_name = $datauser->getName();
                    $res_temp = $em->getRepository('CoyoteSiteBundle:Schedule')->findforBE($user, $date, $year, $user_name);
                    $result .= $res_temp;
                }/** end for */
                /** @var string filename file name CSV */
                $filename = 'datauser'.$date.'.csv';
                /** @return file csv downloaded with data user schedule */
                return new Response($result, 200, array(
                    'Content-Type' => 'application/force-download',
                    'Content-Disposition' => 'attachment; filename="'.$filename.'"'
                ));
            }
        }
        else
            return $this->redirect($this->generateUrl('accueil'));

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

                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }
        }

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.', array(
            'form' => $form->createView(),
        ));
    }

}