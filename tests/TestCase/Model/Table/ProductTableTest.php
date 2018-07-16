<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductTable Test Case
 */
class ProductTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductTable
     */
    public $Product;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.product',
        'app.organization',
        'app.invoice_item',
        'app.order_item',
        'app.price_entry'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Product') ? [] : ['className' => ProductTable::class];
        $this->Product = TableRegistry::getTableLocator()->get('Product', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Product);

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
