<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Organization Controller
 *
 * @property \App\Model\Table\OrganizationTable $Organization
 *
 * @method \App\Model\Entity\Organization[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrganizationController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $organization = $this->paginate($this->Organization);
        $loggedUser = $this->loggedUser;

        $this->set(compact('organization', 'loggedUser'));
    }

    /**
     * View method
     *
     * @param string|null $id Organization id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $organization = $this->Organization->get($id, [
            'contain' => ['Customer', 'Group', 'Invoice', 'InvoiceItem', 'Order', 'OrderItem', 'Payment', 'PriceEntry', 'Product', 'SupportCase', 'User', 'UserGroup']
        ]);
        $loggedUser = $this->loggedUser;

        $this->set(['organization' => $organization, 'loggedUser' => $this->loggedUser]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $organization = $this->Organization->newEntity();
        if ($this->request->is('post')) {
            $organization = $this->Organization->patchEntity($organization, $this->request->getData());
            if ($this->Organization->save($organization)) {
                $this->Flash->success(__('The organization has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The organization could not be saved. Please, try again.'));
        }
        $loggedUser = $this->loggedUser;

        $this->set(['organization' => $organization, 'loggedUser' => $this->loggedUser]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Organization id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $organization = $this->Organization->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $organization = $this->Organization->patchEntity($organization, $this->request->getData());
            if ($this->Organization->save($organization)) {
                $this->Flash->success(__('The organization has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The organization could not be saved. Please, try again.'));
        }
        $loggedUser = $this->loggedUser;

        $this->set(['organization' => $organization, 'loggedUser' => $this->loggedUser]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Organization id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $organization = $this->Organization->get($id);
        if ($this->Organization->delete($organization)) {
            $this->Flash->success(__('The organization has been deleted.'));
        } else {
            $this->Flash->error(__('The organization could not be deleted. Please, try again.'));
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
        if ($user != null and $this->loggedUser != null
            and $user['login_name'] == $this->loggedUser['login_name']
            and in_array('organization', $this->loggedUser['active_features'])){

            return true;
        }

        return false;
    }
}
