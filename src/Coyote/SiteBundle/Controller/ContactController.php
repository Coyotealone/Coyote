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
        $form = $this->get('form.factory')->create(new ContactType());
         // Get the request
        $request = $this->get('request');
        // Check the method
        if($request->getMethod() == 'POST')
        {
            $request = Request::createFromGlobals();
            $data = $request->request->all();
            //$data['subject'] $data['content']
            return new Response($data);
            $message = \Swift_Message::newInstance()
                ->setContentType('text/html')
                ->setSubject($data['subject'])
                ->setFrom($data['email'])
                ->setTo('xxxxx@gmail.com')
                ->setBody($data['content']);
            //$this->get('mailer')->send($message);
            // Launch the message flash
            $this->get('session')->setFlash('notice', 'Merci de nous avoir contacté, nous répondrons à vos questions dans les plus brefs délais.');
        }
        
        return $this->render('CoyoteSiteBundle:Contact:contact.html.twig',
                array(
                    'form' => $form->createView(),
                ));
        
        /*$form = $this->get('form.factory')->create(new ContactType());
        
        if ($form->isValid())
        {
            return new Response('données');   
            // Bind value with form
            $form->bindRequest($request);
            $data = $form->getData();
            $message = \Swift_Message::newInstance()
                ->setContentType('text/html')
                ->setSubject($data['subject'])
                ->setFrom($data['email'])
                ->setTo('xxxxx@gmail.com')
                ->setBody($data['content']);
            $this->get('mailer')->send($message);
            // Launch the message flash
            $this->get('session')->setFlash('notice', 'Merci de nous avoir contacté, nous répondrons à vos questions dans les plus brefs délais.');
        }
        return $this->render('CoyoteSiteBundle:Contact:contact.html.twig', array(
                    'form' => $form->createView(),
                ));*/
    }
}