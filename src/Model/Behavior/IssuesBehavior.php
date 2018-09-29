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

class IssuesBehavior extends Behavior {

  public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
  {
    // debug($event);
    if($entity->get('issue_number') == null) {
        $issueNumber = uniqid("I-", false);
        $entity->set('issue_number', __($issueNumber));
    }
  }
}
