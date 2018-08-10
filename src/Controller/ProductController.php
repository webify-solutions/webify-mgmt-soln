<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Behavior\ProductBehavior;

/**
 * Product Controller
 *
 * @property \App\Model\Table\ProductTable $Product
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Organization', 'ProductCategory']
        ];

        if ($this->loggedUserOrgId != null) {
            $product = $this->paginate($this->Product->find()->where(['Product.organization_id' => $this->loggedUserOrgId]));
        } else {
            $product = $this->paginate($this->Product);
        }

        // debug($product);
        $this->set(['product' => $product, 'loggedUser' => $this->loggedUser]);
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Product->get($id, [
            'contain' => ['Organization', 'ProductCategory', 'InvoiceItem', 'OrderItem', 'PriceEntry']
        ]);

        if ($this->loggedUserOrgId != null and $product['organization_id'] != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }
        $products = $this->Product->find('all')
          ->where(['Product.id' => $id]);

        $this->set([
          'product' => $product,
          'loggedUser' => $this->loggedUser,
          'productCustomFieldLabels' => ProductBehavior::getProductCustomFieldLabelsAsJSON($products)
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Product->newEntity();
        if ($this->loggedUserOrgId != null) {
            $product->set('organization_id', $this->loggedUserOrgId);
        }
        if ($this->request->is('post')) {
            $product = $this->Product->patchEntity($product, $this->request->getData());

            // debug($product);
            if ($this->Product->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'view', $product->id]);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }

        if ($this->loggedUserOrgId == null) {
            $organization = $this->Product->Organization->find('list', ['limit' => 200]);
            $categories = $this->Product->ProductCategory->find('list');
            $categoriesCustomFields = $this->Product->ProductCategory->find('all');
        } else {
          $organization = null;
          $categories = $this->Product->ProductCategory->find('list', ['limit' => 200])
            ->where(['organization_id' => $this->loggedUserOrgId]);
          $categoriesCustomFields = $this->Product->ProductCategory->find('all')
            ->where(['organization_id' => $this->loggedUserOrgId]);
        }

        $this->set([
          'product' => $product,
          'loggedUser' => $this->loggedUser,
          'organization' => $organization,
          'categories' => $categories,
          'categoriesCustomFields' => ProductBehavior::getProductCategoriesCustomFieldsJSON($categoriesCustomFields)
        ]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
      $product = $this->Product->get($id, [
          'contain' => ['Organization', 'ProductCategory']
      ]);

      if ($this->loggedUserOrgId != null and $product['organization_id'] != ($this->loggedUserOrgId)) {
          $this->unauthorizedAccessRedirect();
      }

      if ($this->request->is(['patch', 'post', 'put'])) {
          $product = $this->Product->patchEntity($product, $this->request->getData());
          if ($this->Product->save($product)) {
              $this->Flash->success(__('The product has been saved.'));

              return $this->redirect(['action' => 'view', $product->id]);
          }
          $this->Flash->error(__('The product could not be saved. Please, try again.'));
      }

      if ($this->loggedUserOrgId == null) {
          $organization = $this->Product->Organization->find('list', ['limit' => 200]);
          $categories = $this->Product->ProductCategory->find('list');
          $categoriesCustomFields = $this->Product->ProductCategory->find('all');
      } else {
        $organization = null;
        $categories = $this->Product->ProductCategory->find('list', ['limit' => 200])
          ->where(['organization_id' => $this->loggedUserOrgId]);
        $categoriesCustomFields = $this->Product->ProductCategory->find('all')
          ->where(['organization_id' => $this->loggedUserOrgId]);
      }

      $this->set([
        'product' => $product,
        'loggedUser' => $this->loggedUser,
        'organization' => $organization,
        'categories' => $categories,
        'categoriesCustomFields' => ProductBehavior::getProductCategoriesCustomFieldsJSON($categoriesCustomFields)
      ]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Product->get($id);

        if ($this->loggedUserOrgId != null and $product['organization_id'] != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }

        if ($this->Product->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Is authorized method
     *
     * @param $user
     * @return bool
     */
    public function isAuthorized($user)
    {
        return $this->isUserAuthorizedFor($user, $this->getName());
    }
}
