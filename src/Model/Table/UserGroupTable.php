<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserGroup Model
 *
 * @property \App\Model\Table\OrganizationTable|\Cake\ORM\Association\BelongsTo $Organization
 * @property \App\Model\Table\UserTable|\Cake\ORM\Association\BelongsTo $User
 * @property \App\Model\Table\GroupTable|\Cake\ORM\Association\BelongsTo $Group
 *
 * @method \App\Model\Entity\UserGroup get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserGroup newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserGroup[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserGroup|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserGroup|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserGroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserGroup[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserGroup findOrCreate($search, callable $callback = null, $options = [])
 */
class UserGroupTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('user_group');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Organization', [
            'foreignKey' => 'organization_id'
        ]);
        $this->belongsTo('User', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('Group', [
            'foreignKey' => 'group_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->dateTime('created_at')
            ->allowEmpty('created_at');

        $validator
            ->dateTime('last_updated')
            ->allowEmpty('last_updated');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['organization_id'], 'Organization'));
        $rules->add($rules->existsIn(['user_id'], 'User'));
        $rules->add($rules->existsIn(['group_id'], 'Group'));

        return $rules;
    }
}
