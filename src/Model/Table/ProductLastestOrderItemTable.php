<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductLastestOrderItem Model
 *
 * @property \App\Model\Table\ProductsTable|\Cake\ORM\Association\BelongsTo $Products
 * @property \App\Model\Table\OrganizationsTable|\Cake\ORM\Association\BelongsTo $Organizations
 * @property \App\Model\Table\OrdersTable|\Cake\ORM\Association\BelongsTo $Orders
 * @property \App\Model\Table\OrderCustomersTable|\Cake\ORM\Association\BelongsTo $OrderCustomers
 *
 * @method \App\Model\Entity\ProductLastestOrderItem get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProductLastestOrderItem newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProductLastestOrderItem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductLastestOrderItem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductLastestOrderItem|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductLastestOrderItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProductLastestOrderItem[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductLastestOrderItem findOrCreate($search, callable $callback = null, $options = [])
 */
class ProductLastestOrderItemTable extends Table
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

        $this->setTable('product_lastest_order_item');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Organizations', [
            'foreignKey' => 'organization_id'
        ]);
        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('OrderCustomers', [
            'foreignKey' => 'order_customer_id'
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
            ->scalar('product_name')
            ->maxLength('product_name', 255)
            ->requirePresence('product_name', 'create')
            ->notEmpty('product_name');

        $validator
            ->scalar('product_sku')
            ->maxLength('product_sku', 255)
            ->requirePresence('product_sku', 'create')
            ->notEmpty('product_sku');

        $validator
            ->scalar('product_description')
            ->allowEmpty('product_description');

        $validator
            ->dateTime('product_created_at')
            ->allowEmpty('product_created_at');

        $validator
            ->dateTime('product_last_updated')
            ->allowEmpty('product_last_updated');

        $validator
            ->scalar('order_item_number')
            ->maxLength('order_item_number', 255)
            ->allowEmpty('order_item_number');

        $validator
            ->numeric('order_item_unit_price')
            ->requirePresence('order_item_unit_price', 'create')
            ->notEmpty('order_item_unit_price');

        $validator
            ->numeric('order_item_unit_quantity')
            ->requirePresence('order_item_unit_quantity', 'create')
            ->notEmpty('order_item_unit_quantity');

        $validator
            ->numeric('order_item_total')
            ->allowEmpty('order_item_total');

        $validator
            ->scalar('custom_field_value_1')
            ->maxLength('custom_field_value_1', 255)
            ->allowEmpty('custom_field_value_1');

        $validator
            ->scalar('custom_field_upload_link_1')
            ->allowEmpty('custom_field_upload_link_1');

        $validator
            ->scalar('custom_field_value_2')
            ->maxLength('custom_field_value_2', 255)
            ->allowEmpty('custom_field_value_2');

        $validator
            ->scalar('custom_field_upload_link_2')
            ->allowEmpty('custom_field_upload_link_2');

        $validator
            ->scalar('custom_field_value_3')
            ->maxLength('custom_field_value_3', 255)
            ->allowEmpty('custom_field_value_3');

        $validator
            ->scalar('custom_field_upload_link_3')
            ->allowEmpty('custom_field_upload_link_3');

        $validator
            ->scalar('custom_field_value_4')
            ->maxLength('custom_field_value_4', 255)
            ->allowEmpty('custom_field_value_4');

        $validator
            ->scalar('custom_field_upload_link_4')
            ->allowEmpty('custom_field_upload_link_4');

        $validator
            ->scalar('custom_field_value_5')
            ->maxLength('custom_field_value_5', 255)
            ->allowEmpty('custom_field_value_5');

        $validator
            ->scalar('custom_field_upload_link_5')
            ->allowEmpty('custom_field_upload_link_5');

        $validator
            ->scalar('custom_field_value_6')
            ->maxLength('custom_field_value_6', 255)
            ->allowEmpty('custom_field_value_6');

        $validator
            ->scalar('custom_field_upload_link_6')
            ->allowEmpty('custom_field_upload_link_6');

        $validator
            ->scalar('custom_field_value_7')
            ->maxLength('custom_field_value_7', 255)
            ->allowEmpty('custom_field_value_7');

        $validator
            ->scalar('custom_field_upload_link_7')
            ->allowEmpty('custom_field_upload_link_7');

        $validator
            ->scalar('custom_field_value_8')
            ->maxLength('custom_field_value_8', 255)
            ->allowEmpty('custom_field_value_8');

        $validator
            ->scalar('custom_field_upload_link_8')
            ->allowEmpty('custom_field_upload_link_8');

        $validator
            ->scalar('custom_field_value_9')
            ->maxLength('custom_field_value_9', 255)
            ->allowEmpty('custom_field_value_9');

        $validator
            ->scalar('custom_field_upload_link_9')
            ->allowEmpty('custom_field_upload_link_9');

        $validator
            ->scalar('custom_field_value_10')
            ->maxLength('custom_field_value_10', 255)
            ->allowEmpty('custom_field_value_10');

        $validator
            ->scalar('custom_field_upload_link_10')
            ->allowEmpty('custom_field_upload_link_10');

        $validator
            ->scalar('custom_field_value_11')
            ->maxLength('custom_field_value_11', 255)
            ->allowEmpty('custom_field_value_11');

        $validator
            ->scalar('custom_field_upload_link_11')
            ->allowEmpty('custom_field_upload_link_11');

        $validator
            ->scalar('custom_field_value_12')
            ->maxLength('custom_field_value_12', 255)
            ->allowEmpty('custom_field_value_12');

        $validator
            ->scalar('custom_field_upload_link_12')
            ->allowEmpty('custom_field_upload_link_12');

        $validator
            ->scalar('custom_field_value_13')
            ->maxLength('custom_field_value_13', 255)
            ->allowEmpty('custom_field_value_13');

        $validator
            ->scalar('custom_field_upload_link_13')
            ->allowEmpty('custom_field_upload_link_13');

        $validator
            ->scalar('custom_field_value_14')
            ->maxLength('custom_field_value_14', 255)
            ->allowEmpty('custom_field_value_14');

        $validator
            ->scalar('custom_field_upload_link_14')
            ->allowEmpty('custom_field_upload_link_14');

        $validator
            ->scalar('custom_field_value_15')
            ->maxLength('custom_field_value_15', 255)
            ->allowEmpty('custom_field_value_15');

        $validator
            ->scalar('custom_field_upload_link_15')
            ->allowEmpty('custom_field_upload_link_15');

        $validator
            ->scalar('custom_field_value_16')
            ->maxLength('custom_field_value_16', 255)
            ->allowEmpty('custom_field_value_16');

        $validator
            ->scalar('custom_field_upload_link_16')
            ->allowEmpty('custom_field_upload_link_16');

        $validator
            ->scalar('custom_field_value_17')
            ->maxLength('custom_field_value_17', 255)
            ->allowEmpty('custom_field_value_17');

        $validator
            ->scalar('custom_field_upload_link_17')
            ->allowEmpty('custom_field_upload_link_17');

        $validator
            ->scalar('custom_field_value_18')
            ->maxLength('custom_field_value_18', 255)
            ->allowEmpty('custom_field_value_18');

        $validator
            ->scalar('custom_field_upload_link_18')
            ->allowEmpty('custom_field_upload_link_18');

        $validator
            ->scalar('custom_field_value_19')
            ->maxLength('custom_field_value_19', 255)
            ->allowEmpty('custom_field_value_19');

        $validator
            ->scalar('custom_field_upload_link_19')
            ->allowEmpty('custom_field_upload_link_19');

        $validator
            ->scalar('custom_field_value_20')
            ->maxLength('custom_field_value_20', 225)
            ->allowEmpty('custom_field_value_20');

        $validator
            ->scalar('custom_field_upload_link_20')
            ->allowEmpty('custom_field_upload_link_20');

        $validator
            ->scalar('order_item_notes')
            ->allowEmpty('order_item_notes');

        $validator
            ->dateTime('order_item_created_at')
            ->requirePresence('order_item_created_at', 'create')
            ->notEmpty('order_item_created_at');

        $validator
            ->dateTime('order_item_last_updated')
            ->requirePresence('order_item_last_updated', 'create')
            ->notEmpty('order_item_last_updated');

        $validator
            ->scalar('order_number')
            ->maxLength('order_number', 255)
            ->requirePresence('order_number', 'create')
            ->notEmpty('order_number');

        $validator
            ->scalar('order_notes')
            ->allowEmpty('order_notes');

        $validator
            ->scalar('order_type')
            ->maxLength('order_type', 50)
            ->requirePresence('order_type', 'create')
            ->notEmpty('order_type');

        $validator
            ->numeric('order_type_period')
            ->allowEmpty('order_type_period');

        $validator
            ->date('order_date')
            ->allowEmpty('order_date');

        $validator
            ->date('order_effective_date')
            ->allowEmpty('order_effective_date');

        $validator
            ->date('order_delivery_date')
            ->allowEmpty('order_delivery_date');

        $validator
            ->numeric('order_subtotal_amount')
            ->allowEmpty('order_subtotal_amount');

        $validator
            ->scalar('order_currency')
            ->maxLength('order_currency', 45)
            ->allowEmpty('order_currency');

        $validator
            ->numeric('order_discount')
            ->allowEmpty('order_discount');

        $validator
            ->scalar('order_discount_unit')
            ->maxLength('order_discount_unit', 45)
            ->allowEmpty('order_discount_unit');

        $validator
            ->dateTime('order_created_at')
            ->requirePresence('order_created_at', 'create')
            ->notEmpty('order_created_at');

        $validator
            ->dateTime('order_last_updated')
            ->allowEmpty('order_last_updated');

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
        $rules->add($rules->existsIn(['product_id'], 'Products'));
        $rules->add($rules->existsIn(['organization_id'], 'Organizations'));
        $rules->add($rules->existsIn(['order_id'], 'Orders'));
        $rules->add($rules->existsIn(['order_customer_id'], 'OrderCustomers'));

        return $rules;
    }
}
