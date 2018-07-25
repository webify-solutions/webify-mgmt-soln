<?php
/**
 * Created by PhpStorm.
 * User: mohammed.waked
 * Date: 2018-07-25
 * Time: 11:35 AM
 */

namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;

class PriceEntryBehavior extends Behavior
{

    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        if($entity->get('price_entry_number') == null) {
            $priceNumberNumber = uniqid("P-", false);
            $entity->set('price_entry_number', __($priceNumberNumber));
        }
    }
}