<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommentsSale
 */
class CommentsSale
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $offer_contents;

    /**
     * @var \Coyote\SiteBundle\Entity\Languages
     */
    private $languages;

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
     * Set comment
     *
     * @param string $comment
     * @return CommentsSale
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
     * Add offer_contents
     *
     * @param \Coyote\SiteBundle\Entity\OfferContent $offerContents
     * @return CommentsSale
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
     * Set languages
     *
     * @param \Coyote\SiteBundle\Entity\Languages $languages
     * @return CommentsSale
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
}
