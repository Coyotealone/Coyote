<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Timetable
 */
class Timetable
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $no_week;

    /**
     * @var integer
     */
    private $year;

    /**
     * @var string
     */
    private $day;

    /**
     * @var string
     */
    private $date;

    /**
     * @var boolean
     */
    private $holiday;

    /**
     * @var string
     */
    private $pay_period;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $schedules;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->schedules = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set no_week
     *
     * @param integer $noWeek
     * @return Timetable
     */
    public function setNoWeek($noWeek)
    {
        $this->no_week = $noWeek;

        return $this;
    }

    /**
     * Get no_week
     *
     * @return integer 
     */
    public function getNoWeek()
    {
        return $this->no_week;
    }

    /**
     * Set year
     *
     * @param integer $year
     * @return Timetable
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set day
     *
     * @param string $day
     * @return Timetable
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return string 
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set date
     *
     * @param string $date
     * @return Timetable
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set holiday
     *
     * @param boolean $holiday
     * @return Timetable
     */
    public function setHoliday($holiday)
    {
        $this->holiday = $holiday;

        return $this;
    }

    /**
     * Get holiday
     *
     * @return boolean 
     */
    public function getHoliday()
    {
        return $this->holiday;
    }

    /**
     * Set pay_period
     *
     * @param string $payPeriod
     * @return Timetable
     */
    public function setPayPeriod($payPeriod)
    {
        $this->pay_period = $payPeriod;

        return $this;
    }

    /**
     * Get pay_period
     *
     * @return string 
     */
    public function getPayPeriod()
    {
        return $this->pay_period;
    }

    /**
     * Add schedules
     *
     * @param \Coyote\SiteBundle\Entity\Schedule $schedules
     * @return Timetable
     */
    public function addSchedule(\Coyote\SiteBundle\Entity\Schedule $schedules)
    {
        $this->schedules[] = $schedules;

        return $this;
    }

    /**
     * Remove schedules
     *
     * @param \Coyote\SiteBundle\Entity\Schedule $schedules
     */
    public function removeSchedule(\Coyote\SiteBundle\Entity\Schedule $schedules)
    {
        $this->schedules->removeElement($schedules);
    }

    /**
     * Get schedules
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSchedules()
    {
        return $this->schedules;
    }
    
    public function second_to_hour($time)// Transformation d'un temps en seconde en H:M
    {
        if($time == '0')
            return '0:00';
        else
        {
            $ss = $time % 60;
            $m = ($time - $ss) / 60;
            $mm = $m % 60;
            $hh = ($m - $mm) / 60;
            if($ss=='0')
            	$ss = '00';
            if($mm == '0')
            	$mm = '00';
            if($mm < '10' && $mm > '0')
            	$mm = '0'.$mm;
            $restime = $hh.':'.$mm;
            return $restime;
    	}
    }
    
    public function hour_to_second($time)// Transformation d'un temps en H:M en seconde
    {
    	$timesec = explode(':', $time);
    	if(count($timesec) < 2)
    	    return "0";
    	if(is_numeric($timesec[0]) && is_numeric($timesec[1]))
    	{
    	    $sec = 3600*$timesec[0] + 60*$timesec[1];
            return $sec;
        }
        else
            return "0";
    }

    public function working_time_day($start, $end, $break)// Calcul du temps de travail
    {
    	if(empty($start) and empty($end) and empty($break))
    		return "0:00";
    	if($start== "00:00" and $end == "00:00" and $break == "00:00")
    		return "0:00";
    	if($start== "0:00" and $end == "0:00" and $break == "0:00")
    		return "0:00";
    	else
    	{
    		if(empty($end))
    			$end = "24:00";
    		if($end == "0:00")
    			$end = "24:00";
    		if($end == "00:00")
    			$end = "24:00";
    		$timestart = $this->hour_to_second($start);
    		$timeend = $this->hour_to_second($end);
    		$timebreak = $this->hour_to_second($break);
    		
    		$worktime = $timeend-$timestart;
    		$worktime = $worktime-$timebreak;
    		if($worktime == "0")
    		    return "0:00";
            else
    		    $worktime = $this->second_to_hour($worktime);
    		return  $worktime;
    	}
    }

    public function working_hours_day($worktime)// Calcul de la journée de travail
    {
    	if($worktime == "00:00" || $worktime == "0:00")
    		return 0;

    	$worktime = $this->hour_to_second($worktime);
    	
    	$timeday = $worktime;
    	if($timeday <= 0)
    		$timeday = 0;
    	if($timeday > 0 && $timeday <= 12600)
    		$timeday = 0.5;
    	else
    		$timeday = 1;
    	return $timeday;
    }

    function working_time_week($time1, $time2, $time3, $time4, $time5, $time6, $time7)
    {
    	$timetotsec = $time1 + $time2 + $time3 + $time4 + $time5 + $time6 + $time7;
    	$ss = $timetotsec % 60;
    	$m = ($timetotsec - $ss) / 60;
    	$mm = $m % 60;
    	$hh = ($m - $mm) / 60;
    	if($mm == '0')
    		$mm = '00';
    	$restime = $hh.':'.$mm;
    	return $restime;
    }
    
    public function __toString()
    {
        return $this->date;
    }
}
