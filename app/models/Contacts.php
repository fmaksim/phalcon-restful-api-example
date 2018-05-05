<?php

namespace App\Models;

/**
 * @SWG\Definition(type="object", @SWG\Xml(name="contact"))
 */
class Contacts extends \Phalcon\Mvc\Model
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
     * @var date
     * @Column(type="date", nullable=true)
     */
    /**
     * @SWG\Property(example="12.05.18")
     * @var string
     */
    protected $date;

    /**
     *
     * @var string
     * @Column(type="string", length=256, nullable=true)
     */
    /**
     * @SWG\Property(example="текст примечания")
     * @var string
     */
    protected $note_text;

    /**
     * @param string $date
     */
    public function setDate(string $date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @param string $note_text
     */
    public function setNoteText(string $note_text)
    {
        $this->note_text = $note_text;
        return $this;
    }

    /**
     * @param int $flat_id
     */
    public function setFlatId(int $flat_id)
    {
        $this->flat_id = $flat_id;
        return $this;
    }

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    /**
     * @SWG\Property(example="1")
     * @var integer
     */
    protected $flat_id;

    /**
     * @SWG\Property(
     *      property="phones",
     *      type="array",
     *      @SWG\Items(
     *      type="object",
     *      @SWG\Property(property="name", type="string", example = "Иван",),
     *      @SWG\Property(property="phone", type="integer", example = "1234567",),
     *      @SWG\Property(property="code", type="integer", example = "29",),
     *      ),
     * )
     */

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
            'id',
            'App\Models\Phones',
            'contact_id',
            array('alias' => 'Phones', "reusable" => true)
        );

    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'contacts';
    }

}
