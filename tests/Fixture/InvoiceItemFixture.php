<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InvoiceItemFixture
 *
 */
class InvoiceItemFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'invoice_item';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'invoice_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'order_item_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'product_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'organization_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'invoice_item_number' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'total_price' => ['type' => 'float', 'length' => null, 'precision' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'description' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'created_at' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'last_updated' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'last_updated_by' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FK1' => ['type' => 'index', 'columns' => ['invoice_id'], 'length' => []],
            'FK2' => ['type' => 'index', 'columns' => ['order_item_id'], 'length' => []],
            'FK3' => ['type' => 'index', 'columns' => ['product_id'], 'length' => []],
            'FK4' => ['type' => 'index', 'columns' => ['organization_id'], 'length' => []],
            'FK5' => ['type' => 'index', 'columns' => ['last_updated_by'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'invoice_item_ibfk_1' => ['type' => 'foreign', 'columns' => ['invoice_id'], 'references' => ['invoice', 'id'], 'update' => 'restrict', 'delete' => 'setNull', 'length' => []],
            'invoice_item_ibfk_2' => ['type' => 'foreign', 'columns' => ['order_item_id'], 'references' => ['order_item', 'id'], 'update' => 'restrict', 'delete' => 'setNull', 'length' => []],
            'invoice_item_ibfk_3' => ['type' => 'foreign', 'columns' => ['product_id'], 'references' => ['product', 'id'], 'update' => 'restrict', 'delete' => 'setNull', 'length' => []],
            'invoice_item_ibfk_4' => ['type' => 'foreign', 'columns' => ['organization_id'], 'references' => ['organization', 'id'], 'update' => 'restrict', 'delete' => 'setNull', 'length' => []],
            'invoice_item_ibfk_5' => ['type' => 'foreign', 'columns' => ['last_updated_by'], 'references' => ['user', 'id'], 'update' => 'restrict', 'delete' => 'setNull', 'length' => []],
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
                'invoice_id' => 1,
                'order_item_id' => 1,
                'product_id' => 1,
                'organization_id' => 1,
                'invoice_item_number' => 'Lorem ipsum dolor sit amet',
                'total_price' => 1,
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'created_at' => '2018-07-15 11:20:07',
                'last_updated' => '2018-07-15 11:20:07',
                'last_updated_by' => 1
            ],
        ];
        parent::init();
    }
}
