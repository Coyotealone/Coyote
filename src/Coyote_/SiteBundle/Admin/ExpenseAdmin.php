<?php

namespace Coyote\SiteBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ExpenseAdmin extends Admin
{
	protected $datagridValues = array(
			'_page' => 1,
			'_sort_order' => 'DESC',
			'_sort_by' => 'id'
	);
	
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
            ->add('date')
            ->add('status', 'checkbox', array('required' => false))
            ->add('amount')
            ->add('amount_TTC')
            ->add('amount_TVA')
            ->add('comment')
            ->add('created_at')
            ->add('updated_at')
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
        ;
    }
}