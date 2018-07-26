<?php
namespace App\Controller;

use App\Model\Behavior\OrderBehavior;
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
            'contain' => ['Customer', 'Organization', 'Invoice', 'Payment']
        ]);

        $orderItems = $this->Order->OrderItem->find('all', ['contain' => 'Product'])
            ->where(['order_id' => $id]);

        if ($this->loggedUserOrgId != null and $order['organization_id'] != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }

        $order->set('displayable_type', PropertyUtils::$orderTypes[$order->type]);

        $this->set([
            'order' => $order,
            'orderItems' => $orderItems,
            'loggedUser' => $this->loggedUser
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * @throws \Aura\Intl\Exception
     */
    public function add($customerId = null)
    {
        $order = $this->Order->newEntity();

        $order->set('currency', $this->loggedUser['organization_default_currency']);

        if ($this->request->is('post'))
        {
            if(($this->request->getData('order_discount') == null and $this->request->getData('order_discount_unit') == null)
                or ($this->request->getData('order_discount') != null and $this->request->getData('order_discount_unit') != null))
            {
                $order = $this->Order->patchEntity($order, $this->request->getData());

                if ($this->loggedUserOrgId != null) {
                    $order->set('organization_id', $this->loggedUserOrgId);
                }

                if ($this->Order->save($order)) {
                    $this->Flash->success(__('The order has been saved.'));

                    return $this->redirect(['action' => 'view', $order->id]);
                }
                $this->Flash->error(__('The order could not be saved. Please, try again.'));
            } else {

                $this->Flash->error(__('Order Discount and Order Discount Unit must be both present'));
            }
        }

        $order->set('currency', $this->loggedUser['organization_currency_used']);
        $order->set('customer_id', $customerId);

        if ($this->loggedUserOrgId == null) {
            $organization = $this->Order->Organization->find('list', ['limit' => 200]);

            $customerQuery = $this->Order->Customer->find('all', ['limit' => 200]);
            $customers = OrderBehavior::getCustomersAsPickList($customerQuery);

        } else {
            $organization = null;

            $customerQuery = $this->Order->Customer->find('')->where(['Customer.organization_id' => $this->loggedUserOrgId]);
            $customers = OrderBehavior::getCustomersAsPickList($customerQuery);
        }

        $this->set([
            'order' => $order,
            'loggedUser' => $this->loggedUser,
            'organization' => $organization,
            'customer' => $customers,
            'types' => PropertyUtils::$orderTypes,
            'typePeriods' => range(0, 84),
            'orderDiscountUnits' => PropertyUtils::$discountUnits,
            'currencies' => $this->loggedUser['organization_currency_used']
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
            if(($this->request->getData('order_discount') == null and $this->request->getData('order_discount_unit') == null)
                or ($this->request->getData('order_discount') != null and $this->request->getData('order_discount_unit') != null)) {
                $order = $this->Order->patchEntity($order, $this->request->getData());
                if ($this->Order->save($order)) {
                    $this->Flash->success(__('The order has been saved.'));

                    return $this->redirect(['action' => 'view', $order->id]);
                }
                $this->Flash->error(__('The order could not be saved. Please, try again.'));
            } else {
                $this->Flash->error(__('Order Discount and Order Discount Unit must be both present'));
            }
        }

        if ($this->loggedUserOrgId == null) {
            $organization = $this->Order->Organization->find('list', ['limit' => 200]);

            $customerQuery = $this->Order->Customer->find('all', ['limit' => 200]);
            $customers = OrderBehavior::getCustomersAsPickList($customerQuery);

        } else {
            $organization = null;

            $customerQuery = $this->Order->Customer->find('')->where(['Customer.organization_id' => $this->loggedUserOrgId]);
            $customers = OrderBehavior::getCustomersAsPickList($customerQuery);
        }

        $this->set([
            'order' => $order,
            'loggedUser' => $this->loggedUser,
            'organization' => $organization,
            'customer' => $customers,
            'types' => PropertyUtils::$orderTypes,
            'typePeriods' => range(0, 84),
            'orderDiscountUnits' => PropertyUtils::$discountUnits,
            'currencies' => $this->loggedUser['organization_currency_used']
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


        if ($this->Order->updateAll(['active' => false], ['id' => $order->id])) {
            $this->Flash->success(__('The order has been cancelled.'));
        } else {
            $this->Flash->error(__('The order could not be cancelled. Please, try again.'));
        }

//        $modelType = $this->request->$this->getModelType();
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
