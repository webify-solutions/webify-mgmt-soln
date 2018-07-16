<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MaxInvoiceNumberTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MaxInvoiceNumberTable Test Case
 */
class MaxInvoiceNumberTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MaxInvoiceNumberTable
     */
    public $MaxInvoiceNumber;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.max_invoice_number'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MaxInvoiceNumber') ? [] : ['className' => MaxInvoiceNumberTable::class];
        $this->MaxInvoiceNumber = TableRegistry::getTableLocator()->get('MaxInvoiceNumber', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MaxInvoiceNumber);

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
