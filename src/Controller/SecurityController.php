<?php
/**
 * Created by PhpStorm.
 * User: mohammed.waked
 * Date: 2018-07-18
 * Time: 2:45 PM
 */

namespace App\Controller;


class SecurityController extends AppController
{

    /**
     * Security method
     *
     * @return \Cake\Http\Response|null
     */
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            // debug($user);
            // debug($user['active']);
            if ($user && $user['active']) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Your username or password is incorrect.');
        }
    }


    public function logout()
    {
        $this->Auth->logout();

        return $this->redirect(
            [
                'controller' => 'Dashboard',
                'action' => 'index'
            ]
        );
    }

    /**
     * Is authorized method
     *
     * @param $user
     * @return bool
     */
    public function isAuthorized($user)
    {
        return true;
    }
}
