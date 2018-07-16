<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InvoiceItem Model
 *
 * @property \App\Model\Table\InvoiceTable|\Cake\ORM\Association\BelongsTo $Invoice
 * @property \App\Model\Table\OrderItemTable|\Cake\ORM\Association\BelongsTo $OrderItem
 * @property \App\Model\Table\ProductTable|\Cake\ORM\Association\BelongsTo $Product
 * @property \App\Model\Table\OrganizationTable|\Cake\ORM\Association\BelongsTo $Organization
 *
 * @method \App\Model\Entity\InvoiceItem get($primaryKey, $options = [])
 * @method \App\Model\Entity\InvoiceItem newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InvoiceItem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InvoiceItem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InvoiceItem|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InvoiceItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InvoiceItem[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InvoiceItem findOrCreate($search, callable $callback = null, $options = [])
 */
class InvoiceItemTable extends Table
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

        $this->setTable('invoice_item');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Invoice', [
            'foreignKey' => 'invoice_id'
        ]);
        $this->belongsTo('OrderItem', [
            'foreignKey' => 'order_item_id'
        ]);
        $this->belongsTo('Product', [
            'foreignKey' => 'product_id'
        ]);
        $this->belongsTo('Organization', [
            'foreignKey' => 'organization_id'
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
            ->scalar('invoice_item_number')
            ->maxLength('invoice_item_number', 255)
            ->allowEmpty('invoice_item_number');

        $validator
            ->numeric('total_price')
            ->allowEmpty('total_price');

        $validator
            ->scalar('description')
            ->allowEmpty('description');

        $validator
            ->dateTime('created_at')
            ->allowEmpty('created_at');

        $validator
            ->dateTime('last_updated')
            ->allowEmpty('last_updated');

        $validator
            ->integer('last_updated_by')
            ->allowEmpty('last_updated_by');

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
        $rules->add($rules->existsIn(['invoice_id'], 'Invoice'));
        $rules->add($rules->existsIn(['order_item_id'], 'OrderItem'));
        $rules->add($rules->existsIn(['product_id'], 'Product'));
        $rules->add($rules->existsIn(['organization_id'], 'Organization'));

        return $rules;
    }
}
