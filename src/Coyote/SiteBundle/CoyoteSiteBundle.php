<?php

namespace Coyote\SiteBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CoyoteSiteBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
