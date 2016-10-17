<?php

namespace Coyote\Bundle\DirectoryBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class DirectoryAdmin extends AbstractAdmin
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
            ->add('phone')
            ->add('cellphone_number')
            ->add('fax')
            ->add('country')
            ->add('mail')
            ->add('function_service')
            ->add('leader')
            ->add('created_at')
            ->add('updated_at')
            ->add('enabled')
            ->add('enabled_at')
            ->add('business')
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
            ->add('job_phone_number')
            ->add('quick_phone_number')
            ->add('phone')
            ->add('cellphone_number')
            ->add('fax')
            ->add('country')
            ->add('mail')
            ->add('function_service')
            ->add('leader')
            ->add('created_at')
            ->add('updated_at')
            ->add('enabled')
            ->add('enabled_at')
            ->add('business')
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
            ->add('name')
            ->add('firstname')
            ->add('job_phone_number')
            ->add('quick_phone_number')
            ->add('phone')
            ->add('cellphone_number')
            ->add('fax')
            ->add('country')
            ->add('mail')
            ->add('function_service')
            ->add('leader')
            ->add('enabled')
            ->add('business')
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
            ->add('phone')
            ->add('cellphone_number')
            ->add('fax')
            ->add('country')
            ->add('mail')
            ->add('function_service')
            ->add('leader')
            ->add('created_at')
            ->add('updated_at')
            ->add('enabled')
            ->add('enabled_at')
            ->add('business')
        ;
    }
}
