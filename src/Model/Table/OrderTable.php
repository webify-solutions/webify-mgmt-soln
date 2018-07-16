<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Order Model
 *
 * @property \App\Model\Table\CustomerTable|\Cake\ORM\Association\BelongsTo $Customer
 * @property \App\Model\Table\OrganizationTable|\Cake\ORM\Association\BelongsTo $Organization
 * @property \App\Model\Table\InvoiceTable|\Cake\ORM\Association\HasMany $Invoice
 * @property \App\Model\Table\OrderItemTable|\Cake\ORM\Association\HasMany $OrderItem
 * @property \App\Model\Table\PaymentTable|\Cake\ORM\Association\HasMany $Payment
 *
 * @method \App\Model\Entity\Order get($primaryKey, $options = [])
 * @method \App\Model\Entity\Order newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Order[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Order|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Order[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Order findOrCreate($search, callable $callback = null, $options = [])
 */
class OrderTable extends Table
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

        $this->setTable('order');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Customer', [
            'foreignKey' => 'customer_id'
        ]);
        $this->belongsTo('Organization', [
            'foreignKey' => 'organization_id'
        ]);
        $this->hasMany('Invoice', [
            'foreignKey' => 'order_id'
        ]);
        $this->hasMany('OrderItem', [
            'foreignKey' => 'order_id'
        ]);
        $this->hasMany('Payment', [
            'foreignKey' => 'order_id'
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
            ->scalar('order_number')
            ->maxLength('order_number', 255)
            ->allowEmpty('order_number');

        $validator
            ->scalar('description')
            ->allowEmpty('description');

        $validator
            ->date('effective_date')
            ->allowEmpty('effective_date');

        $validator
            ->scalar('type')
            ->allowEmpty('type');

        $validator
            ->numeric('total_amount')
            ->allowEmpty('total_amount');

        $validator
            ->numeric('total_discount')
            ->allowEmpty('total_discount');

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
        $rules->add($rules->existsIn(['customer_id'], 'Customer'));
        $rules->add($rules->existsIn(['organization_id'], 'Organization'));

        return $rules;
    }
}
