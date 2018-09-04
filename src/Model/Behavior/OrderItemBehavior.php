<?php
/**
 * Created by PhpStorm.
 * User: mohammed.waked
 * Date: 2018-07-24
 * Time: 1:10 PM
 */

namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\TableRegistry;

use Cake\Datasource\EntityInterface;
use Cake\Event\Event;

use ArrayObject;

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

    public static function getProductAsPickList($productList) {
        $pickList = [];

        foreach (array_keys($productList) as $productId) {
            $pickList[$productId] =  $productList[$productId]['product_name'];
        }

        return $pickList;
    }

    public static function getProductCategoryPriceEntryList($organizationId) {
      $productCategoryPriceEntryTable = TableRegistry::getTableLocator()->get('ProductCategoryPriceEntry');
      $query = $productCategoryPriceEntryTable->find('all');
      $query->select([
          'product_id',
          'product_name',
          'price_text',
          'custom_field_label_1',
          'custom_field_label_type_1',
          'custom_field_label_2',
          'custom_field_label_type_2',
          'custom_field_label_3',
          'custom_field_label_type_3',
          'custom_field_label_4',
          'custom_field_label_type_4',
          'custom_field_label_5',
          'custom_field_label_type_5',
          'custom_field_label_6',
          'custom_field_label_type_6',
          'custom_field_label_7',
          'custom_field_label_type_7',
          'custom_field_label_8',
          'custom_field_label_type_8',
          'custom_field_label_9',
          'custom_field_label_type_9',
          'custom_field_label_10',
          'custom_field_label_type_10',
          'custom_field_label_11',
          'custom_field_label_type_11',
          'custom_field_label_12',
          'custom_field_label_type_12',
          'custom_field_label_13',
          'custom_field_label_type_13',
          'custom_field_label_14',
          'custom_field_label_type_14',
          'custom_field_label_15',
          'custom_field_label_type_15',
          'custom_field_label_16',
          'custom_field_label_type_16',
          'custom_field_label_17',
          'custom_field_label_type_17',
          'custom_field_label_18',
          'custom_field_label_type_18',
          'custom_field_label_19',
          'custom_field_label_type_19',
          'custom_field_label_20',
          'custom_field_label_type_20'
        ]);

        if ($organizationId != null) {
          $query->where([
            'organization_id' => $organizationId
          ]);
        }

        $productCategoryPriceEntryList = [];
        foreach ($query as $productCategoryPriceEntry) {
          $customFields = [];
          for ($i = 1; $i <= 20; $i++) {
            $key = 'custom_field_label_' . $i;
            $customFields['custom_field_' . $i] = [
              'label' => $productCategoryPriceEntry[$key],
              'type' => $productCategoryPriceEntry['custom_field_label_type_' . $i]
            ];
          }
          $productCategoryPriceEntryList[$productCategoryPriceEntry->product_id] = [
            'product_name' => $productCategoryPriceEntry->product_name,
            'price' => $productCategoryPriceEntry->price_text,
            'custom_fields' => $customFields
          ];
        }

        // debug($productCategoryPriceEntryList);

        return $productCategoryPriceEntryList;
    }

    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options) {
        // debug('beforeMarshal');
        $data['unit_price'] = explode(' ', $data['unit_price'])[0];

        // debug($data);
    }

    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
      // debug('beforeSave');
      // debug($entity->get('custom_field_label_1'));
      if($entity->get('order_item_number') == null) {
          $orderItemNumber = uniqid("OI-", false);
          $entity->set('order_item_number', __($orderItemNumber));
      }

      if($entity->get('active') == null) {
          $entity->set('active', true);
      }

      $entity->set('total', $entity->get('unit_price') * $entity->get('unit_quantity'));

      // debug($entity);
    }

    public function afterSaveCommit(Event $event, EntityInterface $entity, ArrayObject $options) {
      // debug('afterSaveCommit');
      // debug($entity->get('custom_field_label_1'));
//        debug($entity->get('order_id'));
      OrderBehavior::updateTotal($entity->get('order_id'), $entity->get('total'), '+');
      // debug($entity);
    }

    public function afterDeleteCommit(Event $event, EntityInterface $entity, ArrayObject $options) {
        OrderBehavior::updateTotal($entity->get('order_id'), $entity->get('total'), '-');
    }
}
