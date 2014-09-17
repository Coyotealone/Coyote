<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AllItems
 */
class AllItems
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
     * @var string
     */
    private $long_cuve;

    /**
     * @var string
     */
    private $puissance;

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
     * @var string
     */
    private $largeur_travail;

    /**
     * @var string
     */
    private $dents;

    /**
     * @var string
     */
    private $roues;

    /**
     * @var string
     */
    private $largeur_hors_tout;

    /**
     * @var string
     */
    private $taille_frein;

    /**
     * @var string
     */
    private $modele;


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
     * @return AllItems
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
     * @return AllItems
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
     * Set prix_ht
     *
     * @param string $prixHt
     * @return AllItems
     */
    public function setPrixHt($prixHt)
    {
        $this->prix_ht = $prixHt;

        return $this;
    }

    /**
     * Get prix_ht
     *
     * @return string 
     */
    public function getPrixHt()
    {
        return $this->prix_ht;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return AllItems
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
     * @return AllItems
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

    /**
     * Set dia_cuve
     *
     * @param integer $diaCuve
     * @return AllItems
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
     * @return AllItems
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
     * @return AllItems
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
     * @param string $longCuve
     * @return AllItems
     */
    public function setLongCuve($longCuve)
    {
        $this->long_cuve = $longCuve;

        return $this;
    }

    /**
     * Get long_cuve
     *
     * @return string 
     */
    public function getLongCuve()
    {
        return $this->long_cuve;
    }

    /**
     * Set puissance
     *
     * @param string $puissance
     * @return AllItems
     */
    public function setPuissance($puissance)
    {
        $this->puissance = $puissance;

        return $this;
    }

    /**
     * Get puissance
     *
     * @return string 
     */
    public function getPuissance()
    {
        return $this->puissance;
    }

    /**
     * Set indice_charge
     *
     * @param string $indiceCharge
     * @return AllItems
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
     * @return AllItems
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
     * @return AllItems
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
     * @return AllItems
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
     * @return AllItems
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
     * @return AllItems
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
     * @return AllItems
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
     * @return AllItems
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
     * Set largeur_travail
     *
     * @param string $largeurTravail
     * @return AllItems
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
     * @return AllItems
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
     * Set roues
     *
     * @param string $roues
     * @return AllItems
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
     * @return AllItems
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
     * Set taille_frein
     *
     * @param string $tailleFrein
     * @return AllItems
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
     * @return AllItems
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
}
