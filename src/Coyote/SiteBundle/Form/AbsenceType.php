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
            ->add('absence_name', 'choice', array(
                    'choices'   => array(
                                    'RTT' => 'schedule.rtt', 
                                    'CP' => 'schedule.cp',
                                    'CA' => 'schedule.ca',
                                    'CSS' => 'schedule.css',
                                    'AT' => 'schedule.at',
                                    'MP' => 'schedule.mp',
                    ),))
            ->add('absence_duration', 'choice', array(
                    'choices'   => array(
                                    '0.5' => '0,5', 
                                    '1' => '1',
                    ),))
            ->add('comment', 'text', array('required'  => false))
            /*->add('timetable', 'date', array(
                            'empty_data' => new \DateTime('now'),
                            'widget' => 'single_text',
                            'input' => 'datetime',
                            'format' => 'yyyy-MM-dd',
                            'attr' => array('class' => 'date'),))*/
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
