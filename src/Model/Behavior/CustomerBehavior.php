<?php
/**
 * Author: Mohammed Waked
 */

namespace App\Model\Behavior;


use Cake\ORM\Behavior;
use Cake\ORM\TableRegistry;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;

class CustomerBehavior extends Behavior
{
  public static function getCustomersAsPickList($organizationId)
  {
      $customerPickList = [];

      $customerTable = TableRegistry::getTableLocator()->get('Customer');
      $customerQuery = $customerTable->find('all');
      $customerQuery->select([
          'id',
          'name' => $customerQuery->func()->concat([
              'customer_number' => 'identifier',
              ': ',
              'name' => 'identifier'
          ]),

      ]);
      if ($organizationId != null) {
        $customerQuery->where(['organization_id'=>$organizationId]);
      }

      foreach ($customerQuery as $customer) {
          $customerPickList[$customer->id] =  $customer->name;
      }
      return $customerPickList;
  }
}
