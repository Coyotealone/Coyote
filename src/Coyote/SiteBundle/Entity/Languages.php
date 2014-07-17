<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Languages
 */
class Languages
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $language;

    /**
     * @var string
     */
    private $entitled;

    /**
     * @var boolean
     */
    private $logon_language;

    /**
     * @var string
     */
    private $conversion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $offer_headers;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $comments_sales;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->offer_headers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments_sales = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set language
     *
     * @param string $language
     * @return Languages
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set entitled
     *
     * @param string $entitled
     * @return Languages
     */
    public function setEntitled($entitled)
    {
        $this->entitled = $entitled;

        return $this;
    }

    /**
     * Get entitled
     *
     * @return string 
     */
    public function getEntitled()
    {
        return $this->entitled;
    }

    /**
     * Set logon_language
     *
     * @param boolean $logonLanguage
     * @return Languages
     */
    public function setLogonLanguage($logonLanguage)
    {
        $this->logon_language = $logonLanguage;

        return $this;
    }

    /**
     * Get logon_language
     *
     * @return boolean 
     */
    public function getLogonLanguage()
    {
        return $this->logon_language;
    }

    /**
     * Set conversion
     *
     * @param string $conversion
     * @return Languages
     */
    public function setConversion($conversion)
    {
        $this->conversion = $conversion;

        return $this;
    }

    /**
     * Get conversion
     *
     * @return string 
     */
    public function getConversion()
    {
        return $this->conversion;
    }

    /**
     * Add offer_headers
     *
     * @param \Coyote\SiteBundle\Entity\OfferHeader $offerHeaders
     * @return Languages
     */
    public function addOfferHeader(\Coyote\SiteBundle\Entity\OfferHeader $offerHeaders)
    {
        $this->offer_headers[] = $offerHeaders;

        return $this;
    }

    /**
     * Remove offer_headers
     *
     * @param \Coyote\SiteBundle\Entity\OfferHeader $offerHeaders
     */
    public function removeOfferHeader(\Coyote\SiteBundle\Entity\OfferHeader $offerHeaders)
    {
        $this->offer_headers->removeElement($offerHeaders);
    }

    /**
     * Get offer_headers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOfferHeaders()
    {
        return $this->offer_headers;
    }

    /**
     * Add comments_sales
     *
     * @param \Coyote\SiteBundle\Entity\CommentsSale $commentsSales
     * @return Languages
     */
    public function addCommentsSale(\Coyote\SiteBundle\Entity\CommentsSale $commentsSales)
    {
        $this->comments_sales[] = $commentsSales;

        return $this;
    }

    /**
     * Remove comments_sales
     *
     * @param \Coyote\SiteBundle\Entity\CommentsSale $commentsSales
     */
    public function removeCommentsSale(\Coyote\SiteBundle\Entity\CommentsSale $commentsSales)
    {
        $this->comments_sales->removeElement($commentsSales);
    }

    /**
     * Get comments_sales
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommentsSales()
    {
        return $this->comments_sales;
    }
}
