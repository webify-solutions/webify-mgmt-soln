<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MaxOrderNumberTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MaxOrderNumberTable Test Case
 */
class MaxOrderNumberTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MaxOrderNumberTable
     */
    public $MaxOrderNumber;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.max_order_number'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MaxOrderNumber') ? [] : ['className' => MaxOrderNumberTable::class];
        $this->MaxOrderNumber = TableRegistry::getTableLocator()->get('MaxOrderNumber', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MaxOrderNumber);

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
