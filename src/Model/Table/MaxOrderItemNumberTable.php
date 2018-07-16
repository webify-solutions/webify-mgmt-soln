<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MaxOrderItemNumber Model
 *
 * @method \App\Model\Entity\MaxOrderItemNumber get($primaryKey, $options = [])
 * @method \App\Model\Entity\MaxOrderItemNumber newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MaxOrderItemNumber[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MaxOrderItemNumber|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MaxOrderItemNumber|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MaxOrderItemNumber patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MaxOrderItemNumber[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MaxOrderItemNumber findOrCreate($search, callable $callback = null, $options = [])
 */
class MaxOrderItemNumberTable extends Table
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

        $this->setTable('max_order_item_number');
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
            ->scalar('order_item_number')
            ->maxLength('order_item_number', 255)
            ->allowEmpty('order_item_number');

        return $validator;
    }
}
