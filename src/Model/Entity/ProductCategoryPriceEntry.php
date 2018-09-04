<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductCategoryPriceEntry Entity
 *
 * @property int $product_id
 * @property int $organization_id
 * @property string $product_name
 * @property string $product_sku
 * @property string $product_description
 * @property \Cake\I18n\FrozenTime $product_created_at
 * @property \Cake\I18n\FrozenTime $product_last_updated
 * @property int $category_id
 * @property string $cateogry_name
 * @property string $custom_field_label_1
 * @property string $custom_field_label_type_1
 * @property string $custom_field_label_2
 * @property string $custom_field_label_type_2
 * @property string $custom_field_label_3
 * @property string $custom_field_label_type_3
 * @property string $custom_field_label_4
 * @property string $custom_field_label_type_4
 * @property string $custom_field_label_5
 * @property string $custom_field_label_type_5
 * @property string $custom_field_label_6
 * @property string $custom_field_label_type_6
 * @property string $custom_field_label_7
 * @property string $custom_field_label_type_7
 * @property string $custom_field_label_8
 * @property string $custom_field_label_type_8
 * @property string $custom_field_label_9
 * @property string $custom_field_label_type_9
 * @property string $custom_field_label_10
 * @property string $custom_field_label_type_10
 * @property string $custom_field_label_11
 * @property string $custom_field_label_type_11
 * @property string $custom_field_label_12
 * @property string $custom_field_label_type_12
 * @property string $custom_field_label_13
 * @property string $custom_field_label_type_13
 * @property string $custom_field_label_14
 * @property string $custom_field_label_type_14
 * @property string $custom_field_label_15
 * @property string $custom_field_label_type_15
 * @property string $custom_field_label_16
 * @property string $custom_field_label_type_16
 * @property string $custom_field_label_17
 * @property string $custom_field_label_type_17
 * @property string $custom_field_label_18
 * @property string $custom_field_label_type_18
 * @property string $custom_field_label_19
 * @property string $custom_field_label_type_19
 * @property string $custom_field_label_20
 * @property string $custom_field_label_type_20
 * @property \Cake\I18n\FrozenTime $category_created_at
 * @property \Cake\I18n\FrozenTime $category_updated_at
 * @property int $price_entry_id
 * @property string $price_entry_number
 * @property float $price
 * @property string $price_text
 * @property string $price_entry_currency
 * @property \Cake\I18n\FrozenTime $price_entry_created_at
 * @property \Cake\I18n\FrozenTime $price_entry_last_updated
 *
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\Organization $organization
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\PriceEntry $price_entry
 */
class ProductCategoryPriceEntry extends Entity
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
        'product_id' => true,
        'organization_id' => true,
        'product_name' => true,
        'product_sku' => true,
        'product_description' => true,
        'product_created_at' => true,
        'product_last_updated' => true,
        'category_id' => true,
        'cateogry_name' => true,
        'custom_field_label_1' => true,
        'custom_field_label_type_1' => true,
        'custom_field_label_2' => true,
        'custom_field_label_type_2' => true,
        'custom_field_label_3' => true,
        'custom_field_label_type_3' => true,
        'custom_field_label_4' => true,
        'custom_field_label_type_4' => true,
        'custom_field_label_5' => true,
        'custom_field_label_type_5' => true,
        'custom_field_label_6' => true,
        'custom_field_label_type_6' => true,
        'custom_field_label_7' => true,
        'custom_field_label_type_7' => true,
        'custom_field_label_8' => true,
        'custom_field_label_type_8' => true,
        'custom_field_label_9' => true,
        'custom_field_label_type_9' => true,
        'custom_field_label_10' => true,
        'custom_field_label_type_10' => true,
        'custom_field_label_11' => true,
        'custom_field_label_type_11' => true,
        'custom_field_label_12' => true,
        'custom_field_label_type_12' => true,
        'custom_field_label_13' => true,
        'custom_field_label_type_13' => true,
        'custom_field_label_14' => true,
        'custom_field_label_type_14' => true,
        'custom_field_label_15' => true,
        'custom_field_label_type_15' => true,
        'custom_field_label_16' => true,
        'custom_field_label_type_16' => true,
        'custom_field_label_17' => true,
        'custom_field_label_type_17' => true,
        'custom_field_label_18' => true,
        'custom_field_label_type_18' => true,
        'custom_field_label_19' => true,
        'custom_field_label_type_19' => true,
        'custom_field_label_20' => true,
        'custom_field_label_type_20' => true,
        'category_created_at' => true,
        'category_updated_at' => true,
        'price_entry_id' => true,
        'price_entry_number' => true,
        'price' => true,
        'price_text' => true,
        'price_entry_currency' => true,
        'price_entry_created_at' => true,
        'price_entry_last_updated' => true,
        'product' => true,
        'organization' => true,
        'category' => true,
        'price_entry' => true
    ];
}
