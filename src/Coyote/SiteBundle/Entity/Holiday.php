<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Holiday
 * @author Coyote
 * @ORM\Entity
 * @ORM\Table(name="holiday")
 */
class Holiday
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     * @ORM\Column(name="ca", type="integer", options={"unsigned":true})
     */
    private $ca;

    /**
     * @var integer
     * @ORM\Column(name="cp", type="integer", options={"unsigned":true})
     */
    private $cp;

    /**
     * @var integer
     * @ORM\Column(name="rtt", type="integer", options={"unsigned":true})
     */
    private $rtt;

    /**
     * @var integer
     * @ORM\Column(name="hs", type="integer", options={"unsigned":true})
     */
    private $hs;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false, unique=true)
     */
    private $user;

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
     * Set ca
     *
     * @param integer $ca
     * @return Holiday
     */
    public function setCa($ca)
    {
        $this->ca = $ca;

        return $this;
    }

    /**
     * Get ca
     *
     * @return integer
     */
    public function getCa()
    {
        return $this->ca;
    }

    /**
     * Set cp
     *
     * @param integer $cp
     * @return Holiday
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return integer
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set rtt
     *
     * @param integer $rtt
     * @return Holiday
     */
    public function setRtt($rtt)
    {
        $this->rtt = $rtt;

        return $this;
    }

    /**
     * Get rtt
     *
     * @return integer
     */
    public function getRtt()
    {
        return $this->rtt;
    }

    /**
     * Set hs
     *
     * @param integer $hs
     * @return Holiday
     */
    public function setHs($hs)
    {
        $this->hs = $hs;

        return $this;
    }

    /**
     * Get hs
     *
     * @return integer
     */
    public function getHs()
    {
        return $this->hs;
    }

    /**
     * Set user
     *
     * @param string $user
     * @return Holiday
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }
}
