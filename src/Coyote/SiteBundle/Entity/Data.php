<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Data
 */
class Data
{
    private $tab_month = array( 'month_01', 'month_02', 'month_03', 'month_04', 'month_05', 'month_06', 'month_07', 
    		'month_08', 'month_09', 'month_10', 'month_11', 'month_12');
    private $tab_year = array( '2013', '2014', '2015', '2016');
    private $tab_num_year = array( '2013', '2014', '2015', '2016');
    private $tab_num_month = array( '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12' );
    private $tab_user_id_BE = array(14, 17, 41, 44, 45, 46, 49, 50, 52, 54, 62, 70, 80);
    private $tab_period = array('2014/2015', '2015/2016', '2016/2017');
    private $tab_user_id_schedulePDF = array('2', '4', '6', '9', '10', '13', '14', '15', '16', '17', '18', '40', '41',
    		'43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '58', '61', '62', '70','71', 
    		'80');

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
     * getTabNumYear function.
     *
     * @access public
     * @return array()
     */
    public function getTabNumYear(){
        return $this->tab_num_year;
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

    /**
     * getTabPeriod function.
     *
     * @access public
     * @return array()
     */
    public function getTabPeriod(){
        return $this->tab_period;
    }

    /**
     * getTabUserIdSchedulePDF function.
     *
     * @access public
     * @return array()
     */
    public function getTabUserIdSchedulePDF(){
        return $this->tab_user_id_schedulePDF;
    }
}
