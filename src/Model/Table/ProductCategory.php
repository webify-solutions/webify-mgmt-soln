<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Product Model
 *
 * @property \App\Model\Table\OrganizationTable|\Cake\ORM\Association\BelongsTo $Organization
 * @property \App\Model\Table\ProductTable|\Cake\ORM\Association\HasMany $Product
 *
 * @method \App\Model\Entity\ProductCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProductCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProductCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductCategory|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProductCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductCategory findOrCreate($search, callable $callback = null, $options = [])
 */
 class ProductCategoryTable extends Table
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

     $this->setTable('product_category');
     $this->setDisplayField('name');
     $this->setPrimaryKey('id');

     $this->belongsTo('Organization', [
       'foreignKey' => 'organization_id'
     ]);
     $this->hasMany('Product', [
         'foreignKey' => 'category_id'
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
         ->scalar('custom_field_1')
         ->maxLength('custom_field_1', 255)
         ->allowEmpty('custom_field_1');
     $validator
         ->scalar('custom_field_2')
         ->maxLength('custom_field_2', 255)
         ->allowEmpty('custom_field_2');

     $validator
         ->scalar('custom_field_3')
         ->maxLength('custom_field_3', 255)
         ->allowEmpty('custom_field_3');

     $validator
         ->scalar('custom_field_4')
         ->maxLength('custom_field_4', 255)
         ->allowEmpty('custom_field_4');

     $validator
         ->scalar('custom_field_5')
         ->maxLength('custom_field_5', 255)
         ->allowEmpty('custom_field_5');

     $validator
         ->scalar('custom_field_6')
         ->maxLength('custom_field_6', 255)
         ->allowEmpty('custom_field_6');

     $validator
         ->scalar('custom_field_7')
         ->maxLength('custom_field_7', 255)
         ->allowEmpty('custom_field_7');

     $validator
         ->scalar('custom_field_8')
         ->maxLength('custom_field_8', 255)
         ->allowEmpty('custom_field_8');

     $validator
         ->scalar('custom_field_9')
         ->maxLength('custom_field_9', 255)
         ->allowEmpty('custom_field_9');

     $validator
         ->scalar('custom_field_10')
         ->maxLength('custom_field_10', 255)
         ->allowEmpty('custom_field_10');

     $validator
         ->scalar('custom_field_11')
         ->maxLength('custom_field_11', 255)
         ->allowEmpty('custom_field_11');

     $validator
         ->scalar('custom_field_12')
         ->maxLength('custom_field_12', 255)
         ->allowEmpty('custom_field_12');

     $validator
         ->scalar('custom_field_13')
         ->maxLength('custom_field_13', 255)
         ->allowEmpty('custom_field_13');

     $validator
         ->scalar('custom_field_14')
         ->maxLength('custom_field_14', 255)
         ->allowEmpty('custom_field_14');

     $validator
         ->scalar('custom_field_15')
         ->maxLength('custom_field_15', 255)
         ->allowEmpty('custom_field_15');

     $validator
         ->scalar('custom_field_16')
         ->maxLength('custom_field_16', 255)
         ->allowEmpty('custom_field_16');

     $validator
         ->scalar('custom_field_17')
         ->maxLength('custom_field_17', 255)
         ->allowEmpty('custom_field_17');

     $validator
         ->scalar('custom_field_18')
         ->maxLength('custom_field_18', 255)
         ->allowEmpty('custom_field_18');

     $validator
         ->scalar('custom_field_19')
         ->maxLength('custom_field_19', 255)
         ->allowEmpty('custom_field_19');

     $validator
         ->scalar('custom_field_20')
         ->maxLength('custom_field_20', 255)
         ->allowEmpty('custom_field_20');

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
       $rules->add($rules->existsIn(['organization_id'], 'Organization'));
       $rules->add($rules->isUnique(['name', 'organization_id']));
       return $rules;
   }
 }
