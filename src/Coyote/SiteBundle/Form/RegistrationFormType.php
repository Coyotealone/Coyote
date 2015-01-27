<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationFormType extends AbstractType
{
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'messages'))
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'messages'))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'messages'),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('name', null, array('label' => 'form.name',  'translation_domain' => 'messages'))
            ->add('adress1', null, array('label' => 'form.address1',  'translation_domain' => 'messages'))
            ->add('address2', null, array('label' => 'form.adress2',  'translation_domain' => 'messages'))
            ->add('zip_code', null, array('label' => 'form.zip_code',  'translation_domain' => 'messages'))
            ->add('postal_box', null, array('label' => 'form.postal_box',  'translation_domain' => 'messages'))
            ->add('city', null, array('label' => 'form.city',  'translation_domain' => 'messages'))
            ->add('country', null, array('label' => 'form.country',  'translation_domain' => 'messages'))
            ->add('phone', null, array('label' => 'form.phone',  'translation_domain' => 'messages'))
            ->add('cell', null, array('label' => 'form.cell',  'translation_domain' => 'messages'))
            ->add('fax', null, array('label' => 'form.fax',  'translation_domain' => 'messages'))
            ->add('website', null, array('label' => 'form.website',  'translation_domain' => 'messages'))
            ->add('roles', 'collection', array('label' => 'form.roles', 'translation_domain' => 'messages', 'type' => 'choice',  'options' => array('choices' => array(
                           'ROLE_USER' => 'User',
                           'ROLE_TECH' => 'Tech',
                           'ROLE_CADRE' => 'Cadre' ))))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'intention'  => 'registration',
        ));
    }

    public function getName()
    {
        return 'fos_user_registration';
    }
}
