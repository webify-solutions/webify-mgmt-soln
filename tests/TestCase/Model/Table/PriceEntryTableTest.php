<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PriceEntryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PriceEntryTable Test Case
 */
class PriceEntryTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PriceEntryTable
     */
    public $PriceEntry;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.price_entry',
        'app.product',
        'app.organization',
        'app.order_item'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PriceEntry') ? [] : ['className' => PriceEntryTable::class];
        $this->PriceEntry = TableRegistry::getTableLocator()->get('PriceEntry', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PriceEntry);

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
