<?php

namespace App\Entities;

use Carbon\Carbon;

class Occurrence
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
    private $description;

    /**
     *
     * @var Status
     */
    private $status;

    /**
     *
     * @var Line
     */
    private $line;

    /**
     *
     * @var Carbon
     */
    private $startedAt;

    /**
     *
     * @var Carbon
     */
    private $finishedAt;

    public function __construct($description = null)
    {
        $this->description = $description;
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
     * @return Occurrence
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     *
     * @param string $description
     * @return Occurrence
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     *
     * @return Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     *
     * @param Status $status
     * @return Occurrence
     */
    public function setStatus(Status $status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     *
     * @return Line
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     *
     * @param Line $line
     * @return Occurrence
     */
    public function setLine(Line $line)
    {
        $this->line = $line;
        return $this;
    }

    /**
     *
     * @return Carbon
     */
    public function getStartedAt()
    {
        return $this->startedAt;
    }

    /**
     *
     * @param string $startedAt
     * @return Occurrence
     */
    public function setStartedAt($startedAt)
    {
        $this->startedAt = Carbon::createFromFormat('Y-m-d\TH:i:s', $startedAt);
        return $this;
    }

    /**
     *
     * @return Carbon
     */
    public function getFinishedAt()
    {
        return $this->finishedAt;
    }

    /**
     *
     * @param string $finishedAt
     * @return Occurrence
     */
    public function setFinishedAt($finishedAt)
    {
        $this->finishedAt = Carbon::createFromFormat('Y-m-d\TH:i:s', $finishedAt);
        return $this;
    }
}
