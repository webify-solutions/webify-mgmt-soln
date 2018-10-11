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

  public function afterSaveCommit(Event $event, EntityInterface $entity, ArrayObject $options) {
    // debug('createUserCustomer');
    // debug($entity);
    /*
     * Required to retrieve customer since customer_number is created
     * in the database and need to refresh entity
     */
    $customerTable = TableRegistry::getTableLocator()->get('Customer');
    $customer = $customerTable->get($entity->get('id'));
    // debug($customer);

    $userTable = TableRegistry::getTableLocator()->get('User');
    $user = $userTable->newEntity();
    $user->set('login_name', $customer->get('login_name'));
    $user->set('organization_id', $customer->get('organization_id'));
    $user->set('password', '123456');
    $user->set('name', $customer->get('name'));
    $user->set('role', 'Customer');
    $user->set('phone', $customer->get('phone'));
    $user->set('email', $customer->get('email'));
    // debug($user);

    if (!$userTable->save($user)) {
      debug ('Failed to create user');
    }
  }
}
