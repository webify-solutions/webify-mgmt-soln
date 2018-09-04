<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Behavior\OrderItemBehavior;
use App\Utils\PropertyUtils;
use App\Utils\StringUtils;
use App\GoogleDrive\GoogleDrive;

/**
 * OrderItem Controller
 *
 * @property \App\Model\Table\OrderItemTable $OrderItem
 *
 * @method \App\Model\Entity\OrderItem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrderItemController extends AppController
{

  public function initialize()
  {
    parent::initialize();

    // Load Files model
    $this->loadModel('Files');
  }

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
            'contain' => ['Order', 'Product', 'Organization', 'InvoiceItem']
        ]);

        if ($this->loggedUserOrgId != null and $orderItem['organization_id'] != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }

        $products = $this->OrderItem->Product->find('all')
          ->where(['Product.id' => $orderItem->product_id]);
        // debug(OrderItemBehavior::getProductCustomFieldLabelsAsJSON($products));

        // debug(OrderItemBehavior::getProductCategoryPriceEntryListAsJSON($this->loggedUserOrgId));

        $this->set([
          'orderItem' => $orderItem,
          'loggedUser' => $this->loggedUser,
          'productInfoList' => json_encode(OrderItemBehavior::getProductCategoryPriceEntryList($this->loggedUserOrgId))
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($orderId = null)
    {
        $orderItem = $this->OrderItem->newEntity();

        if ($orderId == null) {
            $this->Flash->error(__('Error occurred while adding new order. Please, try again.'));
            return $this->redirect(['controller' => 'Order', 'action' => 'index']);
        }

        $orderItem->set('order_id', $orderId);

        if ($this->request->is('post')) {
            $requestData = $this->request->getData();
            for ($i = 1; $i <= 20; $i++) {
              $key = 'custom_field_' . $i;
              $uploadKey = 'custom_field_upload_link_' . $i;
              if (isset($requestData[$uploadKey]) and $requestData[$uploadKey]['tmp_name'] != null) {
                // debug($requestData[$uploadKey]);
                // debug($requestData[$uploadKey]);
                $fileName = $requestData[$uploadKey]['name'];
                $requestData[$key] = $fileName;
                // $requestData[$uploadKey] = file_get_contents($requestData[$uploadKey]['tmp_name']);
                $googleDrive = new GoogleDrive();
                // debug($googleDriver);
                // debug($googleDrive->client);

                $file = $googleDrive->uploadFile($requestData[$uploadKey]['tmp_name'], $fileName);
                // debug($requestData);

                if ($file != null) {
                  $requestData[$key] = $fileName;
                  $requestData[$uploadKey] = $file->webViewLink;
                } else {
                  $this->Flash->error($fileName . ' could not be saved. Please, try again.');
                }
                // debug($requestData);
              }
            }

          // debug($requestData['custom_field_1']);

          $orderItem = $this->OrderItem->patchEntity($orderItem, $requestData);

          if ($this->loggedUserOrgId != null) {
              $orderItem->set('organization_id', $this->loggedUserOrgId);
          }

          // debug($orderItem->get('custom_field_1'));

          if ($this->OrderItem->save($orderItem)) {
              $this->Flash->success(__('The order item has been saved.'));

              if($requestData['do_continue'] == "true") {
                  return $this->redirect(['action' => 'add', $orderId]);
              } else {
                  return $this->redirect(['controller' => 'Order', 'action' => 'view', $orderId]);
              }

          }
          $this->Flash->error(__('The order item could not be saved. Please, try again.'));
        }

        if ($this->loggedUserOrgId == null) {
            $organization = $this->OrderItem->Organization->find('list', ['limit' => 200]);
            $orderQuery = $this->OrderItem->Order->find('all');
        } else {
            $organization = null;
            $orderQuery = $this->OrderItem->Order->find('all', ['limit' => 200])
              ->where(['organization_id' => $this->loggedUserOrgId]);
        }
        // debug($products->toList());

        $productList = OrderItemBehavior::getProductCategoryPriceEntryList($this->loggedUserOrgId);

        // debug(OrderItemBehavior::getProductCustomFieldLabelsAsJSON($products));
        $this->set([
            'orderItem' => $orderItem,
            'loggedUser' => $this->loggedUser,
            'order' => OrderItemBehavior::getOrdersAsPickList($orderQuery),
            'productInfoList' => json_encode($productList),
            'productPickList' => OrderItemBehavior::getProductAsPickList($productList),
            'organization' => $organization
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
            $organization = $this->OrderItem->Organization->find('list', ['limit' => 200]);
            // $orderQuery = $this->OrderItem->Order->find('all');
        } else {
            $organization = null;
            // $orderQuery = $this->OrderItem->Order->find('all', ['limit' => 200])
            //   ->where(['organization_id' => $this->loggedUserOrgId]);
        }
        // debug($products->toList());

        $productList = OrderItemBehavior::getProductCategoryPriceEntryListAsJSON($this->loggedUserOrgId);
        $productIds = array_keys($productList);

        // debug(OrderItemBehavior::getProductCustomFieldLabelsAsJSON($products));
        $this->set([
            'orderItem' => $orderItem,
            'loggedUser' => $this->loggedUser,
            // 'order' => OrderItemBehavior::getOrdersAsPickList($orderQuery),
            'productInfoList' => $productList,
            'productPickList' => OrderItemBehavior::getProductAsPickList($productList),
            'productRelatedInfoLIst' => OrderItemBehaviour::getProductRelatedInfoListAsJSON($orderId),
            'organization' => $organization
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
