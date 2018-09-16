<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\ORM\TableRegistry;

/**
 * Class DashboardController
 *
 * @package App\Controller
 */
class DashboardController extends AppController
{

    public function initialize()
    {
        parent::initialize();

    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {

      $this->set([
        'loggedUser' => $this->loggedUser,
        'orderItems' => DashboardController::getSalesPerProductThisMonth($this->loggedUserOrgId),
        'customers' => DashboardController::getNewCustomerPerMonth($this->loggedUserOrgId)
      ]);
    }

    public static function getSalesPerProductThisMonth($organizationId) {
      $orderItemTable = TableRegistry::getTableLocator()->get('OrderItem');
      $orderItemQuery = $orderItemTable->find('all');
      $orderItemQuery
        ->select([
          'Product.name',
          'total_unit_quantity' => $orderItemQuery->func()->sum('OrderItem.unit_quantity')
        ])
        ->contain(['Product'])
        ->group(['Product.name']);

      if ($organizationId != null) {
        $orderItemQuery->where([
          '(OrderItem.created_at BETWEEN  DATE_FORMAT(NOW(), \'%Y-%m-01\') AND NOW())',
          'OrderItem.organization_id' => $organizationId
        ]);
      } else {
        $orderItemQuery->where([
          '(OrderItem.created_at BETWEEN  DATE_FORMAT(NOW(), \'%Y-%m-01\') AND NOW())'
        ]);
      }

      // debug($orderItemQuery);

      $orderItems = [];
      foreach ($orderItemQuery as $orderItem) {
        // debug($orderItem);
        $orderItems[] = [$orderItem->product->name,  intval($orderItem->total_unit_quantity)];
      }
      // debug($orderItems);
      return json_encode($orderItems);
    }

    public static function getNewCustomerPerMonth($organizationId) {
      $customerTable = TableRegistry::getTableLocator()->get('Customer');
      $customerQuery = $customerTable->find('all');
      $customerQuery
        ->select([
          'month_name_abbr' => $customerQuery->func()->date_format(['created_at' => 'literal', '"%b"'  => 'literal']),
          'customer_number' => $customerQuery->func()->count('id'),
          'month_name' => 'MONTHNAME(created_at)'
        ])
        ->group(['MONTH(created_at)']);

      if ($organizationId != null) {
        $customerQuery->where([
          'YEAR(created_at) = YEAR(CURDATE())',
          'organization_id' => $organizationId
        ]);
      } else {
        $customerQuery->where([
          'YEAR(created_at) = YEAR(CURDATE())'
        ]);
      }

      $customers = [];
      foreach ($customerQuery as $customer) {
        $customers[] = [
          $customer->month_name_abbr,
          intval($customer->customer_number),
          $customer->month_name,
          ""
        ];
      }

      // debug(json_encode($customers));
      return json_encode($customers);
    }

    /**
     * Is authorized method
     *
     * @param $user
     * @return bool
     */
    public function isAuthorized($user)
    {
        if ($user != null) {
            return true;
        }

        return false;
    }
}
