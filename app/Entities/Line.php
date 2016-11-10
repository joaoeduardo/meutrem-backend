<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;

class Line
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
     * @var string
     */
    private $color;

    /**
     *
     * @var Company
     */
    private $company;

    /**
     *
     * @var ArrayCollection|Occurrence[]
     */
    private $occurrences;

    /**
     *
     * @param int $id
     * @param string $name
     * @param string $color
     */
    public function __construct($id = null, $name = null, $color = null)
    {
        $this->id = $id;

        $this->name = $name;

        $this->color = $color;

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
     * @return Line
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
     * @return Line
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     *
     * @param string $color
     * @return Line
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     *
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     *
     * @param Company $company
     * @return Line
     */
    public function setCompany($company)
    {
        $this->company = $company;

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

    /**
     *
     * @return Occurrence
     */
    public function getLastOccurrence()
    {
        return $this->getOccurrences()->last();
    }
}
