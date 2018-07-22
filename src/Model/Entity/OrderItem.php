<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderItem Entity
 *
 * @property int $id
 * @property int $order_id
 * @property int $price_entry_id
 * @property int $product_id
 * @property int $organization_id
 * @property string $order_item_number
 * @property float $price_discount
 * @property string $notes
 * @property bool $active
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $last_updated
 *
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\PriceEntry $price_entry
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\Organization $organization
 * @property \App\Model\Entity\InvoiceItem[] $invoice_item
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
        'price_entry_id' => true,
        'product_id' => true,
        'organization_id' => true,
        'order_item_number' => true,
        'price_discount' => true,
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
