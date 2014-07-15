<?php

namespace Coyote\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserInfoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')/*, 'entity', array('class' => 'CoyoteSiteBundle:UserInfo', 'property' => 'name',))*/
            ->add('adress1')
            ->add('adress2')
            ->add('zip_code')
            ->add('postal_box')
            ->add('city')
            ->add('country')
            ->add('phone')
            ->add('cell')
            ->add('fax')
            ->add('email')
            ->add('website')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Coyote\SiteBundle\Entity\UserInfo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'coyote_sitebundle_userinfo';
    }
}
