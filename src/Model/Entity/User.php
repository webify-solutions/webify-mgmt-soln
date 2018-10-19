<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property int $organization_id
 * @property string $name
 * @property string $login_name
 * @property string $password
 * @property string $email
 * @property string $phone
 * @property string $fax
 * @property string $logo_url
 * @property string $employee_number
 * @property \Cake\I18n\FrozenDate $start_date
 * @property \Cake\I18n\FrozenDate $end_date
 * @property string $role
 * @property bool $active
 * @property string $mobile_token
 * @property string $device_token
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $last_updated
 * @property \Cake\I18n\FrozenTime $last_logged_in
 *
 * @property \App\Model\Entity\Organization $organization
 * @property \App\Model\Entity\Group[] $group
 */
class User extends Entity
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
        'name' => true,
        'login_name' => true,
        'password' => true,
        'email' => true,
        'phone' => true,
        'fax' => true,
        'logo_url' => true,
        'employee_number' => true,
        'start_date' => true,
        'end_date' => true,
        'role' => true,
        'active' => true,
        'mobile_token' => false,
        'device_token' => true,
        'created_at' => true,
        'last_updated' => true,
        'last_logged_in' => true,
        'organization' => true,
        'group' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
