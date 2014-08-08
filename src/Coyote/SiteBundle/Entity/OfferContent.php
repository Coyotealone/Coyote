<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OfferContent
 */
class OfferContent
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
     * @var float
     */
    private $price;

    /**
     * @var float
     */
    private $price_currency;

    /**
     * @var float
     */
    private $discount;

    /**
     * @var \Coyote\SiteBundle\Entity\Item
     */
    private $item;

    /**
     * @var \Coyote\SiteBundle\Entity\CommentsSale
     */
    private $comments_sale;

    /**
     * @var \Coyote\SiteBundle\Entity\OfferHeader
     */
    private $offer_header;


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
     * @return OfferContent
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
     * Set price
     *
     * @param float $price
     * @return OfferContent
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
     * Set price_currency
     *
     * @param float $priceCurrency
     * @return OfferContent
     */
    public function setPriceCurrency($priceCurrency)
    {
        $this->price_currency = $priceCurrency;

        return $this;
    }

    /**
     * Get price_currency
     *
     * @return float 
     */
    public function getPriceCurrency()
    {
        return $this->price_currency;
    }

    /**
     * Set discount
     *
     * @param float $discount
     * @return OfferContent
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return float 
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set item
     *
     * @param \Coyote\SiteBundle\Entity\Item $item
     * @return OfferContent
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

    /**
     * Set comments_sale
     *
     * @param \Coyote\SiteBundle\Entity\CommentsSale $commentsSale
     * @return OfferContent
     */
    public function setCommentsSale(\Coyote\SiteBundle\Entity\CommentsSale $commentsSale = null)
    {
        $this->comments_sale = $commentsSale;

        return $this;
    }

    /**
     * Get comments_sale
     *
     * @return \Coyote\SiteBundle\Entity\CommentsSale 
     */
    public function getCommentsSale()
    {
        return $this->comments_sale;
    }

    /**
     * Set offer_header
     *
     * @param \Coyote\SiteBundle\Entity\OfferHeader $offerHeader
     * @return OfferContent
     */
    public function setOfferHeader(\Coyote\SiteBundle\Entity\OfferHeader $offerHeader = null)
    {
        $this->offer_header = $offerHeader;

        return $this;
    }

    /**
     * Get offer_header
     *
     * @return \Coyote\SiteBundle\Entity\OfferHeader 
     */
    public function getOfferHeader()
    {
        return $this->offer_header;
    }
}
