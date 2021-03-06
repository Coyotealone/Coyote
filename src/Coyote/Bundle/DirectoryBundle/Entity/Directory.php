<?php

namespace Coyote\Bundle\DirectoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Directory
 * @author Coyote
 * @ORM\Entity
 * @ORM\Table(name="directory")
 * @ORM\Entity(repositoryClass="Coyote\Bundle\DirectoryBundle\Entity\DirectoryRepository");
 * @ORM\HasLifecycleCallbacks
 */
class Directory
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
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="firstname", type="string", length=50)
     */
    private $firstname;

    /**
     * @var string
     * @ORM\Column(name="job_phone_number", type="string", nullable=true)
     */
    private $job_phone_number;

    /**
     * @var integer
     * @ORM\Column(name="quick_phone_number", type="integer", nullable=true, options={"unsigned":true})
     */
    private $quick_phone_number;
    
    /**
     * @var string
     * @ORM\Column(name="phone", type="string", length=20, nullable=true)
     */
    private $phone;

    /**
     * @var string
     * @ORM\Column(name="cellphone_number", type="string", length=20, nullable=true)
     */
    private $cellphone_number;
    
    /**
     * @var string
     * @ORM\Column(name="fax", type="string", length=20, nullable=true)
     */
    private $fax;

    /**
     * @var string
     * @ORM\Column(name="country", type="string", length=20)
     */
    private $country;

    /**
     * @var string
     * @ORM\Column(name="mail", type="string", length=100, nullable=true)
     */
    private $mail;

    /**
     * @var string
     * @ORM\Column(name="function_service", type="string", length=200)
     */
    private $function_service;

    /**
     * @var boolean
     * @ORM\Column(name="leader", type="boolean", nullable=true)
     */
    private $leader;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @var boolean
     * @ORM\Column(name="enabled", type="boolean", nullable=true)
     */
    private $enabled;

    /**
     * @var \DateTime
     * @ORM\Column(name="enabled_at", type="datetime", nullable=true)
     */
    private $enabled_at;
    
    /**
     * @var string
     * @ORM\Column(name="business", type="string", length=50)
     */
    private $business;
    
    /**
     * 
     * @return string name
     */
    public function __toString()
    {
        return $this->name;
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
     * @return Directory
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
     * Set firstname
     *
     * @param string $firstname
     * @return Directory
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set job_phone_number
     *
     * @param integer $jobPhoneNumber
     * @return Directory
     */
    public function setJobPhoneNumber($jobPhoneNumber)
    {
        $this->job_phone_number = $jobPhoneNumber;

        return $this;
    }

    /**
     * Get job_phone_number
     *
     * @return integer
     */
    public function getJobPhoneNumber()
    {
        return $this->job_phone_number;
    }

    /**
     * Set quick_phone_number
     *
     * @param integer $quickPhoneNumber
     * @return Directory
     */
    public function setQuickPhoneNumber($quickPhoneNumber)
    {
        $this->quick_phone_number = $quickPhoneNumber;

        return $this;
    }

    /**
     * Get quick_phone_number
     *
     * @return integer
     */
    public function getQuickPhoneNumber()
    {
        return $this->quick_phone_number;
    }

    /**
     * Set cellphone_number
     *
     * @param string $cellphoneNumber
     * @return Directory
     */
    public function setCellphoneNumber($cellphoneNumber)
    {
        $this->cellphone_number = $cellphoneNumber;

        return $this;
    }

    /**
     * Get cellphone_number
     *
     * @return string
     */
    public function getCellphoneNumber()
    {
        return $this->cellphone_number;
    }

    /**
     * Set function_service
     *
     * @param string $functionService
     * @return Directory
     */
    public function setFunctionService($functionService)
    {
        $this->function_service = $functionService;

        return $this;
    }

    /**
     * Get function_service
     *
     * @return string
     */
    public function getFunctionService()
    {
        return $this->function_service;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Directory
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
     * Set mail
     *
     * @param string $mail
     * @return Directory
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set created_at
     * @ORM\PrePersist
     * @param \DateTime $createdAt
     * @return Expense
     */
    public function setCreatedAt($createdAt)
    {
        if(!$this->getCreatedAt())
        {
            $this->created_at = new \DateTime();
        }
    }

    /**
     * Get created_at
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     * @ORM\PreUpdate
     * @param \DateTime $updatedAt
     * @return Expense
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = new \DateTime();
    }

    /**
     * Get updated_at
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set leader
     *
     * @param boolean $leader
     * @return Directory
     */
    public function setLeader($leader)
    {
        $this->leader = $leader;

        return $this;
    }

    /**
     * Get leader
     *
     * @return boolean
     */
    public function getLeader()
    {
        return $this->leader;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Directory
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
		$this->setEnabledAt();
        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set enabled_at
     *
     * @param \DateTime $enabledAt
     * @return Directory
     */
    public function setEnabledAt()
    {
        $this->enabled_at = new \DateTime();
    }

    /**
     * Get enabled_at
     *
     * @return \DateTime
     */
    public function getEnabledAt()
    {
        return $this->enabled_at;
    }
    
    /**
     * Set business
     *
     * @param string $business
     * @return Directory
     */
    public function setBusiness($business)
    {
        $this->business = $business;

        return $this;
    }

    /**
     * Get business
     *
     * @return string
     */
    public function getBusiness()
    {
        return $this->business;
    }
    
    /**
     * Set fax
     *
     * @param string $fax
     * @return Directory
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
     * Set phone
     *
     * @param string $phone
     * @return Directory
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
}
