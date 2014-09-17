<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cuves
 */
class Cuves
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
     * @var integer
     */
    private $dia_cuve;

    /**
     * @var string
     */
    private $ep_cuve;

    /**
     * @var string
     */
    private $ep_chassis;

    /**
     * @var integer
     */
    private $long_cuve;

    /**
     * @var integer
     */
    private $prix_ht;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $categorie;


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
     * @return Cuves
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
     * @return Cuves
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
     * Set dia_cuve
     *
     * @param integer $diaCuve
     * @return Cuves
     */
    public function setDiaCuve($diaCuve)
    {
        $this->dia_cuve = $diaCuve;

        return $this;
    }

    /**
     * Get dia_cuve
     *
     * @return integer 
     */
    public function getDiaCuve()
    {
        return $this->dia_cuve;
    }

    /**
     * Set ep_cuve
     *
     * @param string $epCuve
     * @return Cuves
     */
    public function setEpCuve($epCuve)
    {
        $this->ep_cuve = $epCuve;

        return $this;
    }

    /**
     * Get ep_cuve
     *
     * @return string 
     */
    public function getEpCuve()
    {
        return $this->ep_cuve;
    }

    /**
     * Set ep_chassis
     *
     * @param string $epChassis
     * @return Cuves
     */
    public function setEpChassis($epChassis)
    {
        $this->ep_chassis = $epChassis;

        return $this;
    }

    /**
     * Get ep_chassis
     *
     * @return string 
     */
    public function getEpChassis()
    {
        return $this->ep_chassis;
    }

    /**
     * Set long_cuve
     *
     * @param integer $longCuve
     * @return Cuves
     */
    public function setLongCuve($longCuve)
    {
        $this->long_cuve = $longCuve;

        return $this;
    }

    /**
     * Get long_cuve
     *
     * @return integer 
     */
    public function getLongCuve()
    {
        return $this->long_cuve;
    }

    /**
     * Set prix_ht
     *
     * @param integer $prixHt
     * @return Cuves
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

    /**
     * Set type
     *
     * @param string $type
     * @return Cuves
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     * @return Cuves
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
}
