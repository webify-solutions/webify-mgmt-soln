<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SupportCase Controller
 *
 * @property \App\Model\Table\SupportCaseTable $SupportCase
 *
 * @method \App\Model\Entity\SupportCase[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SupportCaseController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Customer', 'Organization']
        ];
        $supportCase = $this->paginate($this->SupportCase);

        $this->set(compact('supportCase'));
    }

    /**
     * View method
     *
     * @param string|null $id Support Case id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $supportCase = $this->SupportCase->get($id, [
            'contain' => ['Customer', 'Organization']
        ]);

        $this->set('supportCase', $supportCase);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $supportCase = $this->SupportCase->newEntity();
        if ($this->request->is('post')) {
            $supportCase = $this->SupportCase->patchEntity($supportCase, $this->request->getData());
            if ($this->SupportCase->save($supportCase)) {
                $this->Flash->success(__('The support case has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The support case could not be saved. Please, try again.'));
        }
        $customer = $this->SupportCase->Customer->find('list', ['limit' => 200]);
        $organization = $this->SupportCase->Organization->find('list', ['limit' => 200]);
        $this->set(compact('supportCase', 'customer', 'organization'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Support Case id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $supportCase = $this->SupportCase->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $supportCase = $this->SupportCase->patchEntity($supportCase, $this->request->getData());
            if ($this->SupportCase->save($supportCase)) {
                $this->Flash->success(__('The support case has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The support case could not be saved. Please, try again.'));
        }
        $customer = $this->SupportCase->Customer->find('list', ['limit' => 200]);
        $organization = $this->SupportCase->Organization->find('list', ['limit' => 200]);
        $this->set(compact('supportCase', 'customer', 'organization'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Support Case id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $supportCase = $this->SupportCase->get($id);
        if ($this->SupportCase->delete($supportCase)) {
            $this->Flash->success(__('The support case has been deleted.'));
        } else {
            $this->Flash->error(__('The support case could not be deleted. Please, try again.'));
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
