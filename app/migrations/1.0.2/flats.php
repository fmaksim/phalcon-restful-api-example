<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class FlatsMigration_102
 */
class FlatsMigration_102 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('flats', [
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
                        'status',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 16,
                            'notNull' => true,
                        )
                    ),
                    new Column(
                        'is_client',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'size' => 1,
                            'default' => 0,
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
                        'house_id',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'size' => 7,
                            'notNull' => true,
                        )
                    ),
                    new Column(
                        'flat_number',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'size' => 7,
                            'notNull' => true,
                        )
                    ),
                    new Column(
                        'date',
                        array(
                            'type' => Column::TYPE_DATE,
                            'notNull' => true,
                        )
                    ),
                    new Column(
                        'provider',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 32,
                            'notNull' => true,
                        )
                    ),
                    new Column(
                        'note_text',
                        array(
                            'type' => Column::TYPE_TEXT,
                            'notNull' => true,
                        )
                    ),
                    new Column(
                        'payment_percent',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'size' => 3,
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
        $this->batchInsert('flats', [
                'id',
                'status',
                'is_client',
                'name',
                'house_id',
                'flat_number',
                'date',
                'provider',
                'note_text',
                'payment_percent',
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
        $this->batchDelete('flats');
    }

}
