<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Payment Entity
 *
 * @property int $id
 * @property int $order_id
 * @property int $organization_id
 * @property float $total_amount
 * @property \Cake\I18n\FrozenDate $transaction_date
 * @property bool $void
 * @property \Cake\I18n\FrozenDate $created_at
 * @property int $created_by
 *
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\Organization $organization
 */
class Payment extends Entity
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
        'organization_id' => true,
        'invoice_id' => true,
        'total_amount' => true,
        'transaction_date' => true,
        'void' => true,
        'created_at' => true,
        'created_by' => true,
        'order' => true,
        'organization' => true
    ];
}
