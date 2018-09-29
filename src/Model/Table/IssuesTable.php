<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Issues Model
 *
 * @property \App\Model\Table\OrganizationTable|\Cake\ORM\Association\BelongsTo $Organization
 * @property \App\Model\Table\CustomerTable|\Cake\ORM\Association\BelongsTo $Customer
 * @property \App\Model\Table\UserTable|\Cake\ORM\Association\BelongsTo $User
 * @property \App\Model\Table\ProductTable|\Cake\ORM\Association\BelongsTo $Product
 *
 * @method \App\Model\Entity\Issue get($primaryKey, $options = [])
 * @method \App\Model\Entity\Issue newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Issue[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Issue|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Issue|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Issue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Issue[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Issue findOrCreate($search, callable $callback = null, $options = [])
 */
class IssuesTable extends Table
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

        $this->setTable('issues');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Organization', [
            'foreignKey' => 'organization_id'
        ]);
        $this->belongsTo('Customer', [
            'foreignKey' => 'customer_id'
        ]);
        $this->belongsTo('User', [
            'foreignKey' => 'technician_id'
        ]);
        $this->belongsTo('Product', [
            'foreignKey' => 'product_id'
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
            ->scalar('issue_number')
            ->maxLength('issue_number', 255)
            ->requirePresence('issue_number', 'create')
            ->notEmpty('issue_number');

        $validator
            ->scalar('status')
            ->maxLength('status', 45)
            ->allowEmpty('status');

        $validator
            ->scalar('type')
            ->allowEmpty('type');

        $validator
            ->scalar('subject')
            ->maxLength('subject', 255)
            ->allowEmpty('subject');

        $validator
            ->scalar('description')
            ->allowEmpty('description');

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
        $rules->add($rules->existsIn(['customer_id'], 'Customer'));
        $rules->add($rules->existsIn(['technician_id'], 'User'));
        $rules->add($rules->existsIn(['product_id'], 'Product'));

        return $rules;
    }
}
