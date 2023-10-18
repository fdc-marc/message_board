<?php
date_default_timezone_set('Asia/Singapore');
App::uses('AppController', 'Controller');

class UsersController extends AppController
{
    public function beforeFilter()
    {
        $this->Auth->allow(array('login', 'login_request', 'register', 'register_request'));
    }

    public function get_users()
    {

        // get current user
        $current_user = $this->Session->read('Auth.User');
        $user_check = isset($current_user['User']) ? $current_user['User'] : $current_user;

        $users = $this->User->find('all', array(
            'conditions' => array('User.id NOT' => $user_check['id'])
        ));

        $this->autoRender = false;

        echo json_encode($users);
    }

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

                    $user_update = array(
                        'id' => $user['User']['id'],
                        'last_login_date' => date('Y-m-d H:i:s')
                    );

                    if ($this->User->save($user_update)) {
                        $this->Session->write('Auth.User', $user);
                        $this->Session->write('logged_in', true);
                        $this->Session->setFlash('Successfully logged in!');

                        $this->set('user', $user['User']);
                        $this->redirect(array('action' => 'profile'));
                    }
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
    }

    public function register_request()
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

            var_dump($existingUser);

            if ($existingUser) {
                $this->Session->setFlash('Email address is already in use.', 'default', array('class' => 'form-text text-danger'));
                $this->redirect(array('action' => 'register'));
            }

            if ($this->User->save($register_data)) {
                // Store user data in the session
                $register_data['id'] = $this->User->getInsertID();
                $this->Session->write('Auth.User', $register_data);
                $this->Session->write('logged_in', true);

                return $this->redirect(array('controller' => 'Users', 'action' => 'thank_you'));
                // }
            } else {
                $this->Session->setFlash(__('Registration Failed.'));
                $this->redirect(array('action' => 'register'));
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

        $user_check = isset($current_user['User']) ? $current_user['User'] : $current_user;

        $user_details = $this->User->find('first', array(
            'conditions' => array('User.id' => $user_check['id'])
        ));

        // format datetime values
        $joinedDateTime = new DateTime($user_details['User']['joined_date']);
        $user_details['User']['joined_date'] = $joinedDateTime->format("F d, Y gA");

        if (isset($user['User']['last_login_date'])) {
            $lastLoginDateTime = new DateTime($user['User']['last_login_date']);
            $user['User']['last_login_date'] = $lastLoginDateTime->format("F d, Y gA");
        }


        $this->set('user', $user_details['User']);
    }

    public function edit()
    {
        $current_user = $this->Session->read('Auth.User');

        $user_check = isset($current_user['User']) ? $current_user['User'] : $current_user;

        $user_details = $this->User->find('first', array(
            'conditions' => array('User.id' => $user_check['id'])
        ));


        $user_details['User']['birthdate'] = date('m/d/Y', strtotime($user_details['User']['birthdate']));
        // $formattedDate = date("m/d/Y", strtotime($date));
        $this->set('user', $user_details['User']);
    }


    public function edit_profile()
    {
        if ($this->request->is('post')) {
            $this->User->set($this->request->data);
            $edit_data = $this->request->data;

            // fix birthdate format
            $edit_data['birthdate'] =  date("Y-m-d", strtotime($edit_data['birthdate']));

            if ($_FILES['profile-photo']['name']) {
                $file = $_FILES['profile-photo'];

                if ($file['error'] === UPLOAD_ERR_OK) {
                    $file_new_name = $file['name'] . "-" . $edit_data['id'];
                    $file_destination = WWW_ROOT . 'img' . DS . 'profile-photos' . DS . $file_new_name;

                    if (move_uploaded_file($file['tmp_name'], $file_destination)) {
                        // The file was successfully moved to the destination
                        $edit_data['photo'] = $file_new_name;
                        if ($this->User->save($edit_data)) {
                            $this->Flash->success('Successfully updated profile!');
                            $this->redirect(array('controller' => 'Users', 'action' => 'profile'));
                        } else {
                            $this->Flash->error('Failed to update profile!');
                        }
                    } else {
                        // Error moving the file
                        $this->Session->setFlash('Error uploading file.', 'error');
                    }
                } else {
                    // Handle the file upload error
                    $this->Session->setFlash('File upload error.', 'error');
                }
            } else {
                if ($this->User->save($edit_data)) {
                    $this->Flash->success('Successfully updated profile!');
                    $this->redirect(array('controller' => 'Users', 'action' => 'profile'));
                } else {
                    $this->Flash->error('Failed to update profile!');
                }
            }
        }
    }

    public function edit_email()
    {
        $current_user = $this->Session->read('Auth.User');

        $user_check = isset($current_user['User']) ? $current_user['User'] : $current_user;

        $user_details = $this->User->find('first', array(
            'conditions' => array('User.id' => $user_check['id'])
        ));

        $this->set('user', $user_details['User']);
    }

    public function edit_email_request()
    {
        if ($this->request->is('post')) {
            $this->User->set($this->request->data);

            if ($this->User->validates()) {
                // Data passed validation rules
                $edit_data = $this->request->data;

                if ($this->User->save($edit_data)) {
                    $this->Flash->success('Successfully updated email!');
                    $this->redirect(array('controller' => 'Users', 'action' => 'profile'));
                } else {
                    $this->Flash->error('Failed to update email!');
                    $this->redirect(array('action' => 'edit_email'));
                }
            } else {
                // Data failed validation
                $this->Flash->error('Validation failed. Please check the form for errors.');
                $this->redirect(array('action' => 'edit_email'));
            }
        }
    }

    public function edit_password()
    {
        $current_user = $this->Session->read('Auth.User');

        $user_check = isset($current_user['User']) ? $current_user['User'] : $current_user;

        $user_details = $this->User->find('first', array(
            'conditions' => array('User.id' => $user_check['id'])
        ));

        $this->set('user', $user_details['User']);
    }

    public function edit_password_request()
    {
        if ($this->request->is('post')) {

            $password_data = $this->request->data;
            $this->User->set($password_data);

            if ($password_data['password'] == $password_data['confirmPassword']) {
                if ($this->User->save($password_data)) {
                    $this->Flash->success('Successfully changed password!');
                    $this->redirect(array('controller' => 'Users', 'action' => 'profile'));
                } else {
                    $this->Flash->error('Failed to change password!');
                    $this->redirect(array('action' => 'edit_password'));
                }
            } else {
                $this->Flash->error('Your passwords did not match.');
                $this->redirect(array('action' => 'edit_password'));
            }
        }
    }
}
