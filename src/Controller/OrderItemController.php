<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * OrderItem Controller
 *
 * @property \App\Model\Table\OrderItemTable $OrderItem
 *
 * @method \App\Model\Entity\OrderItem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrderItemController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Order', 'PriceEntry', 'Product', 'Organization']
        ];
        $orderItem = $this->paginate($this->OrderItem);

        $this->set(compact('orderItem'));
    }

    /**
     * View method
     *
     * @param string|null $id Order Item id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orderItem = $this->OrderItem->get($id, [
            'contain' => ['Order', 'PriceEntry', 'Product', 'Organization', 'InvoiceItem']
        ]);

        $this->set('orderItem', $orderItem);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orderItem = $this->OrderItem->newEntity();
        if ($this->request->is('post')) {
            $orderItem = $this->OrderItem->patchEntity($orderItem, $this->request->getData());
            if ($this->OrderItem->save($orderItem)) {
                $this->Flash->success(__('The order item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order item could not be saved. Please, try again.'));
        }
        $order = $this->OrderItem->Order->find('list', ['limit' => 200]);
        $priceEntry = $this->OrderItem->PriceEntry->find('list', ['limit' => 200]);
        $product = $this->OrderItem->Product->find('list', ['limit' => 200]);
        $organization = $this->OrderItem->Organization->find('list', ['limit' => 200]);
        $this->set(compact('orderItem', 'order', 'priceEntry', 'product', 'organization'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order Item id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orderItem = $this->OrderItem->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderItem = $this->OrderItem->patchEntity($orderItem, $this->request->getData());
            if ($this->OrderItem->save($orderItem)) {
                $this->Flash->success(__('The order item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order item could not be saved. Please, try again.'));
        }
        $order = $this->OrderItem->Order->find('list', ['limit' => 200]);
        $priceEntry = $this->OrderItem->PriceEntry->find('list', ['limit' => 200]);
        $product = $this->OrderItem->Product->find('list', ['limit' => 200]);
        $organization = $this->OrderItem->Organization->find('list', ['limit' => 200]);
        $this->set(compact('orderItem', 'order', 'priceEntry', 'product', 'organization'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orderItem = $this->OrderItem->get($id);
        if ($this->OrderItem->delete($orderItem)) {
            $this->Flash->success(__('The order item has been deleted.'));
        } else {
            $this->Flash->error(__('The order item could not be deleted. Please, try again.'));
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
