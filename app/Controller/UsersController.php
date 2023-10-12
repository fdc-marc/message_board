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
            $register_data['joined_date'] = date('Y-m-d H:i:s');
            $register_data['password'] = password_hash($register_data['password'], PASSWORD_DEFAULT);

            if ($this->User->save($register_data)) {
                // $this->Session->setFlash('User registered successfully!');
                $this->redirect(array('controller' => 'Users', 'action' => 'thank_you'));
            }
        }
    }

    public function thank_you()
    {
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
