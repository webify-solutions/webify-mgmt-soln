<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Customer Controller
 *
 * @property \App\Model\Table\CustomerTable $Customer
 *
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomerController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Group', 'Organization']
        ];
        $customer = $this->paginate($this->Customer);

        $this->set(compact('customer'));
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customer = $this->Customer->get($id, [
            'contain' => ['Group', 'Organization', 'Order', 'SupportCase']
        ]);

        $this->set('customer', $customer);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customer = $this->Customer->newEntity();
        if ($this->request->is('post')) {
            $customer = $this->Customer->patchEntity($customer, $this->request->getData());
            if ($this->Customer->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $group = $this->Customer->Group->find('list', ['limit' => 200]);
        $organization = $this->Customer->Organization->find('list', ['limit' => 200]);
        $this->set(compact('customer', 'group', 'organization'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customer = $this->Customer->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customer->patchEntity($customer, $this->request->getData());
            if ($this->Customer->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $group = $this->Customer->Group->find('list', ['limit' => 200]);
        $organization = $this->Customer->Organization->find('list', ['limit' => 200]);
        $this->set(compact('customer', 'group', 'organization'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customer = $this->Customer->get($id);
        if ($this->Customer->delete($customer)) {
            $this->Flash->success(__('The customer has been deleted.'));
        } else {
            $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
