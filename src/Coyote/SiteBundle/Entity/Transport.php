<?php

namespace Coyote\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transport
 */
class Transport
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $type;

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
     * Set type
     *
     * @param string $type
     * @return Transport
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add formorders
     *
     * @param \Coyote\SiteBundle\Entity\FormOrder $formorders
     * @return Transport
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
    
    public function __toString()
    {
        return $this->type;
    }
}
