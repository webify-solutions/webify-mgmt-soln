<?php
namespace App\Controller;

use App\Controller\AppController;

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
    public function index()
    {
        $this->paginate = [
            'contain' => ['Product', 'Organization']
        ];
        $priceEntry = $this->paginate($this->PriceEntry);

        $this->set(compact('priceEntry'));
    }

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

        $this->set('priceEntry', $priceEntry);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $priceEntry = $this->PriceEntry->newEntity();
        if ($this->request->is('post')) {
            $priceEntry = $this->PriceEntry->patchEntity($priceEntry, $this->request->getData());
            if ($this->PriceEntry->save($priceEntry)) {
                $this->Flash->success(__('The price entry has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The price entry could not be saved. Please, try again.'));
        }
        $product = $this->PriceEntry->Product->find('list', ['limit' => 200]);
        $organization = $this->PriceEntry->Organization->find('list', ['limit' => 200]);
        $this->set(compact('priceEntry', 'product', 'organization'));
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $priceEntry = $this->PriceEntry->patchEntity($priceEntry, $this->request->getData());
            if ($this->PriceEntry->save($priceEntry)) {
                $this->Flash->success(__('The price entry has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The price entry could not be saved. Please, try again.'));
        }
        $product = $this->PriceEntry->Product->find('list', ['limit' => 200]);
        $organization = $this->PriceEntry->Organization->find('list', ['limit' => 200]);
        $this->set(compact('priceEntry', 'product', 'organization'));
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
        if ($this->PriceEntry->delete($priceEntry)) {
            $this->Flash->success(__('The price entry has been deleted.'));
        } else {
            $this->Flash->error(__('The price entry could not be deleted. Please, try again.'));
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
        return false;
    }
}
