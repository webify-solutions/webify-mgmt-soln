<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductLastestOrderItem Entity
 *
 * @property int $product_id
 * @property int $organization_id
 * @property string $product_name
 * @property string $product_sku
 * @property string $product_description
 * @property \Cake\I18n\FrozenTime $product_created_at
 * @property \Cake\I18n\FrozenTime $product_last_updated
 * @property string $order_item_number
 * @property float $order_item_unit_price
 * @property float $order_item_unit_quantity
 * @property float $order_item_total
 * @property string $custom_field_value_1
 * @property string $custom_field_upload_link_1
 * @property string $custom_field_value_2
 * @property string $custom_field_upload_link_2
 * @property string $custom_field_value_3
 * @property string $custom_field_upload_link_3
 * @property string $custom_field_value_4
 * @property string $custom_field_upload_link_4
 * @property string $custom_field_value_5
 * @property string $custom_field_upload_link_5
 * @property string $custom_field_value_6
 * @property string $custom_field_upload_link_6
 * @property string $custom_field_value_7
 * @property string $custom_field_upload_link_7
 * @property string $custom_field_value_8
 * @property string $custom_field_upload_link_8
 * @property string $custom_field_value_9
 * @property string $custom_field_upload_link_9
 * @property string $custom_field_value_10
 * @property string $custom_field_upload_link_10
 * @property string $custom_field_value_11
 * @property string $custom_field_upload_link_11
 * @property string $custom_field_value_12
 * @property string $custom_field_upload_link_12
 * @property string $custom_field_value_13
 * @property string $custom_field_upload_link_13
 * @property string $custom_field_value_14
 * @property string $custom_field_upload_link_14
 * @property string $custom_field_value_15
 * @property string $custom_field_upload_link_15
 * @property string $custom_field_value_16
 * @property string $custom_field_upload_link_16
 * @property string $custom_field_value_17
 * @property string $custom_field_upload_link_17
 * @property string $custom_field_value_18
 * @property string $custom_field_upload_link_18
 * @property string $custom_field_value_19
 * @property string $custom_field_upload_link_19
 * @property string $custom_field_value_20
 * @property string $custom_field_upload_link_20
 * @property string $order_item_notes
 * @property \Cake\I18n\FrozenTime $order_item_created_at
 * @property \Cake\I18n\FrozenTime $order_item_last_updated
 * @property int $order_id
 * @property int $order_customer_id
 * @property string $order_number
 * @property string $order_notes
 * @property string $order_type
 * @property float $order_type_period
 * @property \Cake\I18n\FrozenDate $order_date
 * @property \Cake\I18n\FrozenDate $order_effective_date
 * @property \Cake\I18n\FrozenDate $order_delivery_date
 * @property float $order_subtotal_amount
 * @property string $order_currency
 * @property float $order_discount
 * @property string $order_discount_unit
 * @property \Cake\I18n\FrozenTime $order_created_at
 * @property \Cake\I18n\FrozenTime $order_last_updated
 *
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\Organization $organization
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\OrderCustomer $order_customer
 */
class ProductLastestOrderItem extends Entity
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
        'order_item_number' => true,
        'order_item_unit_price' => true,
        'order_item_unit_quantity' => true,
        'order_item_total' => true,
        'custom_field_value_1' => true,
        'custom_field_upload_link_1' => true,
        'custom_field_value_2' => true,
        'custom_field_upload_link_2' => true,
        'custom_field_value_3' => true,
        'custom_field_upload_link_3' => true,
        'custom_field_value_4' => true,
        'custom_field_upload_link_4' => true,
        'custom_field_value_5' => true,
        'custom_field_upload_link_5' => true,
        'custom_field_value_6' => true,
        'custom_field_upload_link_6' => true,
        'custom_field_value_7' => true,
        'custom_field_upload_link_7' => true,
        'custom_field_value_8' => true,
        'custom_field_upload_link_8' => true,
        'custom_field_value_9' => true,
        'custom_field_upload_link_9' => true,
        'custom_field_value_10' => true,
        'custom_field_upload_link_10' => true,
        'custom_field_value_11' => true,
        'custom_field_upload_link_11' => true,
        'custom_field_value_12' => true,
        'custom_field_upload_link_12' => true,
        'custom_field_value_13' => true,
        'custom_field_upload_link_13' => true,
        'custom_field_value_14' => true,
        'custom_field_upload_link_14' => true,
        'custom_field_value_15' => true,
        'custom_field_upload_link_15' => true,
        'custom_field_value_16' => true,
        'custom_field_upload_link_16' => true,
        'custom_field_value_17' => true,
        'custom_field_upload_link_17' => true,
        'custom_field_value_18' => true,
        'custom_field_upload_link_18' => true,
        'custom_field_value_19' => true,
        'custom_field_upload_link_19' => true,
        'custom_field_value_20' => true,
        'custom_field_upload_link_20' => true,
        'order_item_notes' => true,
        'order_item_created_at' => true,
        'order_item_last_updated' => true,
        'order_id' => true,
        'order_customer_id' => true,
        'order_number' => true,
        'order_notes' => true,
        'order_type' => true,
        'order_type_period' => true,
        'order_date' => true,
        'order_effective_date' => true,
        'order_delivery_date' => true,
        'order_subtotal_amount' => true,
        'order_currency' => true,
        'order_discount' => true,
        'order_discount_unit' => true,
        'order_created_at' => true,
        'order_last_updated' => true,
        'product' => true,
        'organization' => true,
        'order' => true,
        'order_customer' => true
    ];
}
