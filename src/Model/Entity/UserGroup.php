<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserGroup Entity
 *
 * @property int $id
 * @property int $organization_id
 * @property int $user_id
 * @property int $group_id
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $last_updated
 *
 * @property \App\Model\Entity\Organization $organization
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Group $group
 */
class UserGroup extends Entity
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
        'user_id' => true,
        'group_id' => true,
        'created_at' => true,
        'last_updated' => true,
        'organization' => true,
        'user' => true,
        'group' => true
    ];
}
