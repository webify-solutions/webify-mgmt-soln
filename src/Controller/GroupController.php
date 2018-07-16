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
        $group = $this->paginate($this->Group);

        $this->set(compact('group'));
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

        $this->set('group', $group);
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
            if ($this->Group->save($group)) {
                $this->Flash->success(__('The group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The group could not be saved. Please, try again.'));
        }
        $organization = $this->Group->Organization->find('list', ['limit' => 200]);
        $user = $this->Group->User->find('list', ['limit' => 200]);
        $this->set(compact('group', 'organization', 'user'));
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $group = $this->Group->patchEntity($group, $this->request->getData());
            if ($this->Group->save($group)) {
                $this->Flash->success(__('The group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The group could not be saved. Please, try again.'));
        }
        $organization = $this->Group->Organization->find('list', ['limit' => 200]);
        $user = $this->Group->User->find('list', ['limit' => 200]);
        $this->set(compact('group', 'organization', 'user'));
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
        if ($this->Group->delete($group)) {
            $this->Flash->success(__('The group has been deleted.'));
        } else {
            $this->Flash->error(__('The group could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
