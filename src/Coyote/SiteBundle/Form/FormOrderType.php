<?php

namespace Coyote\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Coyote\SiteBundle\Form\DeliveryAddress;

class FormOrderType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('created_at','date', array(
                'widget' => 'choice',
                'format' => 'd/M/y',              
                ))
            ->add('transport')
            ->add('user', new UserType())
            ->add('deliveryaddress', new DeliveryAddressType())
            //->add('item', new ItemType())
            /*->add('item', 'collection', array('type' => new ItemType(),
                                              'allow_add' => true,
                                              'allow_delete' => true,
                                              ))*/
            //->add('amount')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Coyote\SiteBundle\Entity\FormOrder'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'coyote_sitebundle_formorder';
    }
}
