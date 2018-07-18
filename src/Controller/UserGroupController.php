<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserGroup Controller
 *
 * @property \App\Model\Table\UserGroupTable $UserGroup
 *
 * @method \App\Model\Entity\UserGroup[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserGroupController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Organization', 'User', 'Group']
        ];
        $userGroup = $this->paginate($this->UserGroup);

        $this->set(compact('userGroup'));
    }

    /**
     * View method
     *
     * @param string|null $id User Group id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userGroup = $this->UserGroup->get($id, [
            'contain' => ['Organization', 'User', 'Group']
        ]);

        $this->set('userGroup', $userGroup);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userGroup = $this->UserGroup->newEntity();
        if ($this->request->is('post')) {
            $userGroup = $this->UserGroup->patchEntity($userGroup, $this->request->getData());
            if ($this->UserGroup->save($userGroup)) {
                $this->Flash->success(__('The user group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user group could not be saved. Please, try again.'));
        }
        $organization = $this->UserGroup->Organization->find('list', ['limit' => 200]);
        $user = $this->UserGroup->User->find('list', ['limit' => 200]);
        $group = $this->UserGroup->Group->find('list', ['limit' => 200]);
        $this->set(compact('userGroup', 'organization', 'user', 'group'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User Group id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userGroup = $this->UserGroup->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userGroup = $this->UserGroup->patchEntity($userGroup, $this->request->getData());
            if ($this->UserGroup->save($userGroup)) {
                $this->Flash->success(__('The user group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user group could not be saved. Please, try again.'));
        }
        $organization = $this->UserGroup->Organization->find('list', ['limit' => 200]);
        $user = $this->UserGroup->User->find('list', ['limit' => 200]);
        $group = $this->UserGroup->Group->find('list', ['limit' => 200]);
        $this->set(compact('userGroup', 'organization', 'user', 'group'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User Group id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userGroup = $this->UserGroup->get($id);
        if ($this->UserGroup->delete($userGroup)) {
            $this->Flash->success(__('The user group has been deleted.'));
        } else {
            $this->Flash->error(__('The user group could not be deleted. Please, try again.'));
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
        return false;
    }
}
