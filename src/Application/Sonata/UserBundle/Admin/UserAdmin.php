<?php

namespace Application\Sonata\UserBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
#use Application\Sonata\UserBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Sonata\UserBundle\Admin\Model\UserAdmin as BaseUserAdmin;

class UserAdmin extends BaseUserAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);
        $formMapper->remove('facebookUid');
        $formMapper->remove('facebookName');
        $formMapper->remove('twitterUid');
        $formMapper->remove('twitterName');
        $formMapper->remove('gplusUid');
        $formMapper->remove('gplusName');
        $formMapper->removeGroup('Social');
    }
}
