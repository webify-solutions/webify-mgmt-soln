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

class ProductBehavior extends Behavior
{

  public static function getProductCustomFieldLabelsAsJSON($query) {
    $query->select([
      'id',
      'ProductCategory.custom_field_1',
      'ProductCategory.custom_field_2',
      'ProductCategory.custom_field_3',
      'ProductCategory.custom_field_4',
      'ProductCategory.custom_field_5',
      'ProductCategory.custom_field_6',
      'ProductCategory.custom_field_7',
      'ProductCategory.custom_field_8',
      'ProductCategory.custom_field_9',
      'ProductCategory.custom_field_10',
      'ProductCategory.custom_field_11',
      'ProductCategory.custom_field_12',
      'ProductCategory.custom_field_13',
      'ProductCategory.custom_field_14',
      'ProductCategory.custom_field_15',
      'ProductCategory.custom_field_16',
      'ProductCategory.custom_field_17',
      'ProductCategory.custom_field_18',
      'ProductCategory.custom_field_19',
      'ProductCategory.custom_field_20',
    ]);
    $query->innerJoinWith('ProductCategory');

    // debug($query);
    $customFieldLabels = [];
    foreach ($query as $product) {
      $category = $product->get('_matchingData')['ProductCategory'];
      // debug($category);
      $customFieldLabels[$product->id] = $category;
    }

    return json_encode($customFieldLabels);
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
          'organization_id' => $data['organization_id']
          // 'custom_field_1' => 'test'
        ]
      );

      for ($i = 1; $i <= 20; $i++) {
        $key = 'custom_field_' . $i;
        if ($data[$key] != null and $data[$key] != '') {
          $productCategory->set($key, $data[$key]);
        }
      }
    } else if ($data['category_id'] != null) {
      $productCategoryTable = TableRegistry::getTableLocator()->get('ProductCategory');
      $productCategory = $productCategoryTable->get($data['category_id']);

      for ($i = 1; $i <= 20; $i++) {
        $key = 'custom_field_' . $i;
        $productCategory->set($key, null);
        if ($data[$key] != null and $data[$key] != '' and $data[$key] != $productCategory->get($key)) {
          $productCategory->set($key, $data[$key]);
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

  public static function getProductCategoriesCustomFieldsJSON($query) {
    $query->select(
      [
        'id', 'custom_field_1', 'custom_field_2', 'custom_field_3', 'custom_field_4',
        'custom_field_5', 'custom_field_6', 'custom_field_7', 'custom_field_8',
        'custom_field_9', 'custom_field_10', 'custom_field_11', 'custom_field_12',
        'custom_field_13', 'custom_field_14', 'custom_field_15', 'custom_field_16',
        'custom_field_17', 'custom_field_18', 'custom_field_19', 'custom_field_20'
      ]
    );

    $customFields = [];
    foreach ($query as $customField) {
      $customFields[$customField->id] = $customField;
      $customField->unsetProperty('id');
    }

    return json_encode($customFields);
  }
}
