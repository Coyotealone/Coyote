<?php

namespace Coyote\Bundle\ExpenseBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * SiteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SiteRepository extends EntityRepository
{
    public function getSitesaboutRoles($roles)
    {
        $sites = $this->createQueryBuilder('s')
                    ->where("s.roles IN (:roles)")
                    ->setParameter('roles', $roles)
                    ->getQuery()->getResult();
        return $sites;
        return $this->findBy(array(), array('roles' => $roles));
    }
}
