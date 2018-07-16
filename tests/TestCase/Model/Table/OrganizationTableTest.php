<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrganizationTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrganizationTable Test Case
 */
class OrganizationTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\OrganizationTable
     */
    public $Organization;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.organization',
        'app.customer',
        'app.group',
        'app.invoice',
        'app.invoice_item',
        'app.order',
        'app.order_item',
        'app.payment',
        'app.price_entry',
        'app.product',
        'app.support_case',
        'app.user',
        'app.user_group'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Organization') ? [] : ['className' => OrganizationTable::class];
        $this->Organization = TableRegistry::getTableLocator()->get('Organization', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Organization);

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
