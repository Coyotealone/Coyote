<?php

namespace Coyote\SiteBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ExpenseAdmin extends Admin
{
    // setup the default sort column and order
    protected $datagridValues = array(
        '_sort_order' => 'ASC',
        '_sort_by' => 'id'
    );

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('site')
            ->add('currency')
            ->add('business')
            ->add('fee')
            ->add('userfees')
            ->add('date')
            ->add('status', 'checkbox', array('required' => false))
            ->add('amount')
            ->add('actual_amount')
            ->add('amount_TTC')
            ->add('amount_TVA')
            ->add('comment', 'text', array('required' => false))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('site')
            ->add('currency')
            ->add('business')
            ->add('fee')
            ->add('userfees')
            ->add('date')
            ->add('status')
            ->add('amount')
            ->add('actual_amount')
            ->add('amount_TTC')
            ->add('amount_TVA')
            ->add('comment')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('site')
            ->add('currency')
            ->add('business')
            ->add('fee')
            ->add('userfees')
            ->add('date')
            ->add('status')
            ->add('amount')
            ->add('actual_amount')
            ->add('amount_TTC')
            ->add('amount_TVA')
            ->add('comment')
        ;
    }
}