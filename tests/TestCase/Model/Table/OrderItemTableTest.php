<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrderItemTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrderItemTable Test Case
 */
class OrderItemTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\OrderItemTable
     */
    public $OrderItem;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.order_item',
        'app.order',
        'app.price_entry',
        'app.product',
        'app.organization',
        'app.invoice_item'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('OrderItem') ? [] : ['className' => OrderItemTable::class];
        $this->OrderItem = TableRegistry::getTableLocator()->get('OrderItem', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OrderItem);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
