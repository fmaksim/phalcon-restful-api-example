<?php

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class ContactsMigration_102
 */
class ContactsMigration_102 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('contacts', [
                'columns' => [
                    new Column(
                        'flat_id',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'size' => 11,
                            'first' => true
                        ]
                    ),
                    new Column(
                        'note_text',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 128,
                            'after' => 'flat_id'
                        ]
                    )
                ],
                'options' => [
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '',
                    'ENGINE' => 'InnoDB',
                    'TABLE_COLLATION' => 'utf8_unicode_ci'
                ],
            ]
        );
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {
        $this->morphTable('contacts', array(
                'columns' => array(
                    new Column(
                        'date',
                        array(
                            'type' => Column::TYPE_DATE,
                            'notNull' => true,
                        )
                    ),
                    new Column(
                        'status',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 16,
                            'notNull' => true,
                        )
                    ),
                    new Column(
                        'next_date',
                        array(
                            'type' => Column::TYPE_DATE,
                            'size' => 128,
                            'notNull' => true,
                        )
                    ),
                ),
            )
        );
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {

    }

}
