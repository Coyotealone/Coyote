<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 */
class User extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $adress1;

    /**
     * @var string
     */
    private $adress2;

    /**
     * @var string
     */
    private $zip_code;

    /**
     * @var string
     */
    private $postal_box;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $cell;

    /**
     * @var string
     */
    private $fax;

    /**
     * @var string
     */
    private $website;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $schedules;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $offer_headers;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $userfeess;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $formorders;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->schedules = new \Doctrine\Common\Collections\ArrayCollection();
        $this->offer_headers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->userfeess = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set adress1
     *
     * @param string $adress1
     * @return User
     */
    public function setAdress1($adress1)
    {
        $this->adress1 = $adress1;

        return $this;
    }

    /**
     * Get adress1
     *
     * @return string 
     */
    public function getAdress1()
    {
        return $this->adress1;
    }

    /**
     * Set adress2
     *
     * @param string $adress2
     * @return User
     */
    public function setAdress2($adress2)
    {
        $this->adress2 = $adress2;

        return $this;
    }

    /**
     * Get adress2
     *
     * @return string 
     */
    public function getAdress2()
    {
        return $this->adress2;
    }

    /**
     * Set zip_code
     *
     * @param string $zipCode
     * @return User
     */
    public function setZipCode($zipCode)
    {
        $this->zip_code = $zipCode;

        return $this;
    }

    /**
     * Get zip_code
     *
     * @return string 
     */
    public function getZipCode()
    {
        return $this->zip_code;
    }

    /**
     * Set postal_box
     *
     * @param string $postalBox
     * @return User
     */
    public function setPostalBox($postalBox)
    {
        $this->postal_box = $postalBox;

        return $this;
    }

    /**
     * Get postal_box
     *
     * @return string 
     */
    public function getPostalBox()
    {
        return $this->postal_box;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return User
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set cell
     *
     * @param string $cell
     * @return User
     */
    public function setCell($cell)
    {
        $this->cell = $cell;

        return $this;
    }

    /**
     * Get cell
     *
     * @return string 
     */
    public function getCell()
    {
        return $this->cell;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return User
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return User
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Add schedules
     *
     * @param \Coyote\SiteBundle\Entity\Schedule $schedules
     * @return User
     */
    public function addSchedule(\Coyote\SiteBundle\Entity\Schedule $schedules)
    {
        $this->schedules[] = $schedules;

        return $this;
    }

    /**
     * Remove schedules
     *
     * @param \Coyote\SiteBundle\Entity\Schedule $schedules
     */
    public function removeSchedule(\Coyote\SiteBundle\Entity\Schedule $schedules)
    {
        $this->schedules->removeElement($schedules);
    }

    /**
     * Get schedules
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSchedules()
    {
        return $this->schedules;
    }

    /**
     * Add offer_headers
     *
     * @param \Coyote\SiteBundle\Entity\OfferHeader $offerHeaders
     * @return User
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
     * Add userfeess
     *
     * @param \Coyote\SiteBundle\Entity\UserFees $userfeess
     * @return User
     */
    public function addUserfeess(\Coyote\SiteBundle\Entity\UserFees $userfeess)
    {
        $this->userfeess[] = $userfeess;

        return $this;
    }

    /**
     * Remove userfeess
     *
     * @param \Coyote\SiteBundle\Entity\UserFees $userfeess
     */
    public function removeUserfeess(\Coyote\SiteBundle\Entity\UserFees $userfeess)
    {
        $this->userfeess->removeElement($userfeess);
    }

    /**
     * Get userfeess
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserfeess()
    {
        return $this->userfeess;
    }

    /**
     * Add formorders
     *
     * @param \Coyote\SiteBundle\Entity\FormOrder $formorders
     * @return User
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
}
