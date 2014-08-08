<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 */
class Item
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
     * @var float
     */
    private $price;

    /**
     * @var string
     */
    private $designation1;

    /**
     * @var string
     */
    private $designation2;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $configuring_tankerss;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $offer_contents;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $formorders;

    /**
     * @var \Coyote\SiteBundle\Entity\InfoItem
     */
    private $infoitem;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->configuring_tankerss = new \Doctrine\Common\Collections\ArrayCollection();
        $this->offer_contents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->formorders = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set code
     *
     * @param string $code
     * @return Item
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
     * Set price
     *
     * @param float $price
     * @return Item
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set designation1
     *
     * @param string $designation1
     * @return Item
     */
    public function setDesignation1($designation1)
    {
        $this->designation1 = $designation1;

        return $this;
    }

    /**
     * Get designation1
     *
     * @return string 
     */
    public function getDesignation1()
    {
        return $this->designation1;
    }

    /**
     * Set designation2
     *
     * @param string $designation2
     * @return Item
     */
    public function setDesignation2($designation2)
    {
        $this->designation2 = $designation2;

        return $this;
    }

    /**
     * Get designation2
     *
     * @return string 
     */
    public function getDesignation2()
    {
        return $this->designation2;
    }

    /**
     * Add configuring_tankerss
     *
     * @param \Coyote\SiteBundle\Entity\ConfiguringTankers $configuringTankerss
     * @return Item
     */
    public function addConfiguringTankerss(\Coyote\SiteBundle\Entity\ConfiguringTankers $configuringTankerss)
    {
        $this->configuring_tankerss[] = $configuringTankerss;

        return $this;
    }

    /**
     * Remove configuring_tankerss
     *
     * @param \Coyote\SiteBundle\Entity\ConfiguringTankers $configuringTankerss
     */
    public function removeConfiguringTankerss(\Coyote\SiteBundle\Entity\ConfiguringTankers $configuringTankerss)
    {
        $this->configuring_tankerss->removeElement($configuringTankerss);
    }

    /**
     * Get configuring_tankerss
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConfiguringTankerss()
    {
        return $this->configuring_tankerss;
    }

    /**
     * Add offer_contents
     *
     * @param \Coyote\SiteBundle\Entity\OfferContent $offerContents
     * @return Item
     */
    public function addOfferContent(\Coyote\SiteBundle\Entity\OfferContent $offerContents)
    {
        $this->offer_contents[] = $offerContents;

        return $this;
    }

    /**
     * Remove offer_contents
     *
     * @param \Coyote\SiteBundle\Entity\OfferContent $offerContents
     */
    public function removeOfferContent(\Coyote\SiteBundle\Entity\OfferContent $offerContents)
    {
        $this->offer_contents->removeElement($offerContents);
    }

    /**
     * Get offer_contents
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOfferContents()
    {
        return $this->offer_contents;
    }

    /**
     * Add formorders
     *
     * @param \Coyote\SiteBundle\Entity\FormOrder $formorders
     * @return Item
     */
    public function addFormorder(\Coyote\SiteBundle\Entity\FormOrder $formorders)
    {
        $this->formorders[] = $formorders;

        return $this;
    }

    /**
     * Remove formorders
     *
     * @param \Coyote\SiteBundle\Entity\FormOrder $formorders
     */
    public function removeFormorder(\Coyote\SiteBundle\Entity\FormOrder $formorders)
    {
        $this->formorders->removeElement($formorders);
    }

    /**
     * Get formorders
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFormorders()
    {
        return $this->formorders;
    }

    /**
     * Set infoitem
     *
     * @param \Coyote\SiteBundle\Entity\InfoItem $infoitem
     * @return Item
     */
    public function setInfoitem(\Coyote\SiteBundle\Entity\InfoItem $infoitem = null)
    {
        $this->infoitem = $infoitem;

        return $this;
    }

    /**
     * Get infoitem
     *
     * @return \Coyote\SiteBundle\Entity\InfoItem 
     */
    public function getInfoitem()
    {
        return $this->infoitem;
    }
    
    /*public function __toString()
    {
        return $this->code.' : '.$this->designation1;
    }*/
}
