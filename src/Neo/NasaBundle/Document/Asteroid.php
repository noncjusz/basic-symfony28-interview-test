<?php

namespace Neo\NasaBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(repositoryClass="Neo\NasaBundle\Document\AsteroidRepository")
 */
class Asteroid
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $date;

    /**
     * @MongoDB\Field(type="string", name="neo_reference_id")
     * @MongoDB\Index(unique=true)
     */
    protected $neoReferenceId;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $name;

    /**
     * @MongoDB\Field(type="string", name="kilometers_per_hour")
     */
    protected $kilometersPerHour;

    /**
     * @MongoDB\Field(type="bool", name="is_potentially_hazardous_asteroid")
     */
    protected $isHazardous;

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param string $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return string $date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set neoReferenceId
     *
     * @param string $neoReferenceId
     * @return $this
     */
    public function setNeoReferenceId($neoReferenceId)
    {
        $this->neoReferenceId = $neoReferenceId;
        return $this;
    }

    /**
     * Get neoReferenceId
     *
     * @return string $neoReferenceId
     */
    public function getNeoReferenceId()
    {
        return $this->neoReferenceId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set kilometersPerHour
     *
     * @param string $kilometersPerHour
     * @return $this
     */
    public function setKilometersPerHour($kilometersPerHour)
    {
        $this->kilometersPerHour = $kilometersPerHour;
        return $this;
    }

    /**
     * Get kilometersPerHour
     *
     * @return string $kilometersPerHour
     */
    public function getKilometersPerHour()
    {
        return $this->kilometersPerHour;
    }

    /**
     * Set isHazardous
     *
     * @param string $isHazardous
     * @return $this
     */
    public function setIsHazardous($isHazardous)
    {
        $this->isHazardous = $isHazardous;
        return $this;
    }

    /**
     * Get isHazardous
     *
     * @return string $isHazardous
     */
    public function getIsHazardous()
    {
        return $this->isHazardous;
    }
}
