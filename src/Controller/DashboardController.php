<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Class DashboardController
 *
 * @package App\Controller
 */
class DashboardController extends AppController
{

    public function initialize()
    {
        parent::initialize();

    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {

        $loggedUser = $this->loggedUser;
        $this->set(compact('dashboard', 'loggedUser'));
    }

    /**
     * Is authorized method
     *
     * @param $user
     * @return bool
     */
    public function isAuthorized($user)
    {
        if ($user != null) {
            return true;
        }

        return false;
    }
}