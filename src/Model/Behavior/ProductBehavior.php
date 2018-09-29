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

class ProductBehavior extends Behavior
{
  public static function getProductCustomFieldsAsJSON($productId) {
    $productTable = TableRegistry::getTableLocator()->get('Product');
    $query = $productTable->find('all');
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
      'ProductCategory.custom_field_type_20',
    ]);
    $query->innerJoinWith('ProductCategory');
    $query->where(['Product.id' => $productId]);

    // debug($query);
    $customFieldLabels = [];
    foreach ($query as $product) {
      $category = $product->get('_matchingData')['ProductCategory'];
      // debug($category);
      $customFieldLabels[$product->id] = $category;
    }

    return json_encode($customFieldLabels);
  }

  public static function getProductCategoriesCustomFieldsJSON($organizationId) {
    $productCategoryTable = TableRegistry::getTableLocator()->get('ProductCategory');
    $query = $productCategoryTable->find('all');
    if ($organizationId != null) {
      $query->where(['organization_id' => $organizationId]);
    }

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

    $customFields = [];
    foreach ($query as $customField) {
      $customFields[$customField->id] = $customField;
      $customField->unsetProperty('id');
    }

    // debug($customFields);
    return json_encode($customFields);
  }

  public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
  {
    // debug($entity);
    $isDirty = false;
    if($data['category_id'] == null and $data['category_name'] != null) {
      $isDirty = true;

      $productCategoryTable = TableRegistry::getTableLocator()->get('ProductCategory');
      $productCategory = $productCategoryTable->newEntity(
        [
          'name' => $data['category_name'],
          'organization_id' => $data['organization_id'],
          'active' => true
          // 'custom_field_1' => 'test'
        ]
      );

      for ($i = 1; $i <= 20; $i++) {
        $key = 'custom_field_' . $i;
        $key2 = 'custom_field_type_' . $i;
        if ($data[$key] != null and $data[$key] != '') {
          $productCategory->set($key, $data[$key]);
          $productCategory->set($key2, $data[$key2]);
        }
      }
    } else if ($data['category_id'] != null) {
      $productCategoryTable = TableRegistry::getTableLocator()->get('ProductCategory');
      $productCategory = $productCategoryTable->get($data['category_id']);

      for ($i = 1; $i <= 20; $i++) {
        $key = 'custom_field_' . $i;
        $key2 = 'custom_field_type_' . $i;
        $productCategory->set($key, null);
        if ($data[$key] != null and $data[$key] != '' and $data[$key] != $productCategory->get($key)) {
          $productCategory->set($key, $data[$key]);
          $productCategory->set($key2, $data[$key2]);
          $isDirty = true;
        }
      }
    }

    if ($isDirty) {
      if ($productCategoryTable->save($productCategory)){
        $data['category_id'] = $productCategory->get('id');
        $data['category_name'] = null;
        // debug($entity);
      } else {
        $event->stopPropagation();
        return;
      }
    }
  }

  public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
  {
    if($entity->get('sku') == null) {
      $entity->set('sku', uniqid("", true));
    }
  }
}
