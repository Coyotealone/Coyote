<?php

namespace Coyote\SiteBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class FosUserAdmin extends Admin
{
    // setup the default sort column and order
    protected $datagridValues = array(
        '_sort_order' => 'ASC',
        '_sort_by' => 'id'
    );

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        //$tokenGenerator = $this->container->('fos_user.util.token_generator');
        //$user->setConfirmationToken($tokenGenerator->generateToken());
        $salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $formMapper
            //->add('id')
            ->add('username')
            ->add('password')
            ->add('name')
            ->add('adress1')
            ->add('adress2', 'text', array('required' => false))
            ->add('zip_code')
            ->add('postal_box', 'text', array('required' => false))
            ->add('city')
            ->add('country')
            ->add('email')
            ->add('phone', 'text', array('required' => false))
            ->add('cell', 'text', array('required' => false))
            ->add('fax', 'text', array('required' => false))
            ->add('enabled', 'checkbox', array('required' => false))
            ->add('locked', 'checkbox', array('required' => false))
            ->add('expired', 'checkbox', array('required' => false))
            ->add('salt', 'text', array('label' => $salt))
            ->add('roles')
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('username')
            ->add('email')
            ->add('enabled')
            ->add('password')
            ->add('locked')
            ->add('expired')
            ->add('roles')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('username')
            ->add('email')
            ->add('enabled')
            #->add('password')
            ->add('locked')
            #->add('expired')
            #->add('roles')
            #->add('last_login')
        ;
    }
}