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

  public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
  {
    // debug($entity);
    if($data['category_id'] == null and $data['category_name'] != null) {
      $productCategoryTable = TableRegistry::getTableLocator()->get('ProductCategory');
      $productCategory = $productCategoryTable->newEntity(
        [
          'name' => $data['category_name'],
          'organization_id' => $data['organization_id']
        ]
      );
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
}
