<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Issue Entity
 *
 * @property int $id
 * @property int $organization_id
 * @property int $customer_id
 * @property int $technician_id
 * @property int $product_id
 * @property string $issue_number
 * @property string $status
 * @property string $type
 * @property string $subject
 * @property string $description
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $last_updated
 *
 * @property \App\Model\Entity\Organization $organization
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Product $product
 */
class Issue extends Entity
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
        'customer_id' => true,
        'technician_id' => true,
        'product_id' => true,
        'issue_number' => true,
        'status' => true,
        'type' => true,
        'subject' => true,
        'description' => true,
        'created_at' => true,
        'last_updated' => true,
        'organization' => true,
        'customer' => true,
        'user' => true,
        'product' => true
    ];
}
