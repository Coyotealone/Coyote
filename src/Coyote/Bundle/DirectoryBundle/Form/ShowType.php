<?php

namespace Coyote\Bundle\DirectoryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ShowType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('country', 'choice', array(
                    'choices'   => array(
                                    'FRANCE' => 'country.fr',
                                    'POLOGNE' => 'country.pl',
                    ),
                    'label' => 'directory.country', 'translation_domain' => 'messages', 'mapped' => false, 'multiple' => false,
                    'attr' => array('id' => 'country')
                    ))
            ->add('business', 'choice', array(
                    'choices'   => array(
                                    'PICHON' => 'directory.busi.pichon',
                                    'GILIBERT' => 'directory.busi.gilibert',
                                    'PICHON/GILIBERT' => 'directory.busi.pichongilibert',
                    ),
                    'label' => 'directory.business', 'translation_domain' => 'messages', 'mapped' => false, 'multiple' => false,
                    'attr' => array('id'=> 'business')
                    ))
            ->add('orderby', 'choice', array(
                    'choices'   => array(
                                    'alpha' => 'directory.orderby.alpha',
                                    'service' => 'directory.orderby.service',
                    ),
                    'label' => 'directory.orderby.title', 'translation_domain' => 'messages', 'mapped' => false, 'multiple' => false,
                    'attr' => array('id'=> 'orderby')
                    ))
            ->add('save', SubmitType::class, array('label' => 'admin.submit.display', 'attr' => array('class'=>"btn btn-primary")))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Coyote\Bundle\DirectoryBundle\Entity\Directory'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'coyote_directorybundle_show';
    }
}
