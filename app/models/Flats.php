<?php

namespace App\Models;

class Flats extends \Phalcon\Mvc\Model
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
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    protected $status;

    /**
     *
     * @var bool
     * @Column(type="bool", nullable=true)
     */
    protected $velcom;

    /**
     *
     * @var string
     * @Column(type="string", length=256, nullable=true)
     */
    protected $name;

    /**
     *
     * @var string
     * @Column(type="string", length=256, nullable=true)
     */
    protected $FIO;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $houseId;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $flatNumber;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    protected $date;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    protected $provider;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $payment;

    /**
     *
     * @var string
     * @Column(type="string", length=1024, nullable=true)
     */
    protected $noteText;

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     *
     * @return Flats[]|Flats
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Flats
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
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
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function isVelcom()
    {
        return $this->velcom;
    }

    /**
     * @param bool $velcom
     */
    public function setVelcom($velcom)
    {
        $this->velcom = $velcom;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getFIO()
    {
        return $this->FIO;
    }

    /**
     * @param string $FIO
     */
    public function setFIO($FIO)
    {
        $this->FIO = $FIO;
    }

    /**
     * @return int
     */
    public function getHouseId()
    {
        return $this->houseId;
    }

    /**
     * @param int $houseId
     */
    public function setHouseId($houseId)
    {
        $this->houseId = $houseId;
    }

    /**
     * @return int
     */
    public function getFlatNumber()
    {
        return $this->flatNumber;
    }

    /**
     * @param int $flatNumber
     */
    public function setFlatNumber($flatNumber)
    {
        $this->flatNumber = $flatNumber;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param string $provider
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return int
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param int $payment
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;
    }

    /**
     * @return string
     */
    public function getNoteText()
    {
        return $this->noteText;
    }

    /**
     * @param string $noteText
     */
    public function setNoteText($noteText)
    {
        $this->noteText = $noteText;
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
        return 'flats';
    }

}
