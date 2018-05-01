<?php

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class UsersMigration_102
 */
class UsersMigration_102 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('users', [
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
        $this->morphTable('users', array(
                'columns' => array(
                    new Column(
                        'login',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 32,
                            'notNull' => true,
                        )
                    ),
                    new Column(
                        'password',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 256,
                            'notNull' => true,
                        )
                    ),
                    new Column(
                        'added',
                        array(
                            'type' => Column::TYPE_BIGINTEGER,
                            'size' => 12,
                            'notNull' => true,
                        )
                    ),
                    new Column(
                        'status',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'size' => 1,
                            'default' => 0,
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
