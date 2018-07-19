<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;

/**
 * User Controller
 *
 * @property \App\Model\Table\UserTable $User
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserController extends AppController
{

    protected $userRoles = ['Admin'=> 'Admin', 'Sales' => 'Sales', 'Cashier' => 'Cashier', 'Technician' => 'Technician'];
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Organization']
        ];

        if ($this->loggedUserOrgId != null) {
            $user = $this->paginate($this->User->find()->where(['organization_id' => $this->loggedUserOrgId]));
        } else {
            $user = $this->paginate($this->User);
        }

        $this->set(['user' => $user, 'loggedUser' => $this->loggedUser]);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->User->get($id, [
            'contain' => ['Organization', 'Group']
        ]);

        if ($this->loggedUserOrgId != null and $user['organization_id'] != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }
        $this->set(['user' => $user, 'loggedUser' => $this->loggedUser]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->User->newEntity();
        if ($this->request->is('post')) {
            $user = $this->User->patchEntity($user, $this->request->getData());


            if ($this->loggedUserOrgId != null) {
                $user->set('organization_id', $this->loggedUserOrgId);
            }

            if ($this->User->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }


        if ($this->loggedUserOrgId == null) {
            $organization = $this->User->Organization->find('list', ['limit' => 200]);
            $group = $this->User->Group->find('list', ['limit' => 200]);
        } else {
            $organization = null;
            $group = $this->User->Group->find('list', ['limit' => 200])->where(['organization_id' => $this->loggedUserOrgId]);
        }

        $this->set(['user' => $user, 'loggedUser' => $this->loggedUser, 'organization' => $organization, 'group' => $group, 'userRoles' => $this->userRoles]);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->User->get($id, [
            'contain' => ['Group']
        ]);

        if ($this->loggedUserOrgId != null and $user['organization_id'] != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->User->patchEntity($user, $this->request->getData());
            $user->role;
            if ($this->User->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        if ($this->loggedUserOrgId == null) {
            $organization = $this->User->Organization->find('list', ['limit' => 200]);
            $group = $this->User->Group->find('list', ['limit' => 200]);
        } else {
            $organization = null;
            $group = $this->User->Group->find('list', ['limit' => 200])->where(['organization_id' => $this->loggedUserOrgId]);
        }

        $this->set(['user' => $user, 'loggedUser' => $this->loggedUser, 'organization' => $organization, 'group' => $group, 'userRoles' => $this->userRoles]);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->User->get($id);

        if ($this->loggedUserOrgId != null and $user['organization_id'] != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }

        if ($this->User->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
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
            and in_array('user', $this->loggedUser['active_features'])) {

            return true;
        }

        return false;
    }
}
