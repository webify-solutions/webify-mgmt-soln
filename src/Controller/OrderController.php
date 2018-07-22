<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Behavior\OrderBehavior;
use App\Model\Entity\Order;
use App\Utils\PropertyUtils;

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

        if ($this->loggedUserOrgId != null) {
            $order = $this->paginate($this->Order->find()->where(['Order.organization_id' => $this->loggedUserOrgId]));
        } else {
            $order = $this->paginate($this->Order);
        }


        $this->set(['order' => $order, 'loggedUser' => $this->loggedUser]);
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

        if ($this->loggedUserOrgId != null and $order['organization_id'] != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }

        $this->set(['order' => $order, 'loggedUser' => $this->loggedUser]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * @throws \Aura\Intl\Exception
     */
    public function add()
    {
        $order = $this->Order->newEntity();
        if ($this->request->is('post')) {
            $order = $this->Order->patchEntity($order, $this->request->getData());

            if ($this->loggedUserOrgId != null) {
                $order->set('organization_id', $this->loggedUserOrgId);
            }

            if ($this->Order->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }

        if ($this->loggedUserOrgId == null) {
            $organization = $this->Order->Organization->find('list', ['limit' => 200]);

            $customerQuery = $this->Order->Customer->find('all', ['limit' => 200]);
            $customers = OrderBehavior::getCustomersAsPickList($customerQuery);

        } else {
            $organization = null;

            $customerQuery = $this->Order->Customer->find('all', ['limit' => 200])
                ->where(['organization_id', $this->loggedUserOrgId]);
            $customers = OrderBehavior::getCustomersAsPickList($customerQuery);


        }

        $this->set([
            'order' => $order,
            'loggedUser' => $this->loggedUser,
            'organization' => $organization,
            'customer' => $customers,
            'types' => PropertyUtils::$orderTypes,
            'typePeriods' => range(1, 84),
            'orderDiscountUnits' => PropertyUtils::$discountUnits
        ]);
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

        if ($this->loggedUserOrgId != null and $order['organization_id'] != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Order->patchEntity($order, $this->request->getData());
            if ($this->Order->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }

        if ($this->loggedUserOrgId == null) {
            $customer = $this->Order->Customer->find(['limit' => 200])
                ->select(['id', 'contact(first_name, last_name) as name'])
                ->combine(
                    'id',
                    'name'
                );
            $organization = $this->Order->Organization->find('list', ['limit' => 200]);
        } else {
            $customer = $this->Order->Customer->find(['limit' => 200])
                ->select(['id', 'contact(first_name, last_name) as name'])
                ->where(['organization_id', $this->loggedUserOrgId])
                ->combine(
                    'id',
                    'name'
                );
            $organization = null;
        }

        $this->set([
            'order' => $order,
            'loggedUser' => $this->loggedUser,
            'organization' => $organization,
            'customer' => $customer
        ]);
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

        if ($this->loggedUserOrgId != null and $order['organization_id'] != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }

        if ($this->Order->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function cancel($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Order->get($id);

        if ($this->loggedUserOrgId != null and $order['organization_id'] != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }

        $order->set('active', false);

        if ($this->Order->save($order)) {
            $this->Flash->success(__('The order has been cancelled.'));
        } else {
            $this->Flash->error(__('The order could not be cancelled. Please, try again.'));
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
