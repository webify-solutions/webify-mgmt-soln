<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\ORM\TableRegistry;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    public $loggedUser;
    public $loggedUserOrgId;

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');

        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'userModel' => 'User',
                    'fields' => [
                        'username' => 'login_name',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'Security',
                'action' => 'login'
            ],
            //use isAuthorized in Controllers
            'authorize' => ['Controller'],
            // If unauthorized, return them to page they were just on
            'unauthorizedRedirect' => $this->referer()
        ]);

        // Allow the display action so our PagesController
        // continues to work. Also enable the read only actions.
        $this->Auth->allow(['display']);

        $organization_id = $this->Auth->user('organization_id');
        if ($organization_id  != null) {
            $organizations =  TableRegistry::getTableLocator()->get('Organization');
            $organization = $organizations->get($this->Auth->user('organization_id'));

            $activeFeatures = [
                'Customer',
            ];
            $userRole = $this->Auth->user('role');

            if($userRole == 'Admin') {
                $activeFeatures[] = ('Group');
                $activeFeatures[] = ('User');

                if ($organization['active_product_feature'] == 1) {
                    $activeFeatures[] = ('Product');
                    $activeFeatures[] = ('PriceEntry');
                }

                if ($organization['active_order_feature'] == 1) {
                    $activeFeatures[] = ('Order');
                    $activeFeatures[] = ('OrderItem');
                }

                if ($organization['active_invoicing_feature'] == 1) {
                    $activeFeatures[] = ('Invoice');
                    $activeFeatures[] = ('InvoiceItem');
                    $activeFeatures[] = ('Payment');
                }

                if ($organization['active_case_feature'] == 1) {
                    $activeFeatures[] = ('SupportCase');
                }
            }

            $this->loggedUser = [
                'login_name' => $this->Auth->user('login_name'),
                'role' => $userRole,
                'organization_id' => $organization_id,
                'organization_name' => $organization['name'],
                'active_features' => $activeFeatures
            ];

            $this->loggedUserOrgId = $organization_id;

        } else {
            $this->loggedUser = [
                'login_name' => $this->Auth->user('login_name'),
                'role' => $this->Auth->user('role'),
                'organization_name' => 'All',
                'active_features' => [
                    'Group',
                    'Customer',
                    'Product',
                    'Order',
                    'Invoice',
                    'Support_case',
                    'Payment',
                    'Organization',
                    'User'
                ]
            ];

            $this->loggedUserOrgId = null;
        }
    }

    public function unauthorizedAccessRedirect() {
        $this->Flash->error(__('You are not authorized to access that location.'));

        return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
    }

    public function getLoggedUserAttribute($attribute_name) {
        if ($this->loggedUser != null and array_key_exists($attribute_name, $this->loggedUser)) {
            return $this->loggedUser[$attribute_name];
        }

        return null;
    }

    public function isUserAuthorizedFor($user, $controllerName) {
        if ($user != null and $this->loggedUser != null
            and $user['login_name'] == $this->loggedUser['login_name']
            and in_array($controllerName, $this->loggedUser['active_features'])) {

            return true;
        }

        return false;
    }
}
