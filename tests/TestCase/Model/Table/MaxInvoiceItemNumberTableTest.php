<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MaxInvoiceItemNumberTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MaxInvoiceItemNumberTable Test Case
 */
class MaxInvoiceItemNumberTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MaxInvoiceItemNumberTable
     */
    public $MaxInvoiceItemNumber;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.max_invoice_item_number'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MaxInvoiceItemNumber') ? [] : ['className' => MaxInvoiceItemNumberTable::class];
        $this->MaxInvoiceItemNumber = TableRegistry::getTableLocator()->get('MaxInvoiceItemNumber', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MaxInvoiceItemNumber);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
