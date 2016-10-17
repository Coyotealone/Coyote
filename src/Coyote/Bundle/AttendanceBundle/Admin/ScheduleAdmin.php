<?php

namespace Coyote\Bundle\AttendanceBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ScheduleAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('start')
            ->add('end')
            ->add('break')
            ->add('working_time')
            ->add('working_hours')
            ->add('travel')
            ->add('absence_name')
            ->add('absence_duration')
            ->add('comment')
            ->add('locked')
            ->add('locked_by')
            ->add('validated_by')
            ->add('created_at')
            ->add('updated_at')
            ->add('locked_at')
            ->add('date_schedule')
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
            ->add('start')
            ->add('end')
            ->add('break')
            ->add('working_time')
            ->add('working_hours')
            ->add('travel')
            ->add('absence_name')
            ->add('absence_duration')
            ->add('comment')
            ->add('locked')
            ->add('locked_by')
            ->add('validated_by')
            ->add('created_at')
            ->add('updated_at')
            ->add('locked_at')
            ->add('date_schedule')
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
            ->add('start')
            ->add('end')
            ->add('break')
            ->add('working_time')
            ->add('working_hours')
            ->add('travel')
            ->add('absence_name')
            ->add('absence_duration')
            ->add('comment')
            ->add('date_schedule')
            ->add('user')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('start')
            ->add('end')
            ->add('break')
            ->add('working_time')
            ->add('working_hours')
            ->add('travel')
            ->add('absence_name')
            ->add('absence_duration')
            ->add('comment')
            ->add('locked')
            ->add('locked_by')
            ->add('validated_by')
            ->add('created_at')
            ->add('updated_at')
            ->add('locked_at')
            ->add('date_schedule')
            ->add('user')
        ;
    }
}
