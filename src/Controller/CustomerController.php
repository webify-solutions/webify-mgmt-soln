<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Behavior\OrderBehavior;
use Cake\Http\Exception\NotFoundException;

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

        if ($this->loggedUserOrgId != null) {
            $customer = $this->paginate($this->Customer->find()->where(['Customer.organization_id' => $this->loggedUserOrgId]));
        } else {
            $customer = $this->paginate($this->Customer);
        }


        $this->set(['customer' => $customer, 'loggedUser' => $this->loggedUser]);
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
            'contain' => ['Group', 'Organization', 'SupportCase']
        ]);

        if ($this->loggedUserOrgId != null and $customer['organization_id'] != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }

        $orders = $this->Customer->Order->find('all')->where(['customer_id' => $id]);
        foreach ($orders as $order) {
            $order->set('total_amount', OrderBehavior::calculateTotalAmount($order));
        }

        $this->set(['customer' => $customer, 'loggedUser' => $this->loggedUser, 'orders' => $orders]);
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

            if ($this->loggedUserOrgId != null) {
                $customer->set('organization_id', $this->loggedUserOrgId);
            }

            if ($this->Customer->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'view', $customer->id]);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }

        if ($this->loggedUserOrgId == null) {
            $organization = $this->Customer->Organization->find('list', ['limit' => 200]);
            $group = $this->Customer->Group->find('list', ['limit' => 200]);
        } else {
            $organization = null;
            $group = $this->Customer->Group->find('list', ['limit' => 200])->where(['organization_id' => $this->loggedUserOrgId]);
        }

        $this->set(['customer' => $customer, 'loggedUser' => $this->loggedUser, 'group' => $group, 'organization' => $organization]);
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

        if ($this->loggedUserOrgId != null and $customer['organization_id'] != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customer->patchEntity($customer, $this->request->getData());
            if ($this->Customer->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'view', $customer->id]);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }

        if ($this->loggedUserOrgId == null) {
            $organization = $this->Customer->Organization->find('list', ['limit' => 200]);
            $group = $this->Customer->Group->find('list', ['limit' => 200]);
        } else {
            $organization = null;
            $group = $this->Customer->Group->find('list', ['limit' => 200])->where(['organization_id' => $this->loggedUserOrgId]);
        }

        $this->set(['customer' => $customer, 'loggedUser' => $this->loggedUser, 'group' => $group, 'organization' => $organization]);
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

        if ($this->loggedUserOrgId != null and $customer['organization_id'] != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }

        if ($this->Customer->delete($customer)) {
            $this->Flash->success(__('The customer has been deleted.'));
        } else {
            $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
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
