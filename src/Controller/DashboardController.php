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

        $this->set(compact('dashboard'));
    }
}