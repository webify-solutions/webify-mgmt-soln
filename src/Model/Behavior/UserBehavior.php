<?php
/**
 * Author: Mohammed Waked
 */

namespace App\Model\Behavior;


use Cake\ORM\Behavior;
use Cake\ORM\TableRegistry;

class UserBehavior extends Behavior {

  public static function getUsersAsPickList($organizationId, $role = null)
  {
    $usersPickList = [];

    $usersTable = TableRegistry::getTableLocator()->get('User');
    $usersQuery = $usersTable->find('all');
    $usersQuery->select([
        'id',
        'name' => $usersQuery->func()->concat([
            'login_name' => 'identifier',
            ': ',
            'name' => 'identifier'
        ])
    ]);
    $where = [];
    if ($organizationId !== null) {
      $where['organization_id']  = $organizationId;
    }

    if ($role !== null) {
      $where['role'] = $role;
    }

    if ($where !== []) {
      $usersQuery->where($where);
    }

    foreach ($usersQuery as $user) {
        $usersPickList[$user->id] =  $user->name;
    }
    return $usersPickList;
  }

  public function getDeviceToken($id) {
    $usersTable = TableRegistry::getTableLocator()->get('User');
    $user = $usersTable->find()
      ->select('device_token')
      ->where(['id' => $id])
      ->first();

    return $user->device_token;
  }

  public function getCustomerDeviceToken($customerId) {
    $usersTable = TableRegistry::getTableLocator()->get('User');
    $user = $usersTable->find()
      ->select('device_token')
      ->join([
        'table' => 'customer',
        'alias' => 'Customer',
        'type' => 'LEFT',
        'conditions' => 'Customer.login_name = User.login_name',
      ])
      ->where(['Customer.id' => $customerId])
      ->first();

    return $user->device_token;
  }
}
