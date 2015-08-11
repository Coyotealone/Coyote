<?php

namespace Coyote\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserFeesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login', null, array('label' => 'userfees.login', 'translation_domain' => 'messages'))
            ->add('code', null, array('label' => 'userfees.code', 'translation_domain' => 'messages'))
            ->add('service', null, array('label' => 'userfees.service', 'translation_domain' => 'messages'))
            ->add('car', null, array('label' => 'userfees.car', 'translation_domain' => 'messages'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Coyote\SiteBundle\Entity\UserFees'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'coyote_sitebundle_userfees';
    }
}
