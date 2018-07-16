<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GroupTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GroupTable Test Case
 */
class GroupTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GroupTable
     */
    public $Group;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.group',
        'app.organization',
        'app.customer',
        'app.user'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Group') ? [] : ['className' => GroupTable::class];
        $this->Group = TableRegistry::getTableLocator()->get('Group', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Group);

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
