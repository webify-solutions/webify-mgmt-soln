<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InvoiceItem Entity
 *
 * @property int $id
 * @property int $invoice_id
 * @property int $order_item_id
 * @property int $product_id
 * @property int $organization_id
 * @property string $invoice_item_number
 * @property float $total_price
 * @property string $description
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $last_updated
 * @property int $last_updated_by
 *
 * @property \App\Model\Entity\Invoice $invoice
 * @property \App\Model\Entity\OrderItem $order_item
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\Organization $organization
 */
class InvoiceItem extends Entity
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
        'invoice_id' => true,
        'order_item_id' => true,
        'product_id' => true,
        'organization_id' => true,
        'invoice_item_number' => true,
        'total_price' => true,
        'description' => true,
        'created_at' => true,
        'last_updated' => true,
        'last_updated_by' => true,
        'invoice' => true,
        'order_item' => true,
        'product' => true,
        'organization' => true
    ];
}
