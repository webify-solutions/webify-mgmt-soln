<?php
/**
 * Created by PhpStorm.
 * User: mohammed.waked
 * Date: 2018-07-21
 * Time: 3:26 PM
 */

namespace App\Model\Behavior;


use Cake\ORM\Behavior;
use Cake\ORM\TableRegistry;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;

class OrderBehavior extends Behavior
{

    public static function getCustomersAsPickList($customerQuery)
    {
        $customerPickList = [];

        $customerQuery->select([
            'id',
            'name' => $customerQuery->func()->concat([
                'customer_number' => 'identifier',
                ': ',
                'name' => 'identifier'
            ]),

        ]);
        foreach ($customerQuery as $customer) {
            $customerPickList[$customer->id] =  $customer->name;
        }
        return $customerPickList;
    }

    /**
     *
     * Update Total with new order item amount
     *
     * @param $orderId
     * @param $orderItemTotal
     * @param string $operation {+/-}
     */
    public static function updateTotal($orderId, $orderItemAmount, $operation = '+') {
        $orderTable = TableRegistry::getTableLocator()->get('Order');
        $order = $orderTable->get($orderId);
//        debug($order);

        if ($operation == '+' ) {
            $order->set('subtotal_amount', $order->get('subtotal_amount') + $orderItemAmount);
        } else if ($operation == '-') {
            $order->set('subtotal_amount', $order->get('subtotal_amount') - $orderItemAmount);
        }

//        debug($order->get('subtotal_amount'));
//        OrderBehavior::calculateTotalAmount($order);
//        debug($order);

        $orderTable->save($order);
    }

    public static function calculateTotalAmount(EntityInterface $entity) {
        $discount = 0;
//        debug($entity->get('order_discount_unit'));
//        debug($entity->get('subtotal_amount'));
        if($entity->get('order_discount_unit') == 'Amount') {

            $discount = $entity->get('order_discount');
        } else if ($entity->get('order_discount_unit') == 'Percentage') {

            $discount = $entity->get('subtotal_amount') * ($entity->get('order_discount') / 100);
        }

//        debug($discount);
        return$entity->get('subtotal_amount') - $discount;
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
    }
}