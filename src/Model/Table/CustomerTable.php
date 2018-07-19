<?php
namespace App\Model\Table;

use ArrayObject;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use Cake\Datasource\EntityInterface;


/**
 * Customer Model
 *
 * @property \App\Model\Table\GroupTable|\Cake\ORM\Association\BelongsTo $Group
 * @property \App\Model\Table\OrganizationTable|\Cake\ORM\Association\BelongsTo $Organization
 * @property \App\Model\Table\OrderTable|\Cake\ORM\Association\HasMany $Order
 * @property \App\Model\Table\SupportCaseTable|\Cake\ORM\Association\HasMany $SupportCase
 *
 * @method \App\Model\Entity\Customer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Customer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Customer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Customer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Customer|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Customer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Customer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Customer findOrCreate($search, callable $callback = null, $options = [])
 */
class CustomerTable extends Table
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

        $this->setTable('customer');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->belongsTo('Group', [
            'foreignKey' => 'group_id'
        ]);
        $this->belongsTo('Organization', [
            'foreignKey' => 'organization_id'
        ]);
        $this->hasMany('Order', [
            'foreignKey' => 'customer_id'
        ]);
        $this->hasMany('SupportCase', [
            'foreignKey' => 'customer_id'
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
            ->scalar('customer_number')
            ->maxLength('customer_number', 255)
            ->allowEmpty('customer_number');

        $validator
            ->scalar('title')
            ->maxLength('title', 20)
            ->allowEmpty('title');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 20)
            ->allowEmpty('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 20)
            ->allowEmpty('last_name');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 20)
            ->allowEmpty('phone');

        $validator
            ->scalar('address')
            ->maxLength('address', 255)
            ->allowEmpty('address');

        $validator
            ->numeric('longitude')
            ->allowEmpty('longitude');

        $validator
            ->numeric('latitude')
            ->allowEmpty('latitude');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

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
        $rules->add($rules->existsIn(['group_id'], 'Group'));
        $rules->add($rules->existsIn(['organization_id'], 'Organization'));

        return $rules;
    }

    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        debug($entity);

        if($entity->get('customer_number') == null) {
            $customerNumber = uniqid("C-", false);
            $entity->set('customer_number', __($customerNumber));
        }
    }
}
