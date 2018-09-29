<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Issues Controller
 *
 * @property \App\Model\Table\IssuesTable $Issues
 *
 * @method \App\Model\Entity\Issue[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class IssuesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
      $issuesQuery = $this->Issues->find()
        ->select([
          'Organization.id',
          'Organization.name',
          'Customer.id',
          'Customer.name',
          'User.id',
          'User.name',
          'Product.id',
          'Product.name',
          'Issues.id',
          'issue_number',
          'status',
          'description',
          'Issues.last_updated'
        ])
        ->contain([
          'Organization',
          'Product',
          'Customer',
          'User'
        ])
        ->order([
          'Issues.last_updated' => 'DESC'
        ]);

      if ($this->loggedUserOrgId != null) {
        $issuesQuery->where([
          'Issues.organization_id' => $this->loggedUserOrgId
        ]);
      }

        $this->set(['issues' => $issuesQuery, 'loggedUser' => $this->loggedUser]);
    }

    /**
     * View method
     *
     * @param string|null $id Issue id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $issue = $this->Issues->get($id, [
            'contain' => ['Organization', 'Customer', 'User', 'Product']
        ]);

        $this->set('issue', $issue);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $issue = $this->Issues->newEntity();
        if ($this->request->is('post')) {
            $issue = $this->Issues->patchEntity($issue, $this->request->getData());
            if ($this->Issues->save($issue)) {
                $this->Flash->success(__('The issue has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The issue could not be saved. Please, try again.'));
        }
        $organization = $this->Issues->Organization->find('list', ['limit' => 200]);
        $customer = $this->Issues->Customer->find('list', ['limit' => 200]);
        $user = $this->Issues->User->find('list', ['limit' => 200]);
        $product = $this->Issues->Product->find('list', ['limit' => 200]);
        $this->set(compact('issue', 'organization', 'customer', 'user', 'product'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Issue id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $issue = $this->Issues->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $issue = $this->Issues->patchEntity($issue, $this->request->getData());
            if ($this->Issues->save($issue)) {
                $this->Flash->success(__('The issue has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The issue could not be saved. Please, try again.'));
        }
        $organization = $this->Issues->Organization->find('list', ['limit' => 200]);
        $customer = $this->Issues->Customer->find('list', ['limit' => 200]);
        $user = $this->Issues->User->find('list', ['limit' => 200]);
        $product = $this->Issues->Product->find('list', ['limit' => 200]);
        $this->set(compact('issue', 'organization', 'customer', 'user', 'product'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Issue id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $issue = $this->Issues->get($id);
        if ($this->Issues->delete($issue)) {
            $this->Flash->success(__('The issue has been deleted.'));
        } else {
            $this->Flash->error(__('The issue could not be deleted. Please, try again.'));
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
