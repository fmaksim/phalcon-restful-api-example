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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

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
    protected $is_client;

    /**
     *
     * @var string
     * @Column(type="string", length=256, nullable=true)
     */
    protected $name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $house_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $flat_number;

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
    protected $payment_percent;

    /**
     *
     * @var string
     * @Column(type="string", length=1024, nullable=true)
     */
    protected $note_text;

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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("");
        $this->hasMany(
            "id",
            "App\Models\Contacts",
            "flat_id",
            array("alias" => "Contacts", "reusable" => true)
        );

        $this->belongsTo(
            "house_id",
            "App\Models\Houses",
            "id",
            array("alias" => "Houses", "reusable" => true)
        );
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
