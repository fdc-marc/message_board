<?php

$current_user = $this->Session->read('Auth.User');
$user_check = isset($current_user['User']) ? $current_user['User'] : $current_user;

$sender_id = $messages[0]['Conversation']['user1'] == $user_check['id'] ? $messages[0]['Conversation']['user1'] : $messages[0]['Conversation']['user2'];
$receiver_id = $messages[0]['Conversation']['user1'] == $sender_id ? $messages[0]['Conversation']['user2'] : $messages[0]['Conversation']['user1'];

$msg_image = $user_check['photo'] ? $this->webroot . 'img/profile-photos/' . $user_check['photo'] : $this->webroot . 'img/empty-image.jpeg';
?>

<div class="container py-3">



    <h1>
        Message Detail
    </h1>

    <div class="row py-3">
        <div class="col-6"></div>
        <div class="col-6">
            <textarea name="replyMessage" id="replyMessage" rows="4" style="width: 100%;"></textarea>
        </div>

    </div>

    <div class="row pb-3">
        <div class="col-12 d-flex justify-content-end">
            <button class="btn btn-success replyMessageBtn" data-convo-id="<?php echo $messages[0]['Conversation']['id'] ?> " data-user-id="<?php echo $sender_id ?>" data-receiver-id="<?php echo $receiver_id ?>" data-msg-img="<?php echo $msg_image ?>">Reply Message</button>
        </div>
    </div>

    <div class="messages-section">
        <?php
        foreach ($messages as $message) :
            // $latest_message = $message['Message'][0];
            $user_image = $message['User']['photo'];
            $message_id = $message['Message']['id'];

            $msg_image = $user_image ? $this->webroot . 'img/profile-photos/' . $user_image : $this->webroot . 'img/empty-image.jpeg';

            if ($message['Message']['user_id'] != $user_check['id']) :
        ?>
                <!-- if last message sent was from other person -->
                <div class="convo-container">

                    <div class="row">
                        <div class="col-1 px-0">
                            <img class="convo-img" src="<?php echo $msg_image; ?>">
                        </div>
                        <div class="col-11">
                            <div class="row convo-content p-3">
                                <div class="col-12 d-flex align-items-center">
                                    <p class="text-truncate mb-0">
                                        <?php echo $message['Message']['content'] ?></p>
                                </div>

                            </div>
                            <div class="row convo-footer px-3">
                                <div class="col-6 d-flex justify-content-start align-items-center">
                                    <button class="btn btn-danger btn-sm deleteMessageBtn" data-message-id="<?php echo $message['Message']['id'] ?>">Delete</button>
                                </div>
                                <div class=" col-6 d-flex justify-content-end align-items-center">
                                    <?php echo $message['Message']['time_sent'] ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            <?php else : ?>
                <!-- if last message sent was from user -->
                <div class="convo-container">

                    <div class="row">

                        <div class="col-11">
                            <div class="row convo-content p-3">
                                <div class="col-12 d-flex align-items-center">
                                    <p class="text-truncate mb-0">
                                        <?php echo $message['Message']['content'] ?>
                                    </p>

                                </div>

                            </div>
                            <div class="row convo-footer px-3">
                                <div class="col-12 d-flex justify-content-end">
                                    <div class="col-6 d-flex justify-content-start align-items-center">
                                        <button class="btn btn-danger btn-sm deleteMessageBtn" data-message-id="<?php echo $message['Message']['id'] ?>">Delete</button>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end align-items-center">
                                        <?php echo $message['Message']['time_sent'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 px-0">
                            <img class="convo-img" src="<?php echo $msg_image; ?>">
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>