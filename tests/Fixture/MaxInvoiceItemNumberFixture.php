<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MaxInvoiceItemNumberFixture
 *
 */
class MaxInvoiceItemNumberFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'max_invoice_item_number';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'invoice_item_number' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_options' => [
            'engine' => null,
            'collation' => null
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
                'invoice_item_number' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
