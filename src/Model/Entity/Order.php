<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property int $customer_id
 * @property int $organization_id
 * @property string $order_number
 * @property string $notes
 * @property \Cake\I18n\FrozenDate $effective_date
 * @property \Cake\I18n\FrozenDate $order_date
 * @property \Cake\I18n\FrozenDate $delivery_date
 * @property string $type
 * @property int $type_period
 * @property float $subtotal_amount
 * @property string $currency
 * @property float $order_discount
 * @property string $order_discount_unit
 * @property bool $active
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $last_updated
 *
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\Organization $organization
 * @property \App\Model\Entity\Invoice[] $invoice
 * @property \App\Model\Entity\OrderItem[] $order_item
 * @property \App\Model\Entity\Payment[] $payment
 */
class Order extends Entity
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
        'customer_id' => true,
        'organization_id' => true,
        'order_number' => true,
        'notes' => true,
        'type' => true,
        'type_period' => true,
        'order_date' => true,
        'effective_date' => true,
        'delivery_date' => true,
        'subtotal_amount' => true,
        'currency' => true,
        'order_discount' => true,
        'order_discount_unit' => true,
        'active' => true,
        'created_at' => true,
        'last_updated' => true,
        'customer' => true,
        'organization' => true,
        'invoice' => true,
        'order_item' => true,
        'payment' => true
    ];
}
