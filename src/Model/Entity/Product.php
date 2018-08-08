<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property int $organization_id
 * @property int $category_id
 * @property string $name
 * @property string $sku
 * @property string $description
 * @property string $type
 * @property bool $active
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $last_updated
 *
 * @property \App\Model\Entity\Organization $organization
 * @property \App\Model\Entity\ProductCategory $category
 * @property \App\Model\Entity\InvoiceItem[] $invoice_item
 * @property \App\Model\Entity\OrderItem[] $order_item
 * @property \App\Model\Entity\PriceEntry[] $price_entry
 */
class Product extends Entity
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
        'category_id' => true,
        'name' => true,
        'sku' => true,
        'description' => true,
        'type' => true,
        'active' => true,
        'created_at' => true,
        'last_updated' => true,
        'organization' => true,
        'category' => true,
        'invoice_item' => true,
        'order_item' => true,
        'price_entry' => true
    ];
}
