<?php

namespace Coyote\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')/*, 'entity', array('class' => 'CoyoteSiteBundle:UserInfo', 'property' => 'name',))*/
            ->add('address1')
            ->add('address2', 'text', array('required'  => false,))
            ->add('zip_code')
            ->add('postal_box', 'text', array('required'  => false,))
            ->add('city')
            ->add('country')
            ->add('phone', 'text', array('required'  => false,))
            ->add('cell', 'text', array('required'  => false,))
            ->add('fax', 'text', array('required'  => false,))
            ->add('email')
            ->add('website','text', array('required'  => false,))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Coyote\SiteBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'coyote_sitebundle_user';
    }
}
