<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DeliveryAddress
 */
class DeliveryAddress
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $corporate_name;

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
    private $email;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $formorders;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set corporate_name
     *
     * @param string $corporateName
     * @return DeliveryAddress
     */
    public function setCorporateName($corporateName)
    {
        $this->corporate_name = $corporateName;

        return $this;
    }

    /**
     * Get corporate_name
     *
     * @return string 
     */
    public function getCorporateName()
    {
        return $this->corporate_name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return DeliveryAddress
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
     * @return DeliveryAddress
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
     * @return DeliveryAddress
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
     * @return DeliveryAddress
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
     * @return DeliveryAddress
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
     * @return DeliveryAddress
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
     * @return DeliveryAddress
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
     * @return DeliveryAddress
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
     * @return DeliveryAddress
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
     * @return DeliveryAddress
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
     * Set email
     *
     * @param string $email
     * @return DeliveryAddress
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Add formorders
     *
     * @param \Coyote\SiteBundle\Entity\FormOrder $formorders
     * @return DeliveryAddress
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
