<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Utils\PropertyUtils;

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
//    public function index()
//    {
//        $this->paginate = [
//            'contain' => ['Order', 'PriceEntry', 'Product', 'Organization']
//        ];
//
//        if ($this->loggedUserOrgId != null) {
//            $orderItem = $this->paginate($this->OrderItem->find()->where(['organization_id' => $this->loggedUserOrgId]));
//        } else {
//            $orderItem = $this->paginate($this->OrderItem);
//        }
//
//        $this->set(['orderItem' => $orderItem, 'loggedUser' => $this->loggedUser]);
//    }

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

        if ($this->loggedUserOrgId != null and $orderItem['organization_id'] != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }

        $this->set(['orderItem' => $orderItem, 'loggedUser' => $this->loggedUser]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($orderId = null)
    {
        $orderItem = $this->OrderItem->newEntity();
        if ($orderId != null) {
            $orderItem->set('order_id', $orderId);
        }

        if ($this->request->is('post')) {
            $orderItem = $this->OrderItem->patchEntity($orderItem, $this->request->getData());

            if ($this->loggedUserOrgId != null) {
                $orderItem->set('organization_id', $this->loggedUserOrgId);
            }

            if ($this->OrderItem->save($orderItem)) {
                $this->Flash->success(__('The order item has been saved.'));

                return $this->redirect(['controller' => 'Order', 'action' => 'view', $orderId]);
            }
            $this->Flash->error(__('The order item could not be saved. Please, try again.'));
        }

        if ($this->loggedUserOrgId == null) {
            $order = $this->OrderItem->Order->find('list', ['limit' => 200])->where(['organization_id' => $this->loggedUserOrgId]);
            $priceEntry = $this->OrderItem->PriceEntry->find('list', ['limit' => 200]);
            $product = $this->OrderItem->Product->find('list', ['limit' => 200]);
            $organization = $this->OrderItem->Organization->find('list', ['limit' => 200]);
            $currencies = PropertyUtils::$currencies;
        } else {
            $organization = null;
            $order = $this->OrderItem->Order->find('list', ['limit' => 200])
                ->where(['organization_id' => $this->loggedUserOrgId]);
            $priceEntry = $this->OrderItem->PriceEntry->find('list', ['limit' => 200])
                ->where(['organization_id' => $this->loggedUserOrgId]);
            $product = $this->OrderItem->Product->find('list', ['limit' => 200])
                ->where(['organization_id' => $this->loggedUserOrgId]);

            $currencies = $this->loggedUser['organization_currency_used'];
        }

        $this->set([
            'orderItem' => $orderItem,
            'loggedUser' => $this->loggedUser,
            'order' => $order,
            'priceEntry' => $priceEntry,
            'product' => $product,
            'organization' => $organization,
            'currencies' => $currencies,
            'discountUnites' => PropertyUtils::$discountUnits
        ]);
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

        if ($this->loggedUserOrgId != null and $orderItem['organization_id'] != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderItem = $this->OrderItem->patchEntity($orderItem, $this->request->getData());
            if ($this->OrderItem->save($orderItem)) {
                $this->Flash->success(__('The order item has been saved.'));

                return $this->redirect(['controller' => 'Order', 'action' => 'view', $orderItem->order_id]);
            }
            $this->Flash->error(__('The order item could not be saved. Please, try again.'));
        }

        if ($this->loggedUserOrgId == null) {
            $order = $this->OrderItem->Order->find('list', ['limit' => 200])->where(['organization_id' => $this->loggedUserOrgId]);
            $priceEntry = $this->OrderItem->PriceEntry->find('list', ['limit' => 200]);
            $product = $this->OrderItem->Product->find('list', ['limit' => 200]);
            $organization = $this->OrderItem->Organization->find('list', ['limit' => 200]);
            $currencies = PropertyUtils::$currencies;
        } else {
            $organization = null;
            $order = $this->OrderItem->Order->find('list', ['limit' => 200])
                ->where(['organization_id' => $this->loggedUserOrgId]);
            $priceEntry = $this->OrderItem->PriceEntry->find('list', ['limit' => 200])
                ->where(['organization_id' => $this->loggedUserOrgId]);
            $product = $this->OrderItem->Product->find('list', ['limit' => 200])
                ->where(['organization_id' => $this->loggedUserOrgId]);

            $currencies = $this->loggedUser['organization_currency_used'];
        }

        $this->set([
            'orderItem' => $orderItem,
            'loggedUser' => $this->loggedUser,
            'order' => $order,
            'priceEntry' => $priceEntry,
            'product' => $product,
            'organization' => $organization,
            'currencies' => $currencies,
            'discountUnites' => PropertyUtils::$discountUnits
        ]);
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

        if ($this->loggedUserOrgId != null and $orderItem['organization_id'] != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }

        if ($this->OrderItem->delete($orderItem)) {
            $this->Flash->success(__('The order item has been deleted.'));
        } else {
            $this->Flash->error(__('The order item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'Order', 'action' => 'view', $orderItem->order_id]);
    }

    /**
     * Is authorized method
     *
     * @param $user
     * @return bool
     */
    public function isAuthorized($user)
    {
        return $this->isUserAuthorizedFor($user, 'Order');
    }
}
