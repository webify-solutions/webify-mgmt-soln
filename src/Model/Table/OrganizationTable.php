<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Organization Model
 *
 * @property \App\Model\Table\CustomerTable|\Cake\ORM\Association\HasMany $Customer
 * @property \App\Model\Table\GroupTable|\Cake\ORM\Association\HasMany $Group
 * @property \App\Model\Table\InvoiceTable|\Cake\ORM\Association\HasMany $Invoice
 * @property \App\Model\Table\InvoiceItemTable|\Cake\ORM\Association\HasMany $InvoiceItem
 * @property \App\Model\Table\OrderTable|\Cake\ORM\Association\HasMany $Order
 * @property \App\Model\Table\OrderItemTable|\Cake\ORM\Association\HasMany $OrderItem
 * @property \App\Model\Table\PaymentTable|\Cake\ORM\Association\HasMany $Payment
 * @property \App\Model\Table\PriceEntryTable|\Cake\ORM\Association\HasMany $PriceEntry
 * @property \App\Model\Table\ProductTable|\Cake\ORM\Association\HasMany $Product
 * @property \App\Model\Table\SupportCaseTable|\Cake\ORM\Association\HasMany $SupportCase
 * @property \App\Model\Table\UserTable|\Cake\ORM\Association\HasMany $User
 * @property \App\Model\Table\UserGroupTable|\Cake\ORM\Association\HasMany $UserGroup
 *
 * @method \App\Model\Entity\Organization get($primaryKey, $options = [])
 * @method \App\Model\Entity\Organization newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Organization[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Organization|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Organization|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Organization patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Organization[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Organization findOrCreate($search, callable $callback = null, $options = [])
 */
class OrganizationTable extends Table
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

        $this->setTable('organization');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Customer', [
            'foreignKey' => 'organization_id'
        ]);
        $this->hasMany('Group', [
            'foreignKey' => 'organization_id'
        ]);
        $this->hasMany('Invoice', [
            'foreignKey' => 'organization_id'
        ]);
        $this->hasMany('InvoiceItem', [
            'foreignKey' => 'organization_id'
        ]);
        $this->hasMany('Order', [
            'foreignKey' => 'organization_id'
        ]);
        $this->hasMany('OrderItem', [
            'foreignKey' => 'organization_id'
        ]);
        $this->hasMany('Payment', [
            'foreignKey' => 'organization_id'
        ]);
        $this->hasMany('PriceEntry', [
            'foreignKey' => 'organization_id'
        ]);
        $this->hasMany('Product', [
            'foreignKey' => 'organization_id'
        ]);
        $this->hasMany('SupportCase', [
            'foreignKey' => 'organization_id'
        ]);
        $this->hasMany('User', [
            'foreignKey' => 'organization_id'
        ]);
        $this->hasMany('UserGroup', [
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->notEmpty('name');

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
            ->scalar('currency_used')
            ->maxLength('currency_used', 45)
            ->notEmpty('currency_used');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        $validator
            ->boolean('active_product_feature')
            ->requirePresence('active_product_feature', 'create')
            ->notEmpty('active_product_feature');

        $validator
            ->boolean('active_order_feature')
            ->requirePresence('active_order_feature', 'create')
            ->notEmpty('active_order_feature');

        $validator
            ->boolean('active_invoicing_feature')
            ->requirePresence('active_invoicing_feature', 'create')
            ->notEmpty('active_invoicing_feature');

        $validator
            ->boolean('active_case_feature')
            ->allowEmpty('active_case_feature');

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
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
