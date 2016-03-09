<?php

namespace Coyote\SiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Coyote\SiteBundle\Form\UserFeesType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'messages'))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'messages'),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',))
            ->add('name', null, array('label' => 'form.name',  'translation_domain' => 'messages'))
            ->add('address1', null, array('label' => 'form.adress1',  'translation_domain' => 'messages', 'data' => 'ZI de Lavallot'))
            ->add('address2', null, array('required' => false, 'label' => 'form.adress2',  'translation_domain' => 'messages'))
            ->add('zip_code', null, array('label' => 'form.zip_code',  'translation_domain' => 'messages', 'data' => '29490'))
            ->add('postal_box', null, array('label' => 'form.postal_box',  'translation_domain' => 'messages', 'data' => 'BP21'))
            ->add('city', null, array('label' => 'form.city',  'translation_domain' => 'messages', 'data' => 'Guipavas'))
            ->add('country', null, array('label' => 'form.country',  'translation_domain' => 'messages', 'data' => 'France'))
            ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'messages', 'data' => '@pichonindustries.com'))
            ->add('phone', null, array('label' => 'form.phone',  'translation_domain' => 'messages', 'data' => '(+33) 02 98 344 100'))
            ->add('cell', null, array('required' => false, 'label' => 'form.cell',  'translation_domain' => 'messages'))
            ->add('fax', null, array('label' => 'form.fax',  'translation_domain' => 'messages', 'data' => '(+33) 02 98 344 120'))
            ->add('website', null, array('label' => 'form.website',  'translation_domain' => 'messages', 'data' => 'www.pichonindustries.com'))
            ->add('roles', 'choice',  array( 'label' => 'form.roles','choices' => array('ROLE_TECH' => 'form.choices.technician',
                'ROLE_CADRE' => 'form.choices.business', 'ROLE_TRADE' => 'form.choices.trade', 'ROLE_VISU' => 'form.choices.directory'),'multiple'  => true))
            ->add('code_car')
            ->add('registration_car')
            ->add('commercial_code')
            ->add('commercial_service');
    }

    /*public function getParent()
    {
        return 'fos_user_registration';
    }*/

    public function getName()
    {
        return 'coyote_site_registration';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Coyote\SiteBundle\Entity\User',
        ));
    }
}