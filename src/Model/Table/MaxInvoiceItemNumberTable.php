<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MaxInvoiceItemNumber Model
 *
 * @method \App\Model\Entity\MaxInvoiceItemNumber get($primaryKey, $options = [])
 * @method \App\Model\Entity\MaxInvoiceItemNumber newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MaxInvoiceItemNumber[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MaxInvoiceItemNumber|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MaxInvoiceItemNumber|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MaxInvoiceItemNumber patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MaxInvoiceItemNumber[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MaxInvoiceItemNumber findOrCreate($search, callable $callback = null, $options = [])
 */
class MaxInvoiceItemNumberTable extends Table
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

        $this->setTable('max_invoice_item_number');
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
            ->scalar('invoice_item_number')
            ->maxLength('invoice_item_number', 255)
            ->allowEmpty('invoice_item_number');

        return $validator;
    }
}
