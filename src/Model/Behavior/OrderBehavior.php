<?php
/**
 * Created by PhpStorm.
 * User: mohammed.waked
 * Date: 2018-07-21
 * Time: 3:26 PM
 */

namespace App\Model\Behavior;


use Cake\ORM\Behavior;
use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;

class OrderBehavior extends Behavior
{

    public static function getCustomersAsPickList($customerQuery) {
        $customerPickList = [];

        $customerQuery->select([
            'id',
            'name' => $customerQuery->func()->concat([
                'customer_number' => 'identifier',
                ': ',
                'first_name' => 'identifier',
                ' ',
                'last_name' => 'identifier'
            ]),

        ]);
        foreach ($customerQuery as $customer) {
            $customerPickList[$customer->id] =  $customer->name;
        }
        return $customerPickList;
    }

    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        if($entity->get('order_number') == null) {
            $orderNumber = uniqid("O-", false);
            $entity->set('order_number', __($orderNumber));
        }

        if($entity->get('order_date') ==  null) {
            $orderDate = date('Y-m-d');
            $entity->set('order_date', __($orderDate));
        }

        if($entity->get('active') == null) {
            $entity->set('active', true);
        }

        if($entity->get('subtotal_amount') != null
            and $entity->get('subtotal_amount') >= 0
            and ($entity->isDirty('subtotal_amount')
                or $entity->isDirty('order_discount')
                or $entity->isDirty('order_discount_unit')
            ))
        {
            $discount = 0;
            if($entity->get('order_discount_unit') == 'Amount') {
                $discount = $entity->get('order_discount');
            } else if ($entity->get('order_discount_unit') == 'Percentage') {
                $discount = $entity->get('total_amount') * ($entity->get('order_discount_unit') / 100);
            }

            $entity->set('total_amount', $entity->get('total_amount') - $discount);
        }
    }
}