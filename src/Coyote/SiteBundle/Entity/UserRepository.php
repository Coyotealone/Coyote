<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    public function findAllId()
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u.id')
           ->from('CoyoteSiteBundle:User', 'u')
           ->where('u.locked = 0 and u.enabled = 1 and u.id = 43');
        $user_id = $qb->getQuery()
                      ->getResult();

        return $user_id;
    }
}
