<?php

namespace Coyote\SiteBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ScheduleAdmin extends Admin
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
            ->add('user')
            ->add('timetable')
            ->add('start')
            ->add('end')
            ->add('break')
            ->add('working_time')
            ->add('working_hours')
            ->add('travel')
            ->add('absence')
            ->add('comment')
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('user')
            ->add('timetable')
            ->add('start')
            ->add('end')
            ->add('break')
            ->add('working_time')
            ->add('working_hours')
            ->add('travel')
            ->add('absence')
            ->add('comment')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('user')
            ->add('timetable')
            ->add('start')
            ->add('end')
            ->add('break')
            ->add('working_time')
            ->add('working_hours')
            ->add('travel')
            ->add('absence')
            ->add('comment')
        ;
    }
}