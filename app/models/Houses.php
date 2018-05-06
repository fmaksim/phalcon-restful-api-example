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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

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
     * @var integer
     * @Column(type="integer", length=16, nullable=true)
     */
    protected $street_id;

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
    protected $start_working_time;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    protected $end_working_time;

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
        $this->hasMany(
            'id',
            'App\Models\Flats',
            'house_id',
            array('alias' => 'Flats', "reusable" => true)
        );

        $this->belongsTo(
            "street_id",
            "App\Models\Streets",
            "id",
            array("alias" => "Streets", "reusable" => true)
        );
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

    public static function getAddress(array $house, array $street)
    {
        return $street["street_type"] .
            " " . $street["street"] .
            ", " . $house["house"] .
            " " . $house["housing"];
    }

}
