<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Class User
 * @author Coyote
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Coyote\SiteBundle\Entity\UserRepository");
 */
class User extends BaseUser
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=80)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="address1", type="string", length=45)
     */
    private $address1;

    /**
     * @var string
     * @ORM\Column(name="address2", type="string", length=45, nullable=true)
     */
    private $address2;

    /**
     * @var string
     * @ORM\Column(name="zip_code", type="string", length=10)
     */
    private $zip_code;

    /**
     * @var string
     * @ORM\Column(name="postal_box", type="string", length=10, nullable=true)
     */
    private $postal_box;

    /**
     * @var string
     * @ORM\Column(name="city", type="string", length=80)
     */
    private $city;

    /**
     * @var string
     * @ORM\Column(name="country", type="string", length=45)
     */
    private $country;

    /**
     * @var string
     * @ORM\Column(name="phone", type="string", length=20)
     */
    private $phone;

    /**
     * @var string
     * @ORM\Column(name="cell", type="string", length=20, nullable=true)
     */
    private $cell;

    /**
     * @var string
     * @ORM\Column(name="fax", type="string", length=20, nullable=true)
     */
    private $fax;

    /**
     * @var string
     * @ORM\Column(name="website", type="string", length=100, nullable=true)
     */
    private $website;

    /**
     * @ORM\OneToMany(targetEntity="Schedule", mappedBy="user", cascade={"persist", "merge"})
     */
    private $schedules;

    /**
    * @ORM\OneToOne(targetEntity="UserFees", cascade={"persist"})
    * @ORM\JoinColumn(nullable=true)
    */
    private $userfees;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->schedules = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set address1
     *
     * @param string $address1
     * @return User
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * Get address1
     *
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address2
     *
     * @param string $address2
     * @return User
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get address2
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
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
     * Set userfees
     *
     * @param \Coyote\SiteBundle\Entity\UserFees $userfees
     * @return User
     */
    public function setUserfees(\Coyote\SiteBundle\Entity\UserFees $userfees = null)
    {
        $this->userfees = $userfees;

        return $this;
    }

    /**
     * Get userfees
     *
     * @return \Coyote\SiteBundle\Entity\UserFees 
     */
    public function getUserfees()
    {
        return $this->userfees;
    }
}
