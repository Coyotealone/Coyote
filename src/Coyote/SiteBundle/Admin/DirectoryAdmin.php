<?php

namespace Coyote\SiteBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class DirectoryAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('firstname')
            ->add('job_phone_number')
            ->add('quick_phone_number')
            ->add('cellphone_number')
            ->add('country')
            ->add('mail')
            ->add('function_service')
            ->add('leader')
            ->add('created_at')
            ->add('updated_at')
            ->add('enabled')
            ->add('enabled_at')
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
            ->add('firstname')
            //->add('job_phone_number')
            //->add('quick_phone_number')
            //->add('cellphone_number')
            ->add('country')
            //->add('mail')
            ->add('function_service')
            ->add('leader')
            //->add('created_at')
            //->add('updated_at')
            ->add('enabled')
            //->add('enabled_at')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
            ->add('name')
            ->add('firstname')
            ->add('job_phone_number')
            ->add('quick_phone_number')
            ->add('cellphone_number')
            ->add('country')
            ->add('mail')
            ->add('function_service')
            ->add('leader')
            //->add('created_at')
            //->add('updated_at')
            ->add('enabled')
            //->add('enabled_at')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('firstname')
            ->add('job_phone_number')
            ->add('quick_phone_number')
            ->add('cellphone_number')
            ->add('country')
            ->add('mail')
            ->add('function_service')
            ->add('leader')
            ->add('created_at')
            ->add('updated_at')
            ->add('enabled')
            ->add('enabled_at')
        ;
    }
}