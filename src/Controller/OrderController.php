<?php
namespace App\Controller;

use App\Model\Behavior\OrderBehavior;
use App\Model\Behavior\CustomerBehavior;
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
        $orderQuery = $this->Order->find()
          ->select([
            'Organization.id',
            'Organization.name',
            'Order.id',
            'order_number',
            'order_date',
            'subtotal_amount',
            'order_discount',
            'order_discount_unit',
            'Order.active',
            'Customer.id',
            'Customer.name',
            'Customer.customer_number'
          ])
          ->contain([
            'Organization',
            'Customer'
          ])
          ->order([
            'order_date' => 'ASC'
          ]);

        if ($this->loggedUserOrgId != null) {
          $orderQuery->where([
            'Order.organization_id' => $this->loggedUserOrgId
          ]);
        }

        foreach ($orderQuery as $order ) {
            $order->set('total_amount', OrderBehavior::calculateTotalAmount($order));
        }

        $this->set(['order' => $orderQuery, 'loggedUser' => $this->loggedUser]);
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
        $order->set('total_amount', OrderBehavior::calculateTotalAmount($order));

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

        if ($this->loggedUserOrgId != null) {
            $order->set('organization_id', $this->loggedUserOrgId);
            $order->set('currency', $this->loggedUser['organization_default_currency']);
        }
        $order->set('customer_id', $customerId);

        if ($this->request->is('post') || $this->request->getQuery('auto') == 1)
        {
            debug('auto create');
            if(($this->request->getData('order_discount') == null and $this->request->getData('order_discount_unit') == null)
                or ($this->request->getData('order_discount') != null and $this->request->getData('order_discount_unit') != null))
            {
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
        } else {
            $organization = null;
        }

        $this->set([
            'order' => $order,
            'loggedUser' => $this->loggedUser,
            'organization' => $organization,
            'customer' => CustomerBehavior::getCustomersAsPickList($this->loggedUserOrgId),
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
        } else {
            $organization = null;
        }

        $this->set([
            'order' => $order,
            'loggedUser' => $this->loggedUser,
            'organization' => $organization,
            'customer' => CustomerBehavior::getCustomersAsPickList($this->loggedUserOrgId),
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
