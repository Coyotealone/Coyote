<?php

namespace Coyote\SiteBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class UserAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('username')
            ->add('email')
            ->add('enabled')
            ->add('locked')
            ->add('roles')
            ->add('id')
            ->add('name')
            ->add('country')
            ->add('phone')
            ->add('cell')
            ->add('fax')
            ->add('website')
            ->add('code_car')
            ->add('registration_car')
            ->add('commercial_code')
            ->add('commercial_service')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('name')
            ->add('username')
            ->add('email')
            ->add('enabled')
            ->add('locked')
            ->add('roles')
            ->add('code_car')
            ->add('registration_car')
            ->add('commercial_code')
            ->add('commercial_service')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
                'attr' => array('class' => 'col-md-2')
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('username')
            ->add('usernameCanonical')
            ->add('email')
            ->add('emailCanonical')
            ->add('enabled')
            ->add('salt')
            ->add('password')
            ->add('lastLogin')
            ->add('locked')
            ->add('expired')
            ->add('expiresAt')
            ->add('confirmationToken')
            ->add('passwordRequestedAt')
            ->add('roles')
            ->add('credentialsExpired')
            ->add('credentialsExpireAt')
            ->add('id')
            ->add('name')
            ->add('address1')
            ->add('address2')
            ->add('zip_code')
            ->add('postal_box')
            ->add('city')
            ->add('country')
            ->add('phone')
            ->add('cell')
            ->add('fax')
            ->add('website')
            ->add('code_car')
            ->add('registration_car')
            ->add('commercial_code')
            ->add('commercial_service')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('username')
            ->add('usernameCanonical')
            ->add('email')
            ->add('emailCanonical')
            ->add('enabled')
            ->add('salt')
            ->add('password')
            ->add('lastLogin')
            ->add('locked')
            ->add('expired')
            ->add('expiresAt')
            ->add('confirmationToken')
            ->add('passwordRequestedAt')
            ->add('roles')
            ->add('credentialsExpired')
            ->add('credentialsExpireAt')
            ->add('id')
            ->add('name')
            ->add('address1')
            ->add('address2')
            ->add('zip_code')
            ->add('postal_box')
            ->add('city')
            ->add('country')
            ->add('phone')
            ->add('cell')
            ->add('fax')
            ->add('website')
            ->add('code_car')
            ->add('registration_car')
            ->add('commercial_code')
            ->add('commercial_service')
        ;
    }
}
