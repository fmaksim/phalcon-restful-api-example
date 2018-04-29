<?php

namespace App\Models;

class Houses extends \Phalcon\Mvc\Model
{
    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=32, nullable=false)
     */
    protected $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=7, nullable=true)
     */
    protected $house;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=true)
     */
    protected $housing;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    protected $street;

    /**
     *
     * @var string
     * @Column(type="string", length=16, nullable=true)
     */
    protected $streetType;

    /**
     *
     * @var integer
     * @Column(type="integer", length=16, nullable=true)
     */
    protected $streetId;

    /**
     *
     * @var integer
     * @Column(type="integer", length=16, nullable=true)
     */
    protected $flatsCount;

    /**
     *
     * @var bool
     * @Column(type="bool", nullable=true)
     */
    protected $velcom;

    /**
     *
     * @var string
     * @Column(type="string", length=16, nullable=true)
     */
    protected $other;

    /**
     *
     * @var float
     * @Column(type="float", length=5, nullable=true)
     */
    protected $percent;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    protected $leader;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    protected $employer;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    protected $startWorkingTime;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    protected $endWorkingTime;

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     *
     * @return Houses[]|Houses
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Houses
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'houses';
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getHouse()
    {
        return $this->house;
    }

    /**
     * @param int $house
     */
    public function setHouse($house)
    {
        $this->house = $house;
        return $this;
    }

    /**
     * @return string
     */
    public function getHousing()
    {
        return $this->housing;
    }

    /**
     * @param string $housing
     */
    public function setHousing($housing)
    {
        $this->housing = $housing;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreetType()
    {
        return $this->streetType;
    }

    /**
     * @param string $streetType
     */
    public function setStreetType($streetType)
    {
        $this->streetType = $streetType;
        return $this;
    }

    /**
     * @return int
     */
    public function getStreetId()
    {
        return $this->streetId;
    }

    /**
     * @param int $streetId
     */
    public function setStreetId($streetId)
    {
        $this->streetId = $streetId;
        return $this;
    }

    /**
     * @return int
     */
    public function getFlatsCount()
    {
        return $this->flatsCount;
    }

    /**
     * @param int $flatsCount
     */
    public function setFlatsCount($flatsCount)
    {
        $this->flatsCount = $flatsCount;
        return $this;
    }

    /**
     * @return string
     */
    public function getVelcom()
    {
        return $this->velcom;
    }

    /**
     * @param string $velcom
     */
    public function setVelcom($velcom)
    {
        $this->velcom = $velcom;
        return $this;
    }

    /**
     * @return string
     */
    public function getOther()
    {
        return $this->other;
    }

    /**
     * @param string $other
     */
    public function setOther($other)
    {
        $this->other = $other;
        return $this;
    }

    /**
     * @return float
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * @param float $percent
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;
        return $this;
    }

    /**
     * @return string
     */
    public function getLeader()
    {
        return $this->leader;
    }

    /**
     * @param string $leader
     */
    public function setLeader($leader)
    {
        $this->leader = $leader;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmployer()
    {
        return $this->employer;
    }

    /**
     * @param string $employer
     */
    public function setEmployer($employer)
    {
        $this->employer = $employer;
        return $this;
    }

    /**
     * @return string
     */
    public function getStartWorkingTime()
    {
        return $this->startWorkingTime;
    }

    /**
     * @param string $startWorkingTime
     */
    public function setStartWorkingTime($startWorkingTime)
    {
        $this->startWorkingTime = $startWorkingTime;
        return $this;
    }

    /**
     * @return string
     */
    public function getEndWorkingTime()
    {
        return $this->endWorkingTime;
    }

    /**
     * @param string $endWorkingTime
     */
    public function setEndWorkingTime($endWorkingTime)
    {
        $this->endWorkingTime = $endWorkingTime;
        return $this;
    }

}
