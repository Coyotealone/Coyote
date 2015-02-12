<?php

namespace Coyote\SiteBundle\Form\Factory;


interface FactoryInterface
{
    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createForm();
}
