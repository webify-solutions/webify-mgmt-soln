<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Organization;
use App\Utils\PropertyUtils;
use Cake\ORM\TableRegistry;

/**
 * Organization Controller
 *
 * @property \App\Model\Table\OrganizationTable $Organization
 *
 * @method \App\Model\Entity\Organization[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MyOrganizationController extends AppController
{

    /**
     * View method
     *
     * @param string|null $id Organization id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $organization = TableRegistry::getTableLocator()->get('Organization')->get($id);

        if ($this->loggedUserOrgId != null and $organization->id != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }

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
        $organization = TableRegistry::getTableLocator()->get('Organization')->get($id);

        if ($this->loggedUserOrgId != null and $organization->id != ($this->loggedUserOrgId)) {
            $this->unauthorizedAccessRedirect();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $organization = TableRegistry::getTableLocator()->get('Organization')->patchEntity($organization, $this->request->getData());
            if (TableRegistry::getTableLocator()->get('Organization')->save($organization)) {
                $this->Flash->success(__('The organization has been saved.'));

                return $this->redirect(['action' => 'view', $organization->id]);
            }
            $this->Flash->error(__('The organization could not be saved. Please, try again.'));
        }

        $currencies = PropertyUtils::$currencies;

        $this->set(['organization' => $organization, 'loggedUser' => $this->loggedUser, 'currencies' => $currencies]);
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
