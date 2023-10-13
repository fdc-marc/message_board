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

        $user_details = $this->User->find('first', array(
            'conditions' => array('User.id' => $current_user['User']['id'])
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

        $user_details = $this->User->find('first', array(
            'conditions' => array('User.id' => $current_user['User']['id'])
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
}
