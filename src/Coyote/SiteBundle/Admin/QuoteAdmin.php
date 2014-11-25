<?php

namespace Coyote\SiteBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class QuoteAdmin extends Admin
{
    // setup the default sort column and order
    protected $datagridValues = array(
        '_sort_order' => 'ASC',
        '_sort_by' => 'id'
    );

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        //$tokenGenerator = $this->container->('fos_user.util.token_generator');
        //$user->setConfirmationToken($tokenGenerator->generateToken());
        $salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $formMapper
            //->add('id')
            ->add('citation')
            ->add('author')
            ->add('week')
            ->add('year')
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('citation')
            ->add('author')
            ->add('week')
            ->add('year')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('citation')
            ->add('author')
            ->add('week')
            ->add('year')
        ;
    }
}