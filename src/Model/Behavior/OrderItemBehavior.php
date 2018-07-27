<?php
/**
 * Created by PhpStorm.
 * User: mohammed.waked
 * Date: 2018-07-24
 * Time: 1:10 PM
 */

namespace App\Model\Behavior;


use Cake\ORM\Behavior;
use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;

class OrderItemBehavior extends Behavior
{

    public static function getOrdersAsPickList($query) {
        $pickList = [];

        $query->select([
            'id',
            'order_number'
        ]);
        foreach ($query as $order) {
            $pickList[$order->id] =  $order->order_number;
        }
        return $pickList;
    }

    public static function getProductPriceEntriesAsJSON($query) {
        $fields = [];

        $query->select([
            'id',
            'product_id',
            'name' => $query->func()->concat([
                'price' => 'identifier',
                ' ',
                'currency' => 'identifier'
            ])
        ]);

        foreach ($query as $priceEntry) {
            if(key_exists($priceEntry->product_id, $priceEntry)) {
                $fields[$priceEntry->product_id] =  array_merge(
                    $fields[$priceEntry->product_id],
                    [$priceEntry->id => $priceEntry->name]
                );
            } else {
                $fields[$priceEntry->product_id] =  [$priceEntry->id => $priceEntry->name];
            }
        }

        return json_encode($fields);
    }

    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options) {
        $data['unit_price'] = explode(' ', $data['unit_price'])[0];
    }

    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        if($entity->get('order_item_number') == null) {
            $orderItemNumber = uniqid("OI-", false);
            $entity->set('order_item_number', __($orderItemNumber));
        }

        if($entity->get('active') == null) {
            $entity->set('active', true);
        }

        $entity->set('total', $entity->get('unit_price') * $entity->get('unit_quantity'));
    }

    public function afterSaveCommit(Event $event, EntityInterface $entity, ArrayObject $options) {
//        debug($entity->get('order_id'));
        OrderBehavior::updateTotal($entity->get('order_id'), $entity->get('total'), '+');
    }

    public function afterDeleteCommit(Event $event, EntityInterface $entity, ArrayObject $options) {
        OrderBehavior::updateTotal($entity->get('order_id'), $entity->get('total'), '-');
    }
}