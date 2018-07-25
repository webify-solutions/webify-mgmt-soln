<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderItem Model
 *
 * @property \App\Model\Table\OrderTable|\Cake\ORM\Association\BelongsTo $Order
 * @property \App\Model\Table\PriceEntryTable|\Cake\ORM\Association\BelongsTo $PriceEntry
 * @property \App\Model\Table\ProductTable|\Cake\ORM\Association\BelongsTo $Product
 * @property \App\Model\Table\OrganizationTable|\Cake\ORM\Association\BelongsTo $Organization
 * @property \App\Model\Table\InvoiceItemTable|\Cake\ORM\Association\HasMany $InvoiceItem
 *
 * @method \App\Model\Entity\OrderItem get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrderItem newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OrderItem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrderItem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderItem|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrderItem[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrderItem findOrCreate($search, callable $callback = null, $options = [])
 */
class OrderItemTable extends Table
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

        $this->addBehavior('OrderItem');

        $this->setTable('order_item');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Order', [
            'foreignKey' => 'order_id'
        ]);
        $this->belongsTo('PriceEntry', [
            'foreignKey' => 'price_entry_id'
        ]);
        $this->belongsTo('Product', [
            'foreignKey' => 'product_id'
        ]);
        $this->belongsTo('Organization', [
            'foreignKey' => 'organization_id'
        ]);
        $this->hasMany('InvoiceItem', [
            'foreignKey' => 'order_item_id'
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
            ->integer('order_id')
            ->notEmpty('order_id');

        $validator
            ->integer('product_id')
            ->notEmpty('product_id');

        $validator
            ->integer('price_entry_id')
            ->notEmpty('price_entry_id');

        $validator
            ->scalar('order_item_number')
            ->maxLength('order_item_number', 255)
            ->allowEmpty('order_item_number');

        $validator
            ->numeric('price_discount')
            ->allowEmpty('price_discount');

        $validator
            ->scalar('price_discount_unit')
            ->allowEmpty('price_discount_unit');

        $validator
            ->scalar('notes')
            ->allowEmpty('notes');

        $validator
            ->boolean('active')
            ->allowEmpty('active', 'create');

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
        $rules->add($rules->existsIn(['order_id'], 'Order'));
        $rules->add($rules->existsIn(['price_entry_id'], 'PriceEntry'));
        $rules->add($rules->existsIn(['product_id'], 'Product'));
        $rules->add($rules->existsIn(['organization_id'], 'Organization'));

        return $rules;
    }
}
