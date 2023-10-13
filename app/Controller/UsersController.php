<?php

App::uses('AppController', 'Controller');

class UsersController extends Controller
{

    public function login()
    {
    }

    public function logout()
    {
    }

    public function login_request()
    {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->setFlash(__('Successfully logged in!'));
                $this->redirect(array('action' => 'thank_you'));
            } else {
                $this->Session->setFlash(__('Invalid username or password'));
            }
        }
    }

    public function register()
    {
        if ($this->request->is('post')) {
            $this->User->create();

            $register_data = $this->request->data;
            unset($register_data['confirmPassword']);
            $current_date_time =  date('Y-m-d H:i:s');
            $register_data['joined_date'] = $current_date_time;
            $register_data['last_login_date'] = $current_date_time;
            $register_data['password'] = password_hash($register_data['password'], PASSWORD_DEFAULT);

            if ($this->User->save($register_data)) {
                // $this->Session->setFlash('User registered successfully!');
                // $user_id = $this->User->getLastInsertID();

                $this->redirect(array('controller' => 'Users', 'action' => 'thank_you'));
                // $this->set('user_id', $user_id);
            }
        }
    }

    public function thank_you()
    {
        $this->redirect($this->Auth->redirect());
    }

    public function index()
    {
        return "Hello";
    }

    public function profile($id = null)
    {
        $user = $this->User->findById($id);

        // format datetime values
        $joinedDateTime = new DateTime($user['User']['joined_date']);
        $user['User']['joined_date'] = $joinedDateTime->format("F d, Y gA");

        if (isset($user['User']['last_login_date'])) {
            $lastLoginDateTime = new DateTime($user['User']['last_login_date']);
            $user['User']['last_login_date'] = $lastLoginDateTime->format("F d, Y gA");
        }


        $this->set('user', $user['User']);
    }
}
