<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Group Controller
 *
 * @property \App\Model\Table\GroupTable $Group
 *
 * @method \App\Model\Entity\Group[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GroupController extends AppController
{

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
            $group = $this->paginate($this->Group->find()->where(['organization_id' => $this->loggedUserOrgId]));
        } else {
            $group = $this->paginate($this->Group);
        }

        $this->set(['group'=> $group, 'loggedUser' => $this->loggedUser]);
    }

    /**
     * View method
     *
     * @param string|null $id Group id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $group = $this->Group->get($id, [
            'contain' => ['Organization', 'User', 'Customer']
        ]);

        if ($this->loggedUserOrgId != null and $group['organization_id'] != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }

        $this->set(['group'=> $group, 'loggedUser' => $this->loggedUser]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $group = $this->Group->newEntity();
        if ($this->request->is('post')) {
            $group = $this->Group->patchEntity($group, $this->request->getData());

            if ($this->loggedUserOrgId != null) {
                $group->set('organization_id', $this->loggedUserOrgId);
            }

            if ($this->Group->save($group)) {
                $this->Flash->success(__('The group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The group could not be saved. Please, try again.'));
        }

        if ($this->loggedUserOrgId == null) {
            $organization = $this->Group->Organization->find('list', ['limit' => 200]);
//            $user = $this->Group->User->find('list', ['limit' => 200]);
//            $customer = $this->Group->Customer->find('list', ['limit' => 200]);
        } else {
            $organization = null;
//            $user = $this->Group->User->find('list', ['limit' => 200])->where(['organization_id' => $this->loggedUserOrgId]);
//            $customer = $this->Group->Customer->find('list', ['limit' => 200])->where(['organization_id' => $this->loggedUserOrgId]);
        }

        $this->set(['group'=> $group, 'loggedUser' => $this->loggedUser, 'organization'=>$organization]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Group id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $group = $this->Group->get($id, [
            'contain' => ['User']
        ]);

        if ($this->loggedUserOrgId != null and $group['organization_id'] != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $group = $this->Group->patchEntity($group, $this->request->getData());
            if ($this->Group->save($group)) {
                $this->Flash->success(__('The group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The group could not be saved. Please, try again.'));
        }

        if ($this->loggedUserOrgId == null) {
            $organization = $this->Group->Organization->find('list', ['limit' => 200]);
//            $user = $this->Group->User->find('list', ['limit' => 200]);
//            $customer = $this->Group->Customer->find('list', ['limit' => 200]);
        } else {
            $organization = null;
//            $user = $this->Group->User->find('list', ['limit' => 200])->where(['organization_id' => $this->loggedUserOrgId]);
//            $customer = $this->Group->Customer->find('list', ['limit' => 200])->where(['organization_id' => $this->loggedUserOrgId]);
        }

        $this->set(['group'=> $group, 'loggedUser' => $this->loggedUser, 'organization'=>$organization]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Group id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $group = $this->Group->get($id);

        if ($this->loggedUserOrgId != null and $group['organization_id'] != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }

        if ($this->Group->delete($group)) {
            $this->Flash->success(__('The group has been deleted.'));
        } else {
            $this->Flash->error(__('The group could not be deleted. Please, try again.'));
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
            and in_array('group', $this->loggedUser['active_features'])) {

            return true;
        }

        return false;
    }
}
