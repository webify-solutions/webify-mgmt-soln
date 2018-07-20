<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Organization;

/**
 * PriceEntry Controller
 *
 * @property \App\Model\Table\PriceEntryTable $PriceEntry
 *
 * @method \App\Model\Entity\PriceEntry[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PriceEntryController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
//    public function index()
//    {
//        $this->paginate = [
//            'contain' => ['Product', 'Organization']
//        ];
//
//        if ($this->loggedUserOrgId != null) {
//            $priceEntry = $this->paginate($this->PriceEntry->find()->where(['organization_id' => $this->loggedUserOrgId]));
//        } else {
//            $priceEntry = $this->paginate($this->PriceEntry);
//        }
//
//        $this->set(['priceEntry' => $priceEntry, 'loggedUser' => $this->loggedUser]);
//    }

    /**
     * View method
     *
     * @param string|null $id Price Entry id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $priceEntry = $this->PriceEntry->get($id, [
            'contain' => ['Product', 'Organization', 'OrderItem']
        ]);

        if ($this->loggedUserOrgId != null and $priceEntry['organization_id'] != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }

        $this->set(['priceEntry' => $priceEntry, 'loggedUser' => $this->loggedUser]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($product_id = null)
    {
        $priceEntry = $this->PriceEntry->newEntity();
        if ($product_id != null) {
            $priceEntry->set('product_id', $product_id);
        }

        if ($this->request->is('post')) {
            $priceEntry = $this->PriceEntry->patchEntity($priceEntry, $this->request->getData());

            if ($this->loggedUserOrgId != null) {
                $priceEntry->set('organization_id', $this->loggedUserOrgId);
            }

            if ($this->PriceEntry->save($priceEntry)) {
                $this->Flash->success(__('The price entry has been saved.'));

                return $this->redirect(['controller' => 'Product', 'action' => 'view', $priceEntry->product_id]);
            }
            $this->Flash->error(__('The price entry could not be saved. Please, try again.'));
        }

        if ($this->loggedUserOrgId == null) {
            $organization = $this->PriceEntry->Organization->find('list', ['limit' => 200]);
            $product = $this->PriceEntry->Product->find('list', ['limit' => 200]);
            $currencies = Organization::$currencies;
        } else {
            $organization = null;
            $product = $this->PriceEntry->Product->find('list', ['limit' => 200])->where(['organization_id' => $this->loggedUserOrgId]);
            $currencies = $this->loggedUser['organization_currency_used'];
        }

        $discountUnits = Organization::$discountUnits;

        $this->set([
            'priceEntry' => $priceEntry,
            'loggedUser' => $this->loggedUser,
            'product' => $product,
            'organization' => $organization,
            'currencies' => $currencies,
            'discountUnits' => $discountUnits
        ]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Price Entry id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $priceEntry = $this->PriceEntry->get($id, [
            'contain' => []
        ]);

        if ($this->loggedUserOrgId != null and $priceEntry['organization_id'] != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $priceEntry = $this->PriceEntry->patchEntity($priceEntry, $this->request->getData());
            if ($this->PriceEntry->save($priceEntry)) {
                $this->Flash->success(__('The price entry has been saved.'));

                return $this->redirect(['controller' => 'Product', 'action' => 'view', $priceEntry->product_id]);
            }
            $this->Flash->error(__('The price entry could not be saved. Please, try again.'));
        }

        if ($this->loggedUserOrgId == null) {
            $organization = $this->PriceEntry->Organization->find('list', ['limit' => 200]);
            $product = $this->PriceEntry->Product->find('list', ['limit' => 200]);
            $currencies = Organization::$currencies;
        } else {
            $organization = null;
            $product = $this->PriceEntry->Product->find('list', ['limit' => 200])->where(['organization_id' => $this->loggedUserOrgId]);
            $currencies = $this->loggedUser['organization_currency_used'];
        }

        $discountUnits = Organization::$discountUnits;

        $this->set([
            'priceEntry' => $priceEntry,
            'loggedUser' => $this->loggedUser,
            'product' => $product,
            'organization' => $organization,
            'currencies' => $currencies,
            'discountUnits' => $discountUnits
        ]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Price Entry id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $priceEntry = $this->PriceEntry->get($id);

        if ($this->loggedUserOrgId != null and $priceEntry['organization_id'] != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }

        if ($this->PriceEntry->delete($priceEntry)) {
            $this->Flash->success(__('The price entry has been deleted.'));
        } else {
            $this->Flash->error(__('The price entry could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'Product', 'action' => 'view', $priceEntry->product_id]);
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
