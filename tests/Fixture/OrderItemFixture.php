<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrderItemFixture
 *
 */
class OrderItemFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'order_item';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'order_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'price_entry_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'product_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'organization_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'order_item_number' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'price_discount' => ['type' => 'float', 'length' => null, 'precision' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'description' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'active' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'created_at' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'last_updated' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'FK1' => ['type' => 'index', 'columns' => ['order_id'], 'length' => []],
            'FK2' => ['type' => 'index', 'columns' => ['price_entry_id'], 'length' => []],
            'FK3' => ['type' => 'index', 'columns' => ['product_id'], 'length' => []],
            'FK4' => ['type' => 'index', 'columns' => ['organization_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'order_item_ibfk_1' => ['type' => 'foreign', 'columns' => ['order_id'], 'references' => ['order', 'id'], 'update' => 'restrict', 'delete' => 'setNull', 'length' => []],
            'order_item_ibfk_2' => ['type' => 'foreign', 'columns' => ['price_entry_id'], 'references' => ['price_entry', 'id'], 'update' => 'restrict', 'delete' => 'setNull', 'length' => []],
            'order_item_ibfk_3' => ['type' => 'foreign', 'columns' => ['product_id'], 'references' => ['product', 'id'], 'update' => 'restrict', 'delete' => 'setNull', 'length' => []],
            'order_item_ibfk_4' => ['type' => 'foreign', 'columns' => ['organization_id'], 'references' => ['organization', 'id'], 'update' => 'restrict', 'delete' => 'setNull', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'order_id' => 1,
                'price_entry_id' => 1,
                'product_id' => 1,
                'organization_id' => 1,
                'order_item_number' => 'Lorem ipsum dolor sit amet',
                'price_discount' => 1,
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'active' => 1,
                'created_at' => '2018-07-15 11:19:32',
                'last_updated' => '2018-07-15 11:19:32'
            ],
        ];
        parent::init();
    }
}
