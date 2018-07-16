<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrderTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrderTable Test Case
 */
class OrderTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\OrderTable
     */
    public $Order;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.order',
        'app.customer',
        'app.organization',
        'app.invoice',
        'app.order_item',
        'app.payment'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Order') ? [] : ['className' => OrderTable::class];
        $this->Order = TableRegistry::getTableLocator()->get('Order', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Order);

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
