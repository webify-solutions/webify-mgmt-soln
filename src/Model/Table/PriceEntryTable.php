<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PriceEntry Model
 *
 * @property \App\Model\Table\ProductTable|\Cake\ORM\Association\BelongsTo $Product
 * @property \App\Model\Table\OrganizationTable|\Cake\ORM\Association\BelongsTo $Organization
 * @property \App\Model\Table\OrderItemTable|\Cake\ORM\Association\HasMany $OrderItem
 *
 * @method \App\Model\Entity\PriceEntry get($primaryKey, $options = [])
 * @method \App\Model\Entity\PriceEntry newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PriceEntry[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PriceEntry|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PriceEntry|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PriceEntry patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PriceEntry[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PriceEntry findOrCreate($search, callable $callback = null, $options = [])
 */
class PriceEntryTable extends Table
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

        $this->addBehavior('PriceEntry');

        $this->setTable('price_entry');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Product', [
            'foreignKey' => 'product_id'
        ]);
        $this->belongsTo('Organization', [
            'foreignKey' => 'organization_id'
        ]);
        $this->hasMany('OrderItem', [
            'foreignKey' => 'price_entry_id'
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
            ->integer('product_id')
            ->notEmpty('product_id');

        $validator
            ->scalar('price_entry_number')
            ->allowEmpty('price_entry_number');

        $validator
            ->numeric('price')
            ->notEmpty('price');

        $validator
            ->scalar('currency')
            ->maxLength('currency', 45)
            ->allowEmpty('currency');

        $validator
            ->numeric('available_discount')
            ->allowEmpty('available_discount');

        $validator
            ->scalar('available_discount_unit')
            ->maxLength('available_discount_unit', 45)
            ->allowEmpty('available_discount_unit');

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
        $rules->add($rules->existsIn(['product_id'], 'Product'));
        $rules->add($rules->existsIn(['organization_id'], 'Organization'));

        return $rules;
    }
}
