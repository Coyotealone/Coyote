<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfiguringTankers
 */
class ConfiguringTankers
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $amount;

    /**
     * @var string
     */
    private $link;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var \Coyote\SiteBundle\Entity\Country
     */
    private $country;

    /**
     * @var \Coyote\SiteBundle\Entity\Item
     */
    private $item;


    /**
     * Set id
     *
     * @param integer $id
     * @return ConfiguringTankers
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Set amount
     *
     * @param integer $amount
     * @return ConfiguringTankers
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return ConfiguringTankers
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return ConfiguringTankers
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set country
     *
     * @param \Coyote\SiteBundle\Entity\Country $country
     * @return ConfiguringTankers
     */
    public function setCountry(\Coyote\SiteBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Coyote\SiteBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set item
     *
     * @param \Coyote\SiteBundle\Entity\Item $item
     * @return ConfiguringTankers
     */
    public function setItem(\Coyote\SiteBundle\Entity\Item $item = null)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \Coyote\SiteBundle\Entity\Item 
     */
    public function getItem()
    {
        return $this->item;
    }
}
