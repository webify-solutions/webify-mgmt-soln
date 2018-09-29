<?php
/**
 * Author: Mohammed Waked
 */

namespace App\Model\Behavior;


use Cake\ORM\Behavior;
use Cake\ORM\TableRegistry;

class UserBehavior extends Behavior {

  public static function getUsersAsPickList($organizationId)
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
      if ($organizationId != null) {
        $usersQuery->where(['organization_id'=>$organizationId]);
      }

      foreach ($usersQuery as $user) {
          $usersPickList[$user->id] =  $user->name;
      }
      return $usersPickList;
  }
}
