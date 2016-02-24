<?php 

namespace Coyote\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('email',      'email')
          ->add('subject',     'text')
          ->add('content', 'textarea')
          ;
    }
    
    public function getName()
    {
        return 'contact';
    }
}