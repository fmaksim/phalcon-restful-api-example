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
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    /**
     * @SWG\Property(example="12.05.18")
     * @var string
     */
    protected $time;

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
    protected $noteText;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    /**
     * @SWG\Property(example="23.08.18")
     * @var string
     */
    protected $nextDate;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    /**
     * @SWG\Property(example="статус")
     * @var string
     */
    protected $status;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    /**
     * @SWG\Property(example="1")
     * @var integer
     */
    protected $flatId;

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
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param string $number
     */
    public function setTime($time)
    {
        $this->time = $time;
        return $this;
    }

    /**
     * @return date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param date $date
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
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
        return $this;
    }

    /**
     * @return string
     */
    public function getNextDate()
    {
        return $this->nextDate;
    }

    /**
     * @param string $nextDate
     */
    public function setNextDate($nextDate)
    {
        $this->nextDate = $nextDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getCost()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return int
     */
    public function getFlatId()
    {
        return $this->flatId;
    }

    /**
     * @param int $flatId
     */
    public function setFlatId($flatId)
    {
        $this->flatId = $flatId;
        return $this;
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
        return 'contacts';
    }

}
