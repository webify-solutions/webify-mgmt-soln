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

    public static function getProductAsPickList($query) {
        $pickList = [];

        foreach ($query as $product) {
            $pickList[$product->id] =  $product->name;
        }

        return $pickList;
    }

    public static function getProductIds($query) {
      $ids = [];

      foreach ($query as $product) {
          $ids[] =  $product->id;
      }

      return $ids;
    }

    public static function getProductCustomFieldsAsJSON($query) {
      $query->select([
        'id',
        'ProductCategory.custom_field_1',
        'ProductCategory.custom_field_type_1',
        'ProductCategory.custom_field_2',
        'ProductCategory.custom_field_type_2',
        'ProductCategory.custom_field_3',
        'ProductCategory.custom_field_type_3',
        'ProductCategory.custom_field_4',
        'ProductCategory.custom_field_type_4',
        'ProductCategory.custom_field_5',
        'ProductCategory.custom_field_type_5',
        'ProductCategory.custom_field_6',
        'ProductCategory.custom_field_type_6',
        'ProductCategory.custom_field_7',
        'ProductCategory.custom_field_type_7',
        'ProductCategory.custom_field_8',
        'ProductCategory.custom_field_type_8',
        'ProductCategory.custom_field_9',
        'ProductCategory.custom_field_type_9',
        'ProductCategory.custom_field_10',
        'ProductCategory.custom_field_type_10',
        'ProductCategory.custom_field_11',
        'ProductCategory.custom_field_type_11',
        'ProductCategory.custom_field_12',
        'ProductCategory.custom_field_type_12',
        'ProductCategory.custom_field_13',
        'ProductCategory.custom_field_type_13',
        'ProductCategory.custom_field_14',
        'ProductCategory.custom_field_type_14',
        'ProductCategory.custom_field_15',
        'ProductCategory.custom_field_type_15',
        'ProductCategory.custom_field_16',
        'ProductCategory.custom_field_type_16',
        'ProductCategory.custom_field_17',
        'ProductCategory.custom_field_type_17',
        'ProductCategory.custom_field_18',
        'ProductCategory.custom_field_type_18',
        'ProductCategory.custom_field_19',
        'ProductCategory.custom_field_type_19',
        'ProductCategory.custom_field_20',
        'ProductCategory.custom_field_type_20'
      ]);
      $query->innerJoinWith('ProductCategory');

      // debug($query);
      $customFieldLabels = [];
      foreach ($query as $product) {
        $category = $product->get('_matchingData')['ProductCategory'];
        $customFields = [];
        for ($i = 1; $i <= 20; $i++) {
          $key = 'custom_field_' . $i;
          $customFields[$key] = [
            'label' => $category[$key],
            'type' => $category['custom_field_type_' . $i]
          ];
        }
        // debug($category);
        $customFieldLabels[$product->id] = $customFields;
      }

      return json_encode($customFieldLabels);
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

        // debug($query->toList());
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
      // debug($entity->get('custom_field_1'));
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
      // debug($entity->get('custom_field_1'));
//        debug($entity->get('order_id'));
        OrderBehavior::updateTotal($entity->get('order_id'), $entity->get('total'), '+');
    }

    public function afterDeleteCommit(Event $event, EntityInterface $entity, ArrayObject $options) {
        OrderBehavior::updateTotal($entity->get('order_id'), $entity->get('total'), '-');
    }
}
