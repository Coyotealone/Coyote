<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IndiceCharge
 */
class IndiceCharge
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $indice_charge;

    /**
     * @var integer
     */
    private $charge;

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
     * Set indice_charge
     *
     * @param integer $indiceCharge
     * @return IndiceCharge
     */
    public function setIndiceCharge($indiceCharge)
    {
        $this->indice_charge = $indiceCharge;

        return $this;
    }

    /**
     * Get indice_charge
     *
     * @return integer 
     */
    public function getIndiceCharge()
    {
        return $this->indice_charge;
    }

    /**
     * Set charge
     *
     * @param integer $charge
     * @return IndiceCharge
     */
    public function setCharge($charge)
    {
        $this->charge = $charge;

        return $this;
    }

    /**
     * Get charge
     *
     * @return integer 
     */
    public function getCharge()
    {
        return $this->charge;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return IndiceCharge
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
     * @return IndiceCharge
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
