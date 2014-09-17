<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Roues
 */
class Roues
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
    private $indice_charge;

    /**
     * @var integer
     */
    private $percage_roue;

    /**
     * @var integer
     */
    private $deport_jante;

    /**
     * @var integer
     */
    private $diametre;

    /**
     * @var integer
     */
    private $largeur;

    /**
     * @var float
     */
    private $pression;

    /**
     * @var integer
     */
    private $charge_max_25;

    /**
     * @var integer
     */
    private $charge_max_40;

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
     * @return Roues
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
     * @return Roues
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
     * Set indice_charge
     *
     * @param string $indiceCharge
     * @return Roues
     */
    public function setIndiceCharge($indiceCharge)
    {
        $this->indice_charge = $indiceCharge;

        return $this;
    }

    /**
     * Get indice_charge
     *
     * @return string 
     */
    public function getIndiceCharge()
    {
        return $this->indice_charge;
    }

    /**
     * Set percage_roue
     *
     * @param integer $percageRoue
     * @return Roues
     */
    public function setPercageRoue($percageRoue)
    {
        $this->percage_roue = $percageRoue;

        return $this;
    }

    /**
     * Get percage_roue
     *
     * @return integer 
     */
    public function getPercageRoue()
    {
        return $this->percage_roue;
    }

    /**
     * Set deport_jante
     *
     * @param integer $deportJante
     * @return Roues
     */
    public function setDeportJante($deportJante)
    {
        $this->deport_jante = $deportJante;

        return $this;
    }

    /**
     * Get deport_jante
     *
     * @return integer 
     */
    public function getDeportJante()
    {
        return $this->deport_jante;
    }

    /**
     * Set diametre
     *
     * @param integer $diametre
     * @return Roues
     */
    public function setDiametre($diametre)
    {
        $this->diametre = $diametre;

        return $this;
    }

    /**
     * Get diametre
     *
     * @return integer 
     */
    public function getDiametre()
    {
        return $this->diametre;
    }

    /**
     * Set largeur
     *
     * @param integer $largeur
     * @return Roues
     */
    public function setLargeur($largeur)
    {
        $this->largeur = $largeur;

        return $this;
    }

    /**
     * Get largeur
     *
     * @return integer 
     */
    public function getLargeur()
    {
        return $this->largeur;
    }

    /**
     * Set pression
     *
     * @param float $pression
     * @return Roues
     */
    public function setPression($pression)
    {
        $this->pression = $pression;

        return $this;
    }

    /**
     * Get pression
     *
     * @return float 
     */
    public function getPression()
    {
        return $this->pression;
    }

    /**
     * Set charge_max_25
     *
     * @param integer $chargeMax25
     * @return Roues
     */
    public function setChargeMax25($chargeMax25)
    {
        $this->charge_max_25 = $chargeMax25;

        return $this;
    }

    /**
     * Get charge_max_25
     *
     * @return integer 
     */
    public function getChargeMax25()
    {
        return $this->charge_max_25;
    }

    /**
     * Set charge_max_40
     *
     * @param integer $chargeMax40
     * @return Roues
     */
    public function setChargeMax40($chargeMax40)
    {
        $this->charge_max_40 = $chargeMax40;

        return $this;
    }

    /**
     * Get charge_max_40
     *
     * @return integer 
     */
    public function getChargeMax40()
    {
        return $this->charge_max_40;
    }

    /**
     * Set prix_ht
     *
     * @param integer $prixHt
     * @return Roues
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
     * @return Roues
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
     * @return Roues
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
