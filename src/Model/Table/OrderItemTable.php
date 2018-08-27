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
            ->scalar('order_item_number')
            ->maxLength('order_item_number', 255)
            ->allowEmpty('order_item_number', 'create');

        $validator
            ->numeric('unit_price')
            ->notEmpty('unit_price');

        $validator
            ->numeric('unit_quantity')
            ->notEmpty('unit_quantity');

        $validator
            ->numeric('price_discount')
            ->allowEmpty('price_discount');

        $validator
            ->scalar('price_discount_unit')
            ->allowEmpty('price_discount_unit');

        $validator
          ->numeric('total')
          ->allowEmpty('total');

        $validator
            ->scalar('custom_field_1')
            ->maxLength('custom_field_1', 255)
            ->allowEmpty('custom_field_1');

        $validator
            ->scalar('custom_field_upload_link_1', [])
            ->allowEmpty('custom_field_upload_link_1');

        $validator
            ->scalar('custom_field_2')
            ->maxLength('custom_field_2', 255)
            ->allowEmpty('custom_field_2');

        $validator
            ->scalar('custom_field_upload_link_2', [])
            ->allowEmpty('custom_field_upload_link_2');

        $validator
            ->scalar('custom_field_3')
            ->maxLength('custom_field_3', 255)
            ->allowEmpty('custom_field_3');

        $validator
            ->scalar('custom_field_upload_link_3', [])
            ->allowEmpty('custom_field_upload_link_3');

        $validator
            ->scalar('custom_field_4')
            ->maxLength('custom_field_4', 255)
            ->allowEmpty('custom_field_4');

        $validator
            ->scalar('custom_field_upload_link_4', [])
            ->allowEmpty('custom_field_upload_link_4');

        $validator
            ->scalar('custom_field_5')
            ->maxLength('custom_field_5', 255)
            ->allowEmpty('custom_field_5');

        $validator
            ->scalar('custom_field_upload_link_5', [])
            ->allowEmpty('custom_field_upload_link_5');

        $validator
            ->scalar('custom_field_6')
            ->maxLength('custom_field_6', 255)
            ->allowEmpty('custom_field_6');

        $validator
            ->scalar('custom_field_upload_link_6', [])
            ->allowEmpty('custom_field_upload_link_6');

        $validator
            ->scalar('custom_field_7')
            ->maxLength('custom_field_7', 255)
            ->allowEmpty('custom_field_7');

        $validator
            ->scalar('custom_field_upload_link_7', [])
            ->allowEmpty('custom_field_upload_link_7');

        $validator
            ->scalar('custom_field_8')
            ->maxLength('custom_field_8', 255)
            ->allowEmpty('custom_field_8');

        $validator
            ->scalar('custom_field_upload_link_8', [])
            ->allowEmpty('custom_field_upload_link_8');

        $validator
            ->scalar('custom_field_9')
            ->maxLength('custom_field_9', 255)
            ->allowEmpty('custom_field_9');

        $validator
            ->scalar('custom_field_upload_link_9', [])
            ->allowEmpty('custom_field_upload_link_9');

        $validator
            ->scalar('custom_field_10')
            ->maxLength('custom_field_10', 255)
            ->allowEmpty('custom_field_10');

        $validator
            ->scalar('custom_field_upload_link_10', [])
            ->allowEmpty('custom_field_upload_link_10');

        $validator
            ->scalar('custom_field_11')
            ->maxLength('custom_field_11', 255)
            ->allowEmpty('custom_field_11');

        $validator
            ->scalar('custom_field_upload_link_11', [])
            ->allowEmpty('custom_field_upload_link_11');

        $validator
            ->scalar('custom_field_12')
            ->maxLength('custom_field_12', 255)
            ->allowEmpty('custom_field_12');

        $validator
            ->scalar('custom_field_upload_link_12', [])
            ->allowEmpty('custom_field_upload_link_12');

        $validator
            ->scalar('custom_field_13')
            ->maxLength('custom_field_13', 255)
            ->allowEmpty('custom_field_13');

        $validator
            ->scalar('custom_field_upload_link_13', [])
            ->allowEmpty('custom_field_upload_link_13');

        $validator
            ->scalar('custom_field_14')
            ->maxLength('custom_field_14', 255)
            ->allowEmpty('custom_field_14');

        $validator
            ->scalar('custom_field_upload_link_14', [])
            ->allowEmpty('custom_field_upload_link_14');

        $validator
            ->scalar('custom_field_15')
            ->maxLength('custom_field_15', 255)
            ->allowEmpty('custom_field_15');

        $validator
            ->scalar('custom_field_upload_link_15', [])
            ->allowEmpty('custom_field_upload_link_15');

        $validator
            ->scalar('custom_field_16')
            ->maxLength('custom_field_16', 255)
            ->allowEmpty('custom_field_16');

        $validator
            ->scalar('custom_field_upload_link_16', [])
            ->allowEmpty('custom_field_upload_link_16');

        $validator
            ->scalar('custom_field_17')
            ->maxLength('custom_field_17', 255)
            ->allowEmpty('custom_field_17');

        $validator
            ->scalar('custom_field_upload_link_17', [])
            ->allowEmpty('custom_field_upload_link_17');

        $validator
            ->scalar('custom_field_18')
            ->maxLength('custom_field_18', 255)
            ->allowEmpty('custom_field_18');

        $validator
            ->scalar('custom_field_upload_link_18', [])
            ->allowEmpty('custom_field_upload_link_18');

        $validator
            ->scalar('custom_field_19')
            ->maxLength('custom_field_19', 255)
            ->allowEmpty('custom_field_19');

        $validator
            ->scalar('custom_field_upload_link_19', [])
            ->allowEmpty('custom_field_upload_link_19');

        $validator
            ->scalar('custom_field_20')
            ->maxLength('custom_field_20', 255)
            ->allowEmpty('custom_field_20');

        $validator
            ->scalar('custom_field_upload_link_20', [])
            ->allowEmpty('custom_field_upload_link_20');

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
