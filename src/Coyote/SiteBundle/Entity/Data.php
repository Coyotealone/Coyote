<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Data
 */
class Data
{
    private $tab_month = array( 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre',
                'Octobre', 'Novembre', 'Décembre' );
    private $tab_year = array( '2013', '2014', '2015');
    private $tab_num_month = array( '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12' );
    private $tab_user_id_BE = array(14, 17, 41, 44, 45, 46, 49, 50, 52, 54, 62, 70);

    /**
     * getTabMonth function.
     *
     * @access public
     * @return array()
     */
    public function getTabMonth(){
        return $this->tab_month;
    }

    /**
     * getTabYear function.
     *
     * @access public
     * @return array()
     */
    public function getTabYear(){
        return $this->tab_year;
    }

    /**
     * getTabNumMonth function.
     *
     * @access public
     * @return array()
     */
    public function getTabNumMonth(){
        return $this->tab_num_month;
    }

    /**
     * getTabUserIdBE function.
     *
     * @access public
     * @return array()
     */
    public function getTabUserIdBE(){
        return $this->tab_user_id_BE;
    }
}
