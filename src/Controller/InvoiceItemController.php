<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * InvoiceItem Controller
 *
 * @property \App\Model\Table\InvoiceItemTable $InvoiceItem
 *
 * @method \App\Model\Entity\InvoiceItem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InvoiceItemController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Invoice', 'OrderItem', 'Product', 'Organization']
        ];
        $invoiceItem = $this->paginate($this->InvoiceItem);

        $this->set(compact('invoiceItem'));
    }

    /**
     * View method
     *
     * @param string|null $id Invoice Item id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $invoiceItem = $this->InvoiceItem->get($id, [
            'contain' => ['Invoice', 'OrderItem', 'Product', 'Organization']
        ]);

        $this->set('invoiceItem', $invoiceItem);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $invoiceItem = $this->InvoiceItem->newEntity();
        if ($this->request->is('post')) {
            $invoiceItem = $this->InvoiceItem->patchEntity($invoiceItem, $this->request->getData());
            if ($this->InvoiceItem->save($invoiceItem)) {
                $this->Flash->success(__('The invoice item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invoice item could not be saved. Please, try again.'));
        }
        $invoice = $this->InvoiceItem->Invoice->find('list', ['limit' => 200]);
        $orderItem = $this->InvoiceItem->OrderItem->find('list', ['limit' => 200]);
        $product = $this->InvoiceItem->Product->find('list', ['limit' => 200]);
        $organization = $this->InvoiceItem->Organization->find('list', ['limit' => 200]);
        $this->set(compact('invoiceItem', 'invoice', 'orderItem', 'product', 'organization'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Invoice Item id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $invoiceItem = $this->InvoiceItem->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $invoiceItem = $this->InvoiceItem->patchEntity($invoiceItem, $this->request->getData());
            if ($this->InvoiceItem->save($invoiceItem)) {
                $this->Flash->success(__('The invoice item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invoice item could not be saved. Please, try again.'));
        }
        $invoice = $this->InvoiceItem->Invoice->find('list', ['limit' => 200]);
        $orderItem = $this->InvoiceItem->OrderItem->find('list', ['limit' => 200]);
        $product = $this->InvoiceItem->Product->find('list', ['limit' => 200]);
        $organization = $this->InvoiceItem->Organization->find('list', ['limit' => 200]);
        $this->set(compact('invoiceItem', 'invoice', 'orderItem', 'product', 'organization'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Invoice Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $invoiceItem = $this->InvoiceItem->get($id);
        if ($this->InvoiceItem->delete($invoiceItem)) {
            $this->Flash->success(__('The invoice item has been deleted.'));
        } else {
            $this->Flash->error(__('The invoice item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
