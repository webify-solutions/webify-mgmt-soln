<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderItem Entity
 *
 * @property int id
 * @property int order_id
 * @property int product_id
 * @property int organization_id
 * @property string order_item_number
 * @property float unit_price
 * @property float unit_quantity
 * @property float price_discount
 * @property string price_discount_unit
 * @property float total
 * @property string custom_field_1
 * @property string custom_field_2
 * @property string custom_field_3
 * @property string custom_field_4
 * @property string custom_field_5
 * @property string custom_field_6
 * @property string custom_field_7
 * @property string custom_field_8
 * @property string custom_field_9
 * @property string custom_field_10
 * @property string custom_field_11
 * @property string custom_field_12
 * @property string custom_field_13
 * @property string custom_field_14
 * @property string custom_field_15
 * @property string custom_field_16
 * @property string custom_field_17
 * @property string custom_field_18
 * @property string custom_field_19
 * @property string custom_field_20
 * @property string notes
 * @property bool active
 * @property \Cake\I18n\FrozenTime created_at
 * @property \Cake\I18n\FrozenTime last_updated
 *
 * @property \App\Model\Entity\Order order
 * @property \App\Model\Entity\PriceEntry price_entry
 * @property \App\Model\Entity\Product product
 * @property \App\Model\Entity\Organization organization
 * @property \App\Model\Entity\InvoiceItem[] invoice_item
 */
class OrderItem extends Entity
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
        'order_id' => true,
        'product_id' => true,
        'organization_id' => true,
        'order_item_number' => true,
        'unit_price' => true,
        'unit_quantity' => true,
        'price_discount' => true,
        'price_discount_unit' => true,
        'total' => true,
        'custom_field_1' => true,
        'custom_field_2' => true,
        'custom_field_3' => true,
        'custom_field_4' => true,
        'custom_field_5' => true,
        'custom_field_6' => true,
        'custom_field_7' => true,
        'custom_field_8' => true,
        'custom_field_9' => true,
        'custom_field_10' => true,
        'custom_field_11' => true,
        'custom_field_12' => true,
        'custom_field_13' => true,
        'custom_field_14' => true,
        'custom_field_15' => true,
        'custom_field_16' => true,
        'custom_field_17' => true,
        'custom_field_18' => true,
        'custom_field_19' => true,
        'custom_field_20' => true,
        'notes' => true,
        'active' => true,
        'created_at' => true,
        'last_updated' => true,
        'order' => true,
        'price_entry' => true,
        'product' => true,
        'organization' => true,
        'invoice_item' => true
    ];
}
