<?php
namespace App\Test\TestCase\Controller;

use App\Controller\OrganizationController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\OrganizationController Test Case
 */
class OrganizationControllerTest extends IntegrationTestCase
{

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
