<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;

class Company
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
    private $slug;

    /**
     *
     * @var ArrayCollection|Line[]
     */
    private $lines;

    /**
     *
     * @param string $name
     * @param string $slug
     */
    public function __construct(string $name = null, string $slug = null)
    {
        $this->name = $name;

        $this->slug = $slug;

        $this->lines = new ArrayCollection();
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
     * @return Company
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
     * @return Company
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
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     *
     * @param string $slug
     * @return Company
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     *
     * @return ArrayCollection|Line[]
     */
    public function getLines()
    {
        return $this->lines;
    }

    /**
     *
     * @param ArrayCollection|Line[] $lines
     * @return Company
     */
    public function setLines($lines)
    {
        $this->lines = $lines;

        return $this;
    }
}
