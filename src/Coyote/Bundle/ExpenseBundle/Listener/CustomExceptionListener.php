<?php
namespace Coyote\SiteBundle\Listener;
 
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bundle\TwigBundle\TwigEngine;
 
class CustomExceptionListener
{
     
    /**
     * @var TwigEngine
     */
    protected $templating;
    /**
     * @param ContainerInterface $container
     */
    public function __construct(TwigEngine $templating){
        // assign value(s)
     
        $this->templating = $templating;
    }
     
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        // nous récupérons l'objet exception depuis l'évènement reçu
        $exception = $event->getException();
        $code = "404";
         
         
        $message = $this->templating->render('CoyoteSiteBundle:Exception:error.html.twig',
                array(
                        'status_code'    => $code,
                        'status_text'    => Response::$statusTexts[$code],
                        'status_text'    => $code,
                        'exception'      => $exception,
                        'logger'         => null,
                        'currentContent' => '',
                ));
        // personnalise notre objet réponse pour afficher les détails de notre exception
        $response = new Response($message, $code);
 
     
        $event->setResponse($response);
    }
}