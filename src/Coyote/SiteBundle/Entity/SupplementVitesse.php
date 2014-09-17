<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SupplementVitesse
 */
class SupplementVitesse
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
    private $designation;

    /**
     * @var string
     */
    private $PTAC;

    /**
     * @var integer
     */
    private $prix_ht;


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
     * @return SupplementVitesse
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
     * Set designation
     *
     * @param string $designation
     * @return SupplementVitesse
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string 
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set PTAC
     *
     * @param string $pTAC
     * @return SupplementVitesse
     */
    public function setPTAC($pTAC)
    {
        $this->PTAC = $pTAC;

        return $this;
    }

    /**
     * Get PTAC
     *
     * @return string 
     */
    public function getPTAC()
    {
        return $this->PTAC;
    }

    /**
     * Set prix_ht
     *
     * @param integer $prixHt
     * @return SupplementVitesse
     */
    public function setPrixHt($prixHt)
    {
        $this->prix_ht = $prixHt;

        return $this;
    }

    /**
     * Get prix_ht
     *
     * @return integer 
     */
    public function getPrixHt()
    {
        return $this->prix_ht;
    }
}
