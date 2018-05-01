<?php

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class PhonesMigration_102
 */
class PhonesMigration_102 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('phones', [
                'columns' => [
                    new Column(
                        'id',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'notNull' => true,
                            'autoIncrement' => true,
                            'size' => 11,
                            'first' => true
                        ]
                    )
                ],
                'indexes' => [
                    new Index('PRIMARY', ['id'], 'PRIMARY')
                ],
                'options' => [
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '1',
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
        $this->morphTable('phones', array(
                'columns' => array(
                    new Column(
                        'contact_id',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'size' => 10,
                            'notNull' => true,
                        )
                    ),
                    new Column(
                        'name',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 64,
                            'notNull' => true,
                        )
                    ),
                    new Column(
                        'phone',
                        array(
                            'type' => Column::TYPE_BIGINTEGER,
                            'size' => 12,
                            'notNull' => true,
                        )
                    ),
                    new Column(
                        'code',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'size' => 5,
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
