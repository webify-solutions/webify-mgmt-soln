<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SupportCaseTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SupportCaseTable Test Case
 */
class SupportCaseTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SupportCaseTable
     */
    public $SupportCase;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.support_case',
        'app.customer',
        'app.organization'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SupportCase') ? [] : ['className' => SupportCaseTable::class];
        $this->SupportCase = TableRegistry::getTableLocator()->get('SupportCase', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SupportCase);

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
