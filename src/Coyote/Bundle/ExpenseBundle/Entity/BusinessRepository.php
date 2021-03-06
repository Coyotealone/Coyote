<?php

namespace Coyote\Bundle\ExpenseBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * BusinessRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BusinessRepository extends EntityRepository
{

    /**
     * findAllOrderByName function.
     * function to find all entity business order by name
     *
     * @access public
     * @param order by name ASC
     * @return array Business
     */
    public function findAllOrderByName()
    {
        return $this->findBy(array(), array('name' => 'ASC'));
    }
}
