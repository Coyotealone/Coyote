<?php

namespace Coyote\Bundle\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Coyote\Bundle\FrontBundle\Form\ContactType;
/**
 * Contact controller.
 *
 */
class ContactController extends Controller
{
    /**
     * Function to create a new Form Contact.
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putContactAction()
    {
        $form = $this->get('form.factory')->create(new ContactType());
        $request = $this->get('request');
        if ($request->getMethod() == 'POST')
        {
            $request = Request::createFromGlobals();
            $data = $request->request->all();
            $message = \Swift_Message::newInstance()
                ->setContentType('text/html')
                ->setSubject($data['contact']['subject'])
                ->setFrom($data['contact']['email'])
                ->setTo('si@pichonindustries.com')
                ->setBody($data['contact']['content']);
            $this->get('mailer')->send($message);

            $message = 'contact.message';
            $this->get('session')->getFlashBag()->set('sendmessage',
                $message);
        }
        return $this->render('CoyoteFrontBundle:Contact:contact.html.twig',
                array('form' => $form->createView(),));
    }
}