<?php

namespace Coyote\Bundle\ExpenseBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ExpenseAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('date')
            ->add('status')
            ->add('amount')
            ->add('amount_TTC')
            ->add('amount_TVA')
            ->add('comment')
            ->add('created_at')
            ->add('updated_at')
            ->add('user')
            ->add('fee')
            ->add('currency')
            ->add('site')
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
            ->add('date')
            ->add('status')
            ->add('amount')
            ->add('amount_TTC')
            ->add('amount_TVA')
            ->add('comment')
            ->add('created_at')
            ->add('updated_at')
            ->add('user')
            ->add('fee')
            ->add('currency')
            ->add('site')
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
            ->add('date')
            ->add('status')
            ->add('amount')
            ->add('amount_TTC')
            ->add('amount_TVA')
            ->add('comment')
            ->add('created_at')
            ->add('updated_at')
            ->add('user')
            ->add('fee')
            ->add('currency')
            ->add('site')
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
            ->add('date')
            ->add('status')
            ->add('amount')
            ->add('amount_TTC')
            ->add('amount_TVA')
            ->add('comment')
            ->add('created_at')
            ->add('updated_at')
            ->add('user')
            ->add('fee')
            ->add('currency')
            ->add('site')
            ->add('business')
        ;
    }
}
