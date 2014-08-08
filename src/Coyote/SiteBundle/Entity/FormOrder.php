<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormOrder
 */
class FormOrder
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $ordernumber;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var integer
     */
    private $amount;

    /**
     * @var \Coyote\SiteBundle\Entity\Item
     */
    private $item;

    /**
     * @var \Coyote\SiteBundle\Entity\Transport
     */
    private $transport;

    /**
     * @var \Coyote\SiteBundle\Entity\User
     */
    private $user;

    /**
     * @var \Coyote\SiteBundle\Entity\DeliveryAddress
     */
    private $deliveryaddress;


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
     * Set ordernumber
     *
     * @param integer $ordernumber
     * @return FormOrder
     */
    public function setOrdernumber($ordernumber)
    {
        $this->ordernumber = $ordernumber;

        return $this;
    }

    /**
     * Get ordernumber
     *
     * @return integer 
     */
    public function getOrdernumber()
    {
        return $this->ordernumber;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return FormOrder
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
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
     * Set amount
     *
     * @param integer $amount
     * @return FormOrder
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
     * Set item
     *
     * @param \Coyote\SiteBundle\Entity\Item $item
     * @return FormOrder
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
     * Set transport
     *
     * @param \Coyote\SiteBundle\Entity\Transport $transport
     * @return FormOrder
     */
    public function setTransport(\Coyote\SiteBundle\Entity\Transport $transport = null)
    {
        $this->transport = $transport;

        return $this;
    }

    /**
     * Get transport
     *
     * @return \Coyote\SiteBundle\Entity\Transport 
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * Set user
     *
     * @param \Coyote\SiteBundle\Entity\User $user
     * @return FormOrder
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
     * Set deliveryaddress
     *
     * @param \Coyote\SiteBundle\Entity\DeliveryAddress $deliveryaddress
     * @return FormOrder
     */
    public function setDeliveryaddress(\Coyote\SiteBundle\Entity\DeliveryAddress $deliveryaddress = null)
    {
        $this->deliveryaddress = $deliveryaddress;

        return $this;
    }

    /**
     * Get deliveryaddress
     *
     * @return \Coyote\SiteBundle\Entity\DeliveryAddress 
     */
    public function getDeliveryaddress()
    {
        return $this->deliveryaddress;
    }
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        // Add your code here
    }
}
