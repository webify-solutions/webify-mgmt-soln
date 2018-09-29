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

class PriceEntryBehavior extends Behavior
{

    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        if($entity->get('price_entry_number') == null) {
            $priceNumberNumber = uniqid("P-", false);
            $entity->set('price_entry_number', __($priceNumberNumber));
        }
    }


    public function afterSaveCommit(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        TableRegistry::getTableLocator()->get('PriceEntry')->updateAll(
            [
                'active' => false
            ],
            [
                'product_id' => $entity->get('product_id'),
                'id !=' => $entity->get('id')
            ]
        );
    }
}
