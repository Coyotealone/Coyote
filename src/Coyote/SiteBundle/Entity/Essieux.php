<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Essieux
 */
class Essieux
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
    private $roues;

    /**
     * @var string
     */
    private $largeur_hors_tout;

    /**
     * @var integer
     */
    private $prix_ht;

    /**
     * @var string
     */
    private $taille_frein;

    /**
     * @var string
     */
    private $modele;

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
     * @return Essieux
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
     * @return Essieux
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
     * Set roues
     *
     * @param string $roues
     * @return Essieux
     */
    public function setRoues($roues)
    {
        $this->roues = $roues;

        return $this;
    }

    /**
     * Get roues
     *
     * @return string 
     */
    public function getRoues()
    {
        return $this->roues;
    }

    /**
     * Set largeur_hors_tout
     *
     * @param string $largeurHorsTout
     * @return Essieux
     */
    public function setLargeurHorsTout($largeurHorsTout)
    {
        $this->largeur_hors_tout = $largeurHorsTout;

        return $this;
    }

    /**
     * Get largeur_hors_tout
     *
     * @return string 
     */
    public function getLargeurHorsTout()
    {
        return $this->largeur_hors_tout;
    }

    /**
     * Set prix_ht
     *
     * @param integer $prixHt
     * @return Essieux
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
     * Set taille_frein
     *
     * @param string $tailleFrein
     * @return Essieux
     */
    public function setTailleFrein($tailleFrein)
    {
        $this->taille_frein = $tailleFrein;

        return $this;
    }

    /**
     * Get taille_frein
     *
     * @return string 
     */
    public function getTailleFrein()
    {
        return $this->taille_frein;
    }

    /**
     * Set modele
     *
     * @param string $modele
     * @return Essieux
     */
    public function setModele($modele)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get modele
     *
     * @return string 
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Essieux
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
     * @return Essieux
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
