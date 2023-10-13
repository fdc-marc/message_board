<?php

App::uses('AppController', 'Controller');

class UsersController extends Controller
{

    public function login()
    {
    }

    public function logout()
    {
        $this->Session->delete('Auth.User');

        $this->redirect(array('controller' => 'users', 'action' => 'login'));
    }

    public function login_request()
    {
        if ($this->request->is('post')) {
            $login_req = $this->request->data;

            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.email' => $login_req['login_email'],
                )
            ));

            if ($user) {
                // check if password is correct
                $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));

                if ($passwordHasher->check($login_req['login_password'], $user['User']['password'])) {
                    $this->Session->write('Auth.User', $user);
                    $this->Session->setFlash('Successfully logged in!');

                    $this->set('user', $user['User']);
                    $this->redirect(array('action' => 'profile'));
                } else {
                    $this->Session->setFlash('Invalid username or password');
                    $this->redirect(array('action' => 'login'));
                }
            } else {
                $this->Session->setFlash('Invalid username or password');
                $this->redirect(array('action' => 'login'));
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
            // $register_data['password'] = password_hash($register_data['password'], PASSWORD_DEFAULT);

            // Check if the email is unique
            $existingUser = $this->User->find('first', array(
                'conditions' => array('User.email' => $register_data['email'])
            ));

            if ($existingUser) {
                $this->Session->setFlash('Email address is already in use.', 'default', array('class' => 'form-text text-danger'));
            }

            if ($this->User->save($register_data)) {
                // Store user data in the session
                $register_data['id'] = $this->User->getInsertID();
                $this->Session->write('Auth.User', $register_data);

                return $this->redirect(array('controller' => 'Users', 'action' => 'thank_you'));
                // }
            } else {
                $this->Session->setFlash(__('Registration Failed.'));
            }
        }
    }

    public function thank_you()
    {
        // $this->redirect($this->Auth->redirect());
    }

    public function index()
    {
        return "Hello";
    }

    public function profile()
    {
        // $user = $this->User->findById($id);
        $current_user = $this->Session->read('Auth.User');

        // format datetime values
        $joinedDateTime = new DateTime($current_user['User']['joined_date']);
        $current_user['User']['joined_date'] = $joinedDateTime->format("F d, Y gA");

        if (isset($user['User']['last_login_date'])) {
            $lastLoginDateTime = new DateTime($user['User']['last_login_date']);
            $user['User']['last_login_date'] = $lastLoginDateTime->format("F d, Y gA");
        }


        $this->set('user', $current_user['User']);
    }
}
