<?php

namespace Coyote\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AbsenceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('travel','checkbox', array('required'  => false))
            ->add('absence_name', 'text', array('required'  => false))
            ->add('absence_duration', 'text', array('required'  => false))
            ->add('comment', 'text', array('required'  => false))
            ->add('timetable')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Coyote\SiteBundle\Entity\Schedule'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'coyote_sitebundle_schedule';
    }
}
