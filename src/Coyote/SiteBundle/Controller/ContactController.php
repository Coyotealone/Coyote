<?php

namespace Coyote\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Compenent\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Session\Session;

use Doctrine\ORM\EntityRepository;

use Coyote\SiteBundle\Form\ContactType;
/**
 * Contact controller.
 *
 */
class ContactController extends Controller
{
    public function indexAction()
    {
        /** @var $form form Contact */
        $form = $this->get('form.factory')->create(new ContactType());
         // Get the request
        $request = $this->get('request');
        // Check the method
        if($request->getMethod() == 'POST')
        {
            $request = Request::createFromGlobals();
            $data = $request->request->all();
            /** @var $message prepare swift_message*/
            $message = \Swift_Message::newInstance()
                ->setContentType('text/html')
                ->setSubject($data['contact']['subject'])
                ->setFrom($data['contact']['email'])
                ->setTo('si@pichonindustries.com')
                ->setBody($data['contact']['content']);
            /** send mail */
            $this->get('mailer')->send($message);
            /** Lauch the message flash*/
            $this->get('session')->getFlashBag()->set('sendmessage',
                'Merci de nous avoir contacté, nous répondrons à vos questions dans les plus brefs délais.');
        }
        /** show view */
        return $this->render('CoyoteSiteBundle:Contact:contact.html.twig',
                array('form' => $form->createView(),));
    }
}