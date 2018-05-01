<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class HousesMigration_101
 */
class HousesMigration_101 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('houses', [
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
                    ),
                    new Column(
                        'start_working_time',
                        array(
                            'type' => Column::TYPE_DATE,
                            'notNull' => true,
                        )
                    ),
                    new Column(
                        'end_working_time',
                        array(
                            'type' => Column::TYPE_DATE,
                            'notNull' => true,
                        )
                    ),
                    new Column(
                        'house',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'size' => 5,
                            'notNull' => true,
                        )
                    ),
                    new Column(
                        'street_id',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'size' => 7,
                            'notNull' => true,
                        )
                    ),
                    new Column(
                        'flats_count',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'size' => 5,
                            'default' => 0,
                            'notNull' => true,
                        )
                    ),
                    new Column(
                        'housing',
                        array(
                            'type' => Column::TYPE_CHAR,
                            'size' => 2,
                            'notNull' => false,
                        )
                    ),
                    new Column(
                        'leader',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 64,
                            'notNull' => true,
                        )
                    ),
                    new Column(
                        'employer',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 64,
                            'notNull' => true,
                        )
                    ),
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
        $this->batchInsert('houses', [
                'id',
                'start_working_time',
                'end_working_time',
                'house',
                'street_id',
                'flats_count',
                'housing',
                'leader',
                'employer',
            ]
        );
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {
        $this->batchDelete('houses');
    }


}
