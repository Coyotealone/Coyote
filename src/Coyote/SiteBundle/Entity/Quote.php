<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Quote
 * @author Coyote
 * @ORM\Entity
 *
 */
class Quote
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="citation", type="string", length=255, unique=true)
     */
    private $citation;

    /**
     * @var string
     * @ORM\Column(name="author", type="string", length=45)
     */
    private $author;

    /**
     * @var integer
     * @ORM\Column(name="week", type="integer", options={"unsigned":true})
     */
    private $week;

    /**
     * @var integer
     * @ORM\Column(name="year", type="integer", options={"unsigned":true})
     */
    private $year;


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
     * Set citation
     *
     * @param string $citation
     * @return Quote
     */
    public function setCitation($citation)
    {
        $this->citation = $citation;

        return $this;
    }

    /**
     * Get citation
     *
     * @return string 
     */
    public function getCitation()
    {
        return $this->citation;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Quote
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set week
     *
     * @param integer $week
     * @return Quote
     */
    public function setWeek($week)
    {
        $this->week = $week;

        return $this;
    }

    /**
     * Get week
     *
     * @return integer 
     */
    public function getWeek()
    {
        return $this->week;
    }

    /**
     * Set year
     *
     * @param integer $year
     * @return Quote
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }
}
