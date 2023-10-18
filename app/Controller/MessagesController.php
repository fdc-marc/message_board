<?php
date_default_timezone_set('Asia/Singapore');

App::uses('AppController', 'Controller');

class MessagesController extends AppController
{
    public $components = array('Paginator');

    public function index()
    {

        $this->loadModel('Conversation');
        $this->loadModel('User');


        $current_user = $this->Session->read('Auth.User');
        $user_check = isset($current_user['User']) ? $current_user['User'] : $current_user;

        $user_details = $this->User->find('first', array(
            'conditions' => array('User.id' => $user_check['id'])
        ));

        $limit = array_key_exists('n', $this->request->query) ? (int) $this->request->query['n'] : 10;

        $this->Paginator->settings = array(
            'conditions' => array(
                'OR' => array(
                    array(
                        'Conversation.user1' => $user_details['User']['id']
                    ),
                    array(
                        'Conversation.user2' => $user_details['User']['id']
                    )
                ),
                // 'Message.content LIKE' => '%' . $term . '%'
            ),
            'order' => 'Conversation.latest_message_time DESC',

            'joins' => array(
                array(
                    'table' => 'messages',
                    'alias' => 'Message',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Message.conversation_id = Conversation.id'
                    )
                )
            ),
            'group' => 'Conversation.id',

            'contain' => array(
                'Message' => array(
                    'order' => array('Message.time_sent DESC'),
                    'limit' => 1,
                    // 'User'
                )
            ),
            'limit' => $limit

        );
        $conversations = $this->Paginator->paginate('Conversation');

        // var_dump($conversations);

        // get user from latest message of the convo
        foreach ($conversations as &$conversation) {
            $latest_message_user = $this->User->find('first', array(
                'conditions' => array(
                    'User.id' => $conversation['Message'][0]['user_id']
                ),
                'fields' => array(
                    'User.id',
                    'User.name',
                    'User.email',
                    'User.photo',
                )

            ));

            if ($latest_message_user) {
                $user = array(
                    'id' => $latest_message_user['User']['id'],
                    'name' => $latest_message_user['User']['name'],
                    'email' => $latest_message_user['User']['email'],
                    'photo' => $latest_message_user['User']['photo']
                );
                $conversation['User'] = $user;
            }
        }

        // var_dump($messages);

