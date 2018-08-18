<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property int $organization_id
 * @property string $name
 * @property string $custom_field_1
 * @property string $custom_field_type_1
 * @property string $custom_field_2
 * @property string $custom_field_type_2
 * @property string $custom_field_3
 * @property string $custom_field_type_3
 * @property string $custom_field_4
 * @property string $custom_field_type_4
 * @property string $custom_field_5
 * @property string $custom_field_type_5
 * @property string $custom_field_6
 * @property string $custom_field_type_6
 * @property string $custom_field_7
 * @property string $custom_field_type_7
 * @property string $custom_field_8
 * @property string $custom_field_type_8
 * @property string $custom_field_9
 * @property string $custom_field_type_9
 * @property string $custom_field_10
 * @property string $custom_field_type_10
 * @property string $custom_field_11
 * @property string $custom_field_type_11
 * @property string $custom_field_12
 * @property string $custom_field_type_12
 * @property string $custom_field_13
 * @property string $custom_field_type_13
 * @property string $custom_field_14
 * @property string $custom_field_type_14
 * @property string $custom_field_15
 * @property string $custom_field_type_15
 * @property string $custom_field_16
 * @property string $custom_field_type_16
 * @property string $custom_field_17
 * @property string $custom_field_type_17
 * @property string $custom_field_18
 * @property string $custom_field_type_18
 * @property string $custom_field_19
 * @property string $custom_field_type_19
 * @property string $custom_field_20
 * @property string $custom_field_type_20
 * @property bool $active
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $last_updated
 *
 * @property \App\Model\Entity\Organization $organization
 * @property \App\Model\Entity\Product[] $product
 */
class ProductCategory extends Entity
{
  /**
   * Fields that can be mass assigned using newEntity() or patchEntity().
   *
   * Note that when '*' is set to true, this allows all unspecified fields to
   * be mass assigned. For security purposes, it is advised to set '*' to false
   * (or remove it), and explicitly make individual fields accessible as needed.
   *
   * @var array
   */
  protected $_accessible = [
      'organization_id' => true,
      'name' => true,
      '$custom_field_1' => true,
      '$custom_field_type_1' => true,
      '$custom_field_2' => true,
      '$custom_field_type_2' => true,
      '$custom_field_3' => true,
      '$custom_field_type_3' => true,
      '$custom_field_4' => true,
      '$custom_field_type_4' => true,
      '$custom_field_5' => true,
      '$custom_field_type_5' => true,
      '$custom_field_6' => true,
      '$custom_field_type_6' => true,
      '$custom_field_7' => true,
      '$custom_field_type_7' => true,
      '$custom_field_8' => true,
      '$custom_field_type_8' => true,
      '$custom_field_9' => true,
      '$custom_field_type_9' => true,
      '$custom_field_10' => true,
      '$custom_field_type_10' => true,
      '$custom_field_11' => true,
      '$custom_field_type_11' => true,
      '$custom_field_12' => true,
      '$custom_field_type_12' => true,
      '$custom_field_13' => true,
      '$custom_field_type_13' => true,
      '$custom_field_14' => true,
      '$custom_field_type_14' => true,
      '$custom_field_15' => true,
      '$custom_field_type_15' => true,
      '$custom_field_16' => true,
      '$custom_field_type_16' => true,
      '$custom_field_17' => true,
      '$custom_field_type_17' => true,
      '$custom_field_18' => true,
      '$custom_field_type_18' => true,
      '$custom_field_19' => true,
      '$custom_field_type_19' => true,
      '$custom_field_20' => true,
      '$custom_field_type_20' => true,
      'active' => true,
      'created_at' => true,
      'last_updated' => true,
      'organization' => true,
      'product' => true
  ];
}
