<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OfferHeader
 */
class OfferHeader
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $created_at;

    /**
     * @var string
     */
    private $updated_at;

    /**
     * @var string
     */
    private $expires_at;

    /**
     * @var string
     */
    private $customer_number;

    /**
     * @var string
     */
    private $customer_information;

    /**
     * @var float
     */
    private $discount;

    /**
     * @var float
     */
    private $prices_reach;

    /**
     * @var float
     */
    private $total_price;

    /**
     * @var float
     */
    private $total_price_currency;

    /**
     * @var float
     */
    private $exchange_rate;

    /**
     * @var string
     */
    private $delivery_date;

    /**
     * @var float
     */
    private $TVA_rate;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $offer_contents;

    /**
     * @var \Coyote\SiteBundle\Entity\User
     */
    private $user;

    /**
     * @var \Coyote\SiteBundle\Entity\Languages
     */
    private $languages;

    /**
     * @var \Coyote\SiteBundle\Entity\Currency
     */
    private $currency;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->offer_contents = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set created_at
     *
     * @param string $createdAt
     * @return OfferHeader
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return string 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param string $updatedAt
     * @return OfferHeader
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return string 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set expires_at
     *
     * @param string $expiresAt
     * @return OfferHeader
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expires_at = $expiresAt;

        return $this;
    }

    /**
     * Get expires_at
     *
     * @return string 
     */
    public function getExpiresAt()
    {
        return $this->expires_at;
    }

    /**
     * Set customer_number
     *
     * @param string $customerNumber
     * @return OfferHeader
     */
    public function setCustomerNumber($customerNumber)
    {
        $this->customer_number = $customerNumber;

        return $this;
    }

    /**
     * Get customer_number
     *
     * @return string 
     */
    public function getCustomerNumber()
    {
        return $this->customer_number;
    }

    /**
     * Set customer_information
     *
     * @param string $customerInformation
     * @return OfferHeader
     */
    public function setCustomerInformation($customerInformation)
    {
        $this->customer_information = $customerInformation;

        return $this;
    }

    /**
     * Get customer_information
     *
     * @return string 
     */
    public function getCustomerInformation()
    {
        return $this->customer_information;
    }

    /**
     * Set discount
     *
     * @param float $discount
     * @return OfferHeader
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
     * Set prices_reach
     *
     * @param float $pricesReach
     * @return OfferHeader
     */
    public function setPricesReach($pricesReach)
    {
        $this->prices_reach = $pricesReach;

        return $this;
    }

    /**
     * Get prices_reach
     *
     * @return float 
     */
    public function getPricesReach()
    {
        return $this->prices_reach;
    }

    /**
     * Set total_price
     *
     * @param float $totalPrice
     * @return OfferHeader
     */
    public function setTotalPrice($totalPrice)
    {
        $this->total_price = $totalPrice;

        return $this;
    }

    /**
     * Get total_price
     *
     * @return float 
     */
    public function getTotalPrice()
    {
        return $this->total_price;
    }

    /**
     * Set total_price_currency
     *
     * @param float $totalPriceCurrency
     * @return OfferHeader
     */
    public function setTotalPriceCurrency($totalPriceCurrency)
    {
        $this->total_price_currency = $totalPriceCurrency;

        return $this;
    }

    /**
     * Get total_price_currency
     *
     * @return float 
     */
    public function getTotalPriceCurrency()
    {
        return $this->total_price_currency;
    }

    /**
     * Set exchange_rate
     *
     * @param float $exchangeRate
     * @return OfferHeader
     */
    public function setExchangeRate($exchangeRate)
    {
        $this->exchange_rate = $exchangeRate;

        return $this;
    }

    /**
     * Get exchange_rate
     *
     * @return float 
     */
    public function getExchangeRate()
    {
        return $this->exchange_rate;
    }

    /**
     * Set delivery_date
     *
     * @param string $deliveryDate
     * @return OfferHeader
     */
    public function setDeliveryDate($deliveryDate)
    {
        $this->delivery_date = $deliveryDate;

        return $this;
    }

    /**
     * Get delivery_date
     *
     * @return string 
     */
    public function getDeliveryDate()
    {
        return $this->delivery_date;
    }

    /**
     * Set TVA_rate
     *
     * @param float $tVARate
     * @return OfferHeader
     */
    public function setTVARate($tVARate)
    {
        $this->TVA_rate = $tVARate;

        return $this;
    }

    /**
     * Get TVA_rate
     *
     * @return float 
     */
    public function getTVARate()
    {
        return $this->TVA_rate;
    }

    /**
     * Add offer_contents
     *
     * @param \Coyote\SiteBundle\Entity\OfferContent $offerContents
     * @return OfferHeader
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
     * Set user
     *
     * @param \Coyote\SiteBundle\Entity\User $user
     * @return OfferHeader
     */
    public function setUser(\Coyote\SiteBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Coyote\SiteBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set languages
     *
     * @param \Coyote\SiteBundle\Entity\Languages $languages
     * @return OfferHeader
     */
    public function setLanguages(\Coyote\SiteBundle\Entity\Languages $languages = null)
    {
        $this->languages = $languages;

        return $this;
    }

    /**
     * Get languages
     *
     * @return \Coyote\SiteBundle\Entity\Languages 
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * Set currency
     *
     * @param \Coyote\SiteBundle\Entity\Currency $currency
     * @return OfferHeader
     */
    public function setCurrency(\Coyote\SiteBundle\Entity\Currency $currency = null)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \Coyote\SiteBundle\Entity\Currency 
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}
