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

    public function register()
    {
        if ($this->request->is('post')) {
            $this->User->create();

            $register_data = $this->request->data;
            unset($register_data['confirmPassword']);
            $register_data['joined_date'] = date('Y-m-d H:i:s');
            $register_data['password'] = password_hash($register_data['password'], PASSWORD_DEFAULT);

            if ($this->User->save($register_data)) {
                $this->Session->setFlash('User registered successfully!');
                $this->redirect(array('controller' => 'Users', 'action' => 'login'));
            }
        }
    }

    public function index()
    {
        return "Hello";
    }
}
