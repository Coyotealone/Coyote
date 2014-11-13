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
    public function exportExpenseAction()
    {
        if($this->get('security.context')->isGranted('ROLE_COMPTA'))
        {
            $date = date("Ymd");
            $heure = date("His");
            $filename = "export".$date."-".$heure.".csv";
            $em = $this->getDoctrine()->getManager();
            $dataexpense = $em->getRepository('CoyoteSiteBundle:Expense')->findforCompta();
            $em->getRepository('CoyoteSiteBundle:Expense')->updateStatus($em);
            return new Response($dataexpense, 200, array(
                'Content-Type' => 'application/force-download',
                'Content-Disposition' => 'attachment; filename="'.$filename.'"'
            ));
        }
        else
            return $this->redirect($this->generateUrl('accueil'));
    }

    public function changePasswordAction()
    {
        return $this->redirect($this->generateUrl('fos_user_change_password'));
    }

    public function resettingAction()
    {
        //$message = \Swift_Message::newInstance()
        //->setSubject('Hello Email')
        //->setFrom('provinianthony@gmail.com')
        //->setTo('si@pichonindustries.com')
        //->setBody($this->renderView('CoyoteSiteBundle:Admin:email.txt.twig', array('name' => 'Anthony')));
        //$this->get('mailer')->send($message);
        //return new Response('mail envoyé');
        return $this->redirect($this->generateUrl('fos_user_resetting_request'));
    }

    public function profilAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        return $this->render('CoyoteSiteBundle:Profile:show.html.twig', array('user' => $user));
    }

    public function profileditAction()
    {
        return $this->redirect($this->generateUrl('accueil'));
    }

    public function showexportAction()
    {
        if($this->get('security.context')->isGranted('ROLE_CHEF_BE'))
        {
            return $this->render('CoyoteSiteBundle:Admin:index_export.html.twig');
        }
        else
            return $this->redirect($this->generateUrl('accueil'));
    }

    public function exportDataUserAction()
    {
        if($this->get('security.context')->isGranted('ROLE_CHEF_BE'))
        {
            $doctrine = $this->getDoctrine();
            $em = $doctrine->getManager();
            $tabuserid = array(14, 17, 41, 44, 45, 46, 49, 50, 52, 54, 62, 70);

            $request = Request::createFromGlobals();
            $data = $request->request->all();
            if($data == null)
                return $this->render('CoyoteSiteBundle:Admin:index_export.html.twig');
            else
            {
                $date = $data['mois'].'/'.$data['annee'];
                $year = $data['annee'];

                $result = '';
                for($i=0;$i<count($tabuserid);$i++)
                {
                    $user = $tabuserid[$i]; //$date = '06/2014'; $year = 2014;
                    $datauser = $em->getRepository('CoyoteSiteBundle:User')->find($user);
                    $user_name = $datauser->getName();
                    $res_temp = $em->getRepository('CoyoteSiteBundle:Schedule')->findforBE($user, $date, $year, $user_name);
                    $result .= $res_temp;
                }
                $filename = 'datauser'.$date.'.csv';

                return new Response($result, 200, array(
                    'Content-Type' => 'application/force-download',
                    'Content-Disposition' => 'attachment; filename="'.$filename.'"'
                ));
            }
        }
        else
            return $this->redirect($this->generateUrl('accueil'));

    }

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