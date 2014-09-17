<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IndiceVitesse
 */
class IndiceVitesse
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $symobole_vitesse;

    /**
     * @var integer
     */
    private $vitesse;

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
     * Set symobole_vitesse
     *
     * @param string $symoboleVitesse
     * @return IndiceVitesse
     */
    public function setSymoboleVitesse($symoboleVitesse)
    {
        $this->symobole_vitesse = $symoboleVitesse;

        return $this;
    }

    /**
     * Get symobole_vitesse
     *
     * @return string 
     */
    public function getSymoboleVitesse()
    {
        return $this->symobole_vitesse;
    }

    /**
     * Set vitesse
     *
     * @param integer $vitesse
     * @return IndiceVitesse
     */
    public function setVitesse($vitesse)
    {
        $this->vitesse = $vitesse;

        return $this;
    }

    /**
     * Get vitesse
     *
     * @return integer 
     */
    public function getVitesse()
    {
        return $this->vitesse;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return IndiceVitesse
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
     * @return IndiceVitesse
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
