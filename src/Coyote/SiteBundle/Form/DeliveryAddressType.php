<?php

namespace Coyote\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DeliveryAddressType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('corporate_name', 'text', array('required'  => false,))
            ->add('name')
            ->add('adress1')
            ->add('adress2', 'text', array('required'  => false,))
            ->add('zip_code')
            ->add('postal_box', 'text', array('required'  => false,))
            ->add('city')
            ->add('country', 'text', array('required'  => false,))
            ->add('phone', 'text', array('required'  => false,))
            ->add('cell', 'text', array('required'  => false,))
            ->add('fax', 'text', array('required'  => false,))
            ->add('email')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Coyote\SiteBundle\Entity\DeliveryAddress'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'coyote_sitebundle_deliveryaddress';
    }
}
