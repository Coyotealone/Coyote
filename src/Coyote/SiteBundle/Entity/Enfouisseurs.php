<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enfouisseurs
 */
class Enfouisseurs
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $designation;

    /**
     * @var string
     */
    private $largeur_travail;

    /**
     * @var string
     */
    private $dents;

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
     * @param string $code
     * @return Enfouisseurs
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set designation
     *
     * @param string $designation
     * @return Enfouisseurs
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
     * Set largeur_travail
     *
     * @param string $largeurTravail
     * @return Enfouisseurs
     */
    public function setLargeurTravail($largeurTravail)
    {
        $this->largeur_travail = $largeurTravail;

        return $this;
    }

    /**
     * Get largeur_travail
     *
     * @return string 
     */
    public function getLargeurTravail()
    {
        return $this->largeur_travail;
    }

    /**
     * Set dents
     *
     * @param string $dents
     * @return Enfouisseurs
     */
    public function setDents($dents)
    {
        $this->dents = $dents;

        return $this;
    }

    /**
     * Get dents
     *
     * @return string 
     */
    public function getDents()
    {
        return $this->dents;
    }

    /**
     * Set prix_ht
     *
     * @param integer $prixHt
     * @return Enfouisseurs
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
     * @return Enfouisseurs
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
     * @return Enfouisseurs
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
