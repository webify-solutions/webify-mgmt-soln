<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MaxOrderItemNumberTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MaxOrderItemNumberTable Test Case
 */
class MaxOrderItemNumberTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MaxOrderItemNumberTable
     */
    public $MaxOrderItemNumber;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.max_order_item_number'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MaxOrderItemNumber') ? [] : ['className' => MaxOrderItemNumberTable::class];
        $this->MaxOrderItemNumber = TableRegistry::getTableLocator()->get('MaxOrderItemNumber', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MaxOrderItemNumber);

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
