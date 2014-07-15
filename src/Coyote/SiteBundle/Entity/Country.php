<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 */
class Country
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $code;

    /**
     * @var string
     */
    private $alpha2;

    /**
     * @var string
     */
    private $alpha3;

    /**
     * @var string
     */
    private $entitledfr;

    /**
     * @var string
     */
    private $entitledgb;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $configuring_tankerss;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->configuring_tankerss = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set code
     *
     * @param integer $code
     * @return Country
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set alpha2
     *
     * @param string $alpha2
     * @return Country
     */
    public function setAlpha2($alpha2)
    {
        $this->alpha2 = $alpha2;

        return $this;
    }

    /**
     * Get alpha2
     *
     * @return string 
     */
    public function getAlpha2()
    {
        return $this->alpha2;
    }

    /**
     * Set alpha3
     *
     * @param string $alpha3
     * @return Country
     */
    public function setAlpha3($alpha3)
    {
        $this->alpha3 = $alpha3;

        return $this;
    }

    /**
     * Get alpha3
     *
     * @return string 
     */
    public function getAlpha3()
    {
        return $this->alpha3;
    }

    /**
     * Set entitledfr
     *
     * @param string $entitledfr
     * @return Country
     */
    public function setEntitledfr($entitledfr)
    {
        $this->entitledfr = $entitledfr;

        return $this;
    }

    /**
     * Get entitledfr
     *
     * @return string 
     */
    public function getEntitledfr()
    {
        return $this->entitledfr;
    }

    /**
     * Set entitledgb
     *
     * @param string $entitledgb
     * @return Country
     */
    public function setEntitledgb($entitledgb)
    {
        $this->entitledgb = $entitledgb;

        return $this;
    }

    /**
     * Get entitledgb
     *
     * @return string 
     */
    public function getEntitledgb()
    {
        return $this->entitledgb;
    }

    /**
     * Add configuring_tankerss
     *
     * @param \Coyote\SiteBundle\Entity\ConfiguringTankers $configuringTankerss
     * @return Country
     */
    public function addConfiguringTankerss(\Coyote\SiteBundle\Entity\ConfiguringTankers $configuringTankerss)
    {
        $this->configuring_tankerss[] = $configuringTankerss;

        return $this;
    }

    /**
     * Remove configuring_tankerss
     *
     * @param \Coyote\SiteBundle\Entity\ConfiguringTankers $configuringTankerss
     */
    public function removeConfiguringTankerss(\Coyote\SiteBundle\Entity\ConfiguringTankers $configuringTankerss)
    {
        $this->configuring_tankerss->removeElement($configuringTankerss);
    }

    /**
     * Get configuring_tankerss
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConfiguringTankerss()
    {
        return $this->configuring_tankerss;
    }
    
    public function __toString()
    {
        return $this->alpha2;
    }
}
