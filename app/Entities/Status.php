<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;

class Status
{

    /**
     *
     * @var int
     */
    private $id;

    /**
     *
     * @var string
     */
    private $name;

    /**
     *
     * @var ArrayCollection|Occurrence[]
     */
    private $occurrences;

    /**
     *
     * @param string $name
     */
    public function __construct($name = null)
    {
        $this->name = $name;

        $this->occurrences = new ArrayCollection();
    }

    /**
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param int $id
     * @return Status
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * @param string $name
     * @return Status
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     *
     * @return ArrayCollection|Occurrence[]
     */
    public function getOccurrences()
    {
        return $this->occurrences;
    }

    /**
     *
     * @param ArrayCollection|Occurrence[] $occurrences
     * @return Line
     */
    public function setOccurrences($occurrences)
    {
        $this->occurrences = $occurrences;

        return $this;
    }
}
