<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductCategoryPriceEntryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductCategoryPriceEntryTable Test Case
 */
class ProductCategoryPriceEntryTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductCategoryPriceEntryTable
     */
    public $ProductCategoryPriceEntry;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.product_category_price_entry',
        'app.products',
        'app.organizations',
        'app.categories',
        'app.price_entries'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ProductCategoryPriceEntry') ? [] : ['className' => ProductCategoryPriceEntryTable::class];
        $this->ProductCategoryPriceEntry = TableRegistry::getTableLocator()->get('ProductCategoryPriceEntry', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProductCategoryPriceEntry);

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
