<?php
/**
 * Created by PhpStorm.
 * User: mohammed.waked
 * Date: 2018-07-21
 * Time: 3:23 PM
 */

namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;

class CustomerBehavior extends Behavior
{

    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        debug($entity);

        if($entity->get('customer_number') == null) {
            $customerNumber = uniqid("C-", false);
            $entity->set('customer_number', __($customerNumber));
        }
    }
}