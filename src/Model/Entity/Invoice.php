<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Invoice Entity
 *
 * @property int $id
 * @property int $order_id
 * @property int $organization_id
 * @property string $invoice_number
 * @property \Cake\I18n\FrozenDate $start_date
 * @property \Cake\I18n\FrozenDate $end_date
 * @property float $total_price
 * @property string $description
 * @property \Cake\I18n\FrozenDate $created_at
 * @property \Cake\I18n\FrozenTime $last_updated
 * @property int $last_updated_by
 *
 * @property \App\Model\Entity\Organization $organization
 * @property \App\Model\Entity\InvoiceItem[] $invoice_item
 */
class Invoice extends Entity
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
        'invoice_number' => true,
        'start_date' => true,
        'end_date' => true,
        'total_price' => true,
        'description' => true,
        'created_at' => true,
        'last_updated' => true,
        'last_updated_by' => true,
        'organization' => true,
        'invoice_item' => true
    ];
}
