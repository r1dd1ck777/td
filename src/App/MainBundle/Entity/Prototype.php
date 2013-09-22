<?php

namespace App\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prototype
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Prototype
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="Property", cascade={"persist", "detach"})
     * @ORM\JoinTable(name="prototype2property",
     *      joinColumns={@ORM\JoinColumn(name="prototype_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="property_id", referencedColumnName="id")}
     * )
     */
    private $properties;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name = '';

    //--
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->properties = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param  string    $name
     * @return Prototype
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
     * Add properties
     *
     * @param  \App\MainBundle\Entity\Property $properties
     * @return Prototype
     */
    public function addPropertie(\App\MainBundle\Entity\Property $properties)
    {
        $this->properties[] = $properties;

        return $this;
    }

    /**
     * Remove properties
     *
     * @param \App\MainBundle\Entity\Property $properties
     */
    public function removePropertie(\App\MainBundle\Entity\Property $properties)
    {
        $this->properties->removeElement($properties);
    }

    /**
     * Get properties
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Add properties
     *
     * @param  \App\MainBundle\Entity\Property $properties
     * @return Prototype
     */
    public function addProperty(\App\MainBundle\Entity\Property $properties)
    {
        $this->properties[] = $properties;

        return $this;
    }

    /**
     * Remove properties
     *
     * @param \App\MainBundle\Entity\Property $properties
     */
    public function removeProperty(\App\MainBundle\Entity\Property $properties)
    {
        $this->properties->removeElement($properties);
    }
}
