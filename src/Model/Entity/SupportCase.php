<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SupportCase Entity
 *
 * @property int $id
 * @property int $customer_id
 * @property int $organization_id
 * @property string $customer_number
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $type
 * @property string $subject
 * @property string $description
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $last_updated
 *
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\Organization $organization
 */
class SupportCase extends Entity
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
        'customer_number' => true,
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'phone' => true,
        'type' => true,
        'subject' => true,
        'description' => true,
        'created_at' => true,
        'last_updated' => true,
        'customer' => true,
        'organization' => true
    ];
}
