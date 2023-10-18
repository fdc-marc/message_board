<?php
$paginator = $this->Paginator;


$sender_id = $messages[0]['Conversation']['user1'] == $user['id'] ? $messages[0]['Conversation']['user1'] : $messages[0]['Conversation']['user2'];
$receiver_id = $messages[0]['Conversation']['user1'] == $sender_id ? $messages[0]['Conversation']['user2'] : $messages[0]['Conversation']['user1'];

$msg_image = $user['photo'] ? $this->webroot . 'img/profile-photos/' . $user['photo'] : $this->webroot . 'img/empty-image.jpeg';
?>

<div class="container py-3">


    <div class="row">
        <div class="col-6">
            <h1>
                Message Detail
            </h1>
        </div>
        <div class="col-6 d-flex justify-content-end align-items-center">
            <?php echo $this->Html->link('Back to Message List', array('controller' => 'messages', 'action' => 'index'), ['class' => 'btn btn-dark']); ?>
        </div>
    </div>


    <div class="row py-3">
        <div class="col-6"></div>
        <div class="col-6">
            <textarea name="replyMessage" id="replyMessage" rows="4" class="form-control"></textarea>
        </div>

    </div>

    <div class="row pb-3">
        <div class="col-6">
            <div class="col-6 d-flex justify-content-center align-items-center">
                <label for="">Search: </label>
                <input id="searchMessage" type="text" class="form-control" data-convo-id="<?php echo $messages[0]['Conversation']['id'] ?> ">
            </div>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <button class="btn btn-success replyMessageBtn" data-convo-id="<?php echo $messages[0]['Conversation']['id'] ?> " data-user-id="<?php echo $sender_id ?>" data-receiver-id="<?php echo $receiver_id ?>" data-msg-img="<?php echo $msg_image ?>">Reply Message</button>
        </div>
    </div>

    <input type="hidden" id="view_user_id" value="<?php echo $user['id'] ?>">

    <div class="messages-section">
        <?php
        foreach ($messages as $message) :
            // $latest_message = $message['Message'][0];
            $user_image = $message['User']['photo'];
            $message_id = $message['Message']['id'];

            $msg_image = $user_image ? $this->webroot . 'img/profile-photos/' . $user_image : $this->webroot . 'img/empty-image.jpeg';

            if ($message['Message']['user_id'] != $user['id']) :
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

        <?php
        // pagination section
        echo "<div class='paging'>";

        // the 'first' page button
        echo $paginator->first("First");

        // 'prev' page button, 
        // we can check using the paginator hasPrev() method if there's a previous page
        // save with the 'next' page button
        if ($paginator->hasPrev()) {
            echo $paginator->prev("Prev");
        }

        // the 'number' page buttons
        echo $paginator->numbers(array('modulus' => 2));

        // for the 'next' button
        if ($paginator->hasNext()) {
            echo $paginator->next("Next");
        }

        // the 'last' page button
        echo $paginator->last("Last");

        echo "</div>";
        ?>
    </div>
</div>