<?php

App::uses('AppController', 'Controller');

class MessagesController extends Controller
{

    public function index()
    {
        // get all conversations by user id
        // display with pagination in view
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
            // var_dump($message);

            $current_user = $this->Session->read('Auth.User');
            $user_check = isset($current_user['User']) ? $current_user['User'] : $current_user;

            $current_date_time =  date('Y-m-d H:i:s');

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
            } else { // convo does not exist
                // insert conversation entry
                $this->Conversation->create();

                $conversation['user1'] = $user_check['id']; // user1 = sender
                $conversation['user2'] = $message['recipient']; // user2 = receiver
                $conversation['latest_message_time'] = $current_date_time;

                if ($this->Conversation->save($conversation)) {
                    // insert message
                    $message_data['sender_id'] = $user_check['id'];
                    $message_data['receiver_id'] = $message['recipient'];
                    $message_data['conversation_id'] = $this->Conversation->getInsertID();
                    $message_data['content'] = $message['content'];
                    $message_data['time_sent'] = $current_date_time;

                    if ($this->Message->save($message_data)) {
                        $this->Session->setFlash('Successfully sent message!');
                        $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash('Error sending message!');
                        $this->redirect(array('action' => 'create'));
                    }
                } else {
                    $this->Session->setFlash('Error sending message!');
                    $this->redirect(array('action' => 'create'));
                }
            }
        }

        // get sender_id & receiver_id
        // check if convo exists between sender and receiver
        // if existing => add message to existing conversation
        // if NOT existing => create conversation and insert message
        // Conversation details:
        // {
        // user1: 1,
        // user2: 2,
        // latest_message_datetime: "2014/08/04 03:20"
        // }
        //Message details:
        // {
        //     conversation_id: 1,
        //     content: "Hello",
        //     sender: 1,
        //     receiver: 2,
        //     time_sent: "2014/08/04 03:20"
        // } 

    }
}
