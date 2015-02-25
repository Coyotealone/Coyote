<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Country
 * @author Coyote
 * @ORM\Entity
 *
 */
class Country
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * 
     * @var integer
     * 
     * @ORM\Column(name="code", type="integer", unique=true, options={"unsigned":true})
     */
    private $code;

    /**
     * 
     * @var string
     * @ORM\Column(name="alpha2", type="string", length=2, unique=true)
     */
    private $alpha2;
    
    /**
     *
     * @var string
     * @ORM\Column(name="alpha3", type="string", length=3, unique=true)
     */
    private $alpha3;
    
    /**
     * 
     * @var string
     * @ORM\Column(name="entitledgb", type="string", length=45)
     */
    private $entitledgb;


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
}
