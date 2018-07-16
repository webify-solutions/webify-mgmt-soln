<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Order Controller
 *
 * @property \App\Model\Table\OrderTable $Order
 *
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrderController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Customer', 'Organization']
        ];
        $order = $this->paginate($this->Order);

        $this->set(compact('order'));
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $order = $this->Order->get($id, [
            'contain' => ['Customer', 'Organization', 'Invoice', 'OrderItem', 'Payment']
        ]);

        $this->set('order', $order);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $order = $this->Order->newEntity();
        if ($this->request->is('post')) {
            $order = $this->Order->patchEntity($order, $this->request->getData());
            if ($this->Order->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $customer = $this->Order->Customer->find('list', ['limit' => 200]);
        $organization = $this->Order->Organization->find('list', ['limit' => 200]);
        $this->set(compact('order', 'customer', 'organization'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $order = $this->Order->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Order->patchEntity($order, $this->request->getData());
            if ($this->Order->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $customer = $this->Order->Customer->find('list', ['limit' => 200]);
        $organization = $this->Order->Organization->find('list', ['limit' => 200]);
        $this->set(compact('order', 'customer', 'organization'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Order->get($id);
        if ($this->Order->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
