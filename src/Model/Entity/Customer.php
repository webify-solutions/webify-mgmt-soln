<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Customer Entity
 *
 * @property int $id
 * @property int $group_id
 * @property int $organization_id
 * @property int $org_cust_num
 * @property string $customer_number
 * @property string $login_name
 * @property string $title
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property float $longitude
 * @property float $latitude
 * @property bool $active
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $last_updated
 *
 * @property \App\Model\Entity\Group $group
 * @property \App\Model\Entity\Organization $organization
 * @property \App\Model\Entity\Order[] $order
 * @property \App\Model\Entity\Issue[] $issues
 */
class Customer extends Entity
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
        'group_id' => true,
        'organization_id' => true,
        'org_cust_num' => true,
        'customer_number' => true,
        'login_name' => true,
        'title' => true,
        'name' => true,
        'email' => true,
        'phone' => true,
        'address' => true,
        'longitude' => true,
        'latitude' => true,
        'active' => true,
        'created_at' => true,
        'last_updated' => true,
        'group' => true,
        'organization' => true,
        'order' => true,
        'issues' => true
    ];
}
