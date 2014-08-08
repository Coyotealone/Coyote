<?php

namespace Coyote\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ExpenseType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', 'text', array(
                'label' => 'Date',
                'label_attr' => array(
                    'class' => 'control-label'
                ),
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => '01/01/14',
                    'title' => 'Date',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'right'
                )
            ))
            ->add('amount', 'number', array('label' => 'Quantité'))
            ->add('amount_TTC', 'number',   array('required' => true,))
            ->add('actual_amount', 'number', array('required' => true,))
            ->add('amount','number', array('required' => true,))
            ->add('currency')
            ->add('site')
            ->add('business')
            ->add('fee')
            ->add('comment', 'text', array('required' => false,))
            ->add('amount_TVA', 'number', array('disabled' => true,))
            ->add('save', 'submit');
            
            /*$builder->add('article', 'entity', array(
  'class'        => 'SdzBlogBundle:Article',
  'property'     => 'titre',
  'querybuilder' => function(\Sdz\BlogBundle\Entity\ArticleRepository $r) {
    return $r->getSelectList();
  }*/
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Coyote\SiteBundle\Entity\Expense'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'coyote_sitebundle_expense';
    }
}
