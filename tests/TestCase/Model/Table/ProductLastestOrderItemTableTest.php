<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductLastestOrderItemTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductLastestOrderItemTable Test Case
 */
class ProductLastestOrderItemTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductLastestOrderItemTable
     */
    public $ProductLastestOrderItem;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.product_lastest_order_item',
        'app.products',
        'app.organizations',
        'app.orders',
        'app.order_customers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ProductLastestOrderItem') ? [] : ['className' => ProductLastestOrderItemTable::class];
        $this->ProductLastestOrderItem = TableRegistry::getTableLocator()->get('ProductLastestOrderItem', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProductLastestOrderItem);

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
