<?php

namespace Coyote\Bundle\AttendanceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ScheduleShowType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start')
            ->add('end')
            ->add('break')
            ->add('working_time')
            ->add('working_hours')
            ->add('travel')
            ->add('absence_name')
            ->add('absence_duration')
            ->add('comment')
            ->add('timetable')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Coyote\Bundle\AttendanceBundle\Entity\Schedule'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'coyote_bundle_attendancebundle_schedule';
    }
}
