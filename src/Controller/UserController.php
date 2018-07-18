<?php
namespace App\Controller;

use App\Controller\AppController;

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
        $user = $this->paginate($this->User);
        $loggedUser = $this->loggedUser;

        $this->set(compact('user', 'loggedUser'));
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
        $loggedUser = $this->loggedUser;

        $this->set(compact('user', 'loggedUser'));
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
            if ($this->User->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $organization = $this->User->Organization->find('list', ['limit' => 200]);
        $group = $this->User->Group->find('list', ['limit' => 200]);
        $loggedUser = $this->loggedUser;

        $this->set(compact('user', 'organization', 'group', 'userRoles', 'loggedUser'));
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->User->patchEntity($user, $this->request->getData());
            $user->role;
            if ($this->User->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $organization = $this->User->Organization->find('list', ['limit' => 200]);
        $group = $this->User->Group->find('list', ['limit' => 200]);
        $userRoles = ['Admin'=> 'Admin', 'Collector' => 'Collector', 'Technician' => 'Technician'];
        $loggedUser = $this->loggedUser;
        
        $this->set(compact('user', 'organization', 'group', 'userRoles', 'loggedUser'));
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
