<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PriceEntry Entity
 *
 * @property int $id
 * @property int $product_id
 * @property int $organization_id
 * @property float $price
 * @property string $available_discount
 * @property bool $active
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $last_updated
 *
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\Organization $organization
 * @property \App\Model\Entity\OrderItem[] $order_item
 */
class PriceEntry extends Entity
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
        'price' => true,
        'available_discount' => true,
        'active' => true,
        'created_at' => true,
        'last_updated' => true,
        'product' => true,
        'organization' => true,
        'order_item' => true
    ];
}
