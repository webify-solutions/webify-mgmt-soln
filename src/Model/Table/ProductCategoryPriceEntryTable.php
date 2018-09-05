<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductCategoryPriceEntry Model
 *
 * @property \App\Model\Table\ProductsTable|\Cake\ORM\Association\BelongsTo $Products
 * @property \App\Model\Table\OrganizationsTable|\Cake\ORM\Association\BelongsTo $Organizations
 * @property \App\Model\Table\CategoriesTable|\Cake\ORM\Association\BelongsTo $Categories
 * @property \App\Model\Table\PriceEntriesTable|\Cake\ORM\Association\BelongsTo $PriceEntries
 *
 * @method \App\Model\Entity\ProductCategoryPriceEntry get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProductCategoryPriceEntry newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProductCategoryPriceEntry[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductCategoryPriceEntry|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductCategoryPriceEntry|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductCategoryPriceEntry patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProductCategoryPriceEntry[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductCategoryPriceEntry findOrCreate($search, callable $callback = null, $options = [])
 */
class ProductCategoryPriceEntryTable extends Table
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

        $this->setTable('product_category_price_entry');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Organizations', [
            'foreignKey' => 'organization_id'
        ]);
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('PriceEntries', [
            'foreignKey' => 'price_entry_id',
            'joinType' => 'INNER'
        ]);
    }
}
