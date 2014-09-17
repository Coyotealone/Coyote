<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DevisConfigurateur
 */
class DevisConfigurateur
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
     * @var integer
     */
    private $qte;

    /**
     * @var integer
     */
    private $no_devis;


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
     * @return DevisConfigurateur
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
     * Set qte
     *
     * @param integer $qte
     * @return DevisConfigurateur
     */
    public function setQte($qte)
    {
        $this->qte = $qte;

        return $this;
    }

    /**
     * Get qte
     *
     * @return integer 
     */
    public function getQte()
    {
        return $this->qte;
    }

    /**
     * Set no_devis
     *
     * @param integer $noDevis
     * @return DevisConfigurateur
     */
    public function setNoDevis($noDevis)
    {
        $this->no_devis = $noDevis;

        return $this;
    }

    /**
     * Get no_devis
     *
     * @return \int 
     */
    public function getNoDevis()
    {
        return $this->no_devis;
    }
    /**
     * @var string
     */
    private $table;


    /**
     * Set table
     *
     * @param string $table
     * @return DevisConfigurateur
     */
    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Get table
     *
     * @return string 
     */
    public function getTable()
    {
        return $this->table;
    }
}