        // $this->set('conversations', $conversations);
        $this->set(compact('conversations'));
        $this->set('user', $user_details['User']);
        $this->set('next_limit', $limit + 10);
    }

    public function view($id = null)
    {
        $this->loadModel('User');
        $current_user = $this->Session->read('Auth.User');
        $user_check = isset($current_user['User']) ? $current_user['User'] : $current_user;

        $user_details = $this->User->find('first', array(
            'conditions' => array('User.id' => $user_check['id'])
        ));

        $limit = array_key_exists('n', $this->request->query) ? (int) $this->request->query['n'] : 10;

        $this->Paginator->settings = array(
            'conditions' => array('Message.conversation_id' => $id),
            'order' => 'Message.time_sent DESC',
            'limit' => $limit
        );
        $messages = $this->Paginator->paginate('Message');

        $this->set('user', $user_details['User']);
        $this->set(compact('messages'));
        $this->set('next_limit', $limit + 10);

        // var_dump($messages);
    }

    public function search_conversation()
    {
        if ($this->request->is('post')) {

            $this->loadModel('Conversation');
            $this->loadModel('User');

            $current_user = $this->Session->read('Auth.User');
            $user_check = isset($current_user['User']) ? $current_user['User'] : $current_user;

            $user_details = $this->User->find('first', array(
                'conditions' => array('User.id' => $user_check['id'])
            ));

            $searchTerm = $this->request->data['query'];

            $this->Paginator->settings = array(
                'conditions' => array(
                    'OR' => array(
                        array(
                            'Conversation.user1' => $user_details['User']['id']
                        ),
                        array(
                            'Conversation.user2' => $user_details['User']['id']
                        )
                    ),
                    'Message.content LIKE' => '%' . $searchTerm . '%'
                ),
                'order' => 'Conversation.latest_message_time DESC',
                'group' => 'Conversation.id',
                'joins' => array(
                    array(
                        'table' => 'messages',
                        'alias' => 'Message',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Message.conversation_id = Conversation.id'
                        )
                    )
                ),
                'limit' => 10

            );

            $conversations = $this->Paginator->paginate('Conversation');

            // get user information
            foreach ($conversations as &$conversation) {
                $latest_message_user = $this->User->find('first', array(
                    'conditions' => array(
                        'User.id' => $conversation['Message'][0]['user_id']
                    ),
                    'fields' => array(
                        'User.id',
                        'User.name',
                        'User.email',
                        'User.photo',
                    )

                ));

                if ($latest_message_user) {
                    $user = array(
                        'id' => $latest_message_user['User']['id'],
                        'name' => $latest_message_user['User']['name'],
                        'email' => $latest_message_user['User']['email'],
                        'photo' => $latest_message_user['User']['photo']
                    );
                    $conversation['Message'][0]['user'] = $user;
                }
            }

            $this->autoRender = false;
            echo json_encode($conversations);
        }
    }

    public function search_message()
    {
        if ($this->request->is('post')) {
            $current_user = $this->Session->read('Auth.User');
            $user_check = isset($current_user['User']) ? $current_user['User'] : $current_user;

            $searchTerm = $this->request->data['query'];
            $id = $this->request->data['convo_id'];

            $this->Paginator->settings = array(
                'conditions' => array('Message.conversation_id' => $id, 'Message.content LIKE' => '%' . $searchTerm . '%'),
                'order' => 'Message.time_sent DESC',
                'limit' => 10
            );
            $messages = $this->Paginator->paginate('Message');

            $this->autoRender = false;
            echo json_encode($messages);
        }
    }

    public function create()
    {
        $this->loadModel('User');
    }

    public function create_message()
    {
        if ($this->request->is('post')) {
            $this->loadModel('Conversation');

            $message = $this->request->data;


            $current_user = $this->Session->read('Auth.User');
            $user_check = isset($current_user['User']) ? $current_user['User'] : $current_user;

            $current_date_time =  date('Y-m-d H:i:s');

            $message_data['content'] = $message['content'];
            $message_data['time_sent'] = $current_date_time;
            $message_data['user_id'] = $user_check['id'];
            $message_data['receiver_id'] = $message['recipient'];

            // Check if users has existing convo
            $existingConvo = $this->Conversation->find('first', array(
                'conditions' => array(
                    'OR' => array(
                        array(
                            'AND' => array(
                                'Conversation.user1' => $user_check['id'],
                                'Conversation.user2' => $message['recipient']
                            )
                        ),
                        array(
                            'AND' => array(
                                'Conversation.user1' => $message['recipient'],
                                'Conversation.user2' => $user_check['id']
                            )
                        )
                    )
                )
            ));

            // convo already exists
            if ($existingConvo) {
                $message_data['conversation_id'] = $existingConvo['Conversation']['id'];

                // $conversation['latest_message_time'] = $current_date_time;
                $conversation_update = array(
                    'id' => $existingConvo['Conversation']['id'],
                    'latest_message_time' => date('Y-m-d H:i:s')
                );

                if ($this->Conversation->save($conversation_update)) {
                    $this->Message->set($message_data);
                    if ($this->Message->validates()) {
                        if ($this->Message->save($message_data)) {
                            $this->Session->setFlash('Successfully sent message!');
                            $this->redirect(array('controller' => 'Messages', 'action' => 'index'));
                        } else {
                            $this->Session->setFlash('Failed to send message!');
                            $this->redirect(array('controller' => 'Messages', 'action' => 'index'));
                        }
                    } else {
                        $this->Session->setFlash('Failed to send message!');
                        $this->redirect(array('controller' => 'Messages', 'action' => 'index'));
                    }
                }
            } else { // convo does not exist
                // insert conversation entry
                $this->Conversation->create();

                $conversation['user1'] = $user_check['id']; // user1 = sender
                $conversation['user2'] = $message['recipient']; // user2 = receiver
                $conversation['latest_message_time'] = $current_date_time;

                if ($this->Conversation->save($conversation)) {
                    // insert message
                    $message_data['conversation_id'] = $this->Conversation->getInsertID();

                    $this->Message->set($message_data);
                    if ($this->Message->validates()) {
                        if ($this->Message->save($message_data)) {
                            $this->Session->setFlash('Successfully sent message!');
                            $this->redirect(array('action' => 'index'));
                        } else {
                            $this->Session->setFlash('Error sending message!');
                            $this->redirect(array('action' => 'create'));
                        }
                    }
                } else {
                    $this->Session->setFlash('Error sending message!');
                    $this->redirect(array('action' => 'create'));
                }
            }
        }
    }

    public function add_reply()
    {
        if ($this->request->is('post')) {
            $this->loadModel('Conversation');

            $data = $this->request->data;
            $current_date_time =  date('Y-m-d H:i:s');


            // update conversation latest_message_time
            $conversation_update = array(
                'id' => $data['conversation_id'],
                'latest_message_time' => $current_date_time
            );

            if ($this->Conversation->save($conversation_update)) {
                $message_data['user_id'] = $data['user_id'];
                $message_data['receiver_id'] = $data['receiver_id'];
                $message_data['conversation_id'] = $data['conversation_id'];
                $message_data['content'] = $data['content'];
                $message_data['time_sent'] = $current_date_time;

                if ($this->Message->save($message_data)) {
                    // pass message data back to view
                    $data['id'] = $this->Message->getInsertID();
                    $data['time_sent'] = $current_date_time;
                    echo json_encode($data);
                } else {
                    echo json_encode(false);
                }
            }

            $this->autoRender = false;
            exit;
        }
    }

    public function delete_conversation()
    {
        if ($this->request->is('post')) {
            $this->loadModel('Conversation');

            if ($this->Conversation->delete($this->request->data, true)) {
                // cascade delete did not work, so manually delete all messages here
                $messages = $this->Message->find('all', array(
                    'conditions' => array('Message.conversation_id' => $this->request->data['id'])
                ));

                foreach ($messages as $message) {
                    $this->Message->delete($message['Message']['id']);
                }

                echo json_encode(true);
            } else {
                echo json_encode(false);
            }

            $this->autoRender = false;
            exit;
        }
    }

    public function delete_message()
    {
        if ($this->request->is('post')) {
            if ($this->Message->delete($this->request->data['id'])) {
                echo json_encode(true);
            } else {
                echo json_encode(false);
            }

            $this->autoRender = false;
            exit;
        }
    }
}
