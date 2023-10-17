<div class="container py-3">
    <?php
    echo $this->Session->flash('flash');
    $paginator = $this->Paginator;
    // $current_user = $this->Session->read('Auth.User');
    // $user_check = isset($current_user['User']) ? $current_user['User'] : $current_user;
    ?>


    <h1>Message List</h1>

    <div class="row pb-3">
        <div class="col-12 d-flex justify-content-end">
            <?php echo $this->Html->link('New Message', array('controller' => 'messages', 'action' => 'create'), ['class' => 'btn btn-success px-3 py-2']); ?>
        </div>
    </div>

    <?php
    foreach ($conversations as $conversation) :
        $latest_message = $conversation['Message'][0];
        $user_image = $conversation['User']['photo'];
        $conversation_id = $conversation['Conversation']['id'];
        // var_dump($conversation);

        $convo_image = $user_image ? $this->webroot . 'img/profile-photos/' . $user_image : $this->webroot . 'img/empty-image.jpeg';
        if ($latest_message['user_id'] != $user['id']) :
    ?>
            <!-- if last message sent was from other person -->
            <div class="convo-container">

                <div class="row">
                    <div class="col-1 px-0">
                        <img class="convo-img" src="<?php echo $convo_image; ?>">
                    </div>
                    <div class="col-11">
                        <div class="row convo-content p-3">
                            <div class="col-12 d-flex align-items-center">
                                <p class="text-truncate mb-0">
                                    <?php echo $latest_message['content'] ?></p>
                            </div>

                        </div>
                        <div class="row convo-footer px-3">
                            <div class="col-6 d-flex justify-content-start align-items-center">
                                <?php echo $this->Html->link('View', array('controller' => 'messages', 'action' => 'view', $conversation_id), ['class' => 'btn btn-info btn-sm viewConvoBtn']); ?>
                                <button id="" class="btn btn-danger btn-sm deleteConvoBtn" data-convo-id="<?php echo $conversation_id ?>">Delete</button>
                            </div>
                            <div class=" col-6 d-flex justify-content-end align-items-center">
                                <?php echo $latest_message['time_sent'] ?>
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
                                    <?php echo $latest_message['content'] ?>
                                </p>

                            </div>

                        </div>
                        <div class="row convo-footer px-3">
                            <div class="col-12 d-flex justify-content-end">
                                <div class="col-6 d-flex justify-content-start align-items-center">
                                    <?php echo $this->Html->link('View', array('controller' => 'messages', 'action' => 'view', $conversation_id), ['class' => 'btn btn-info btn-sm viewConvoBtn']); ?>
                                    <button id="" class="btn btn-danger btn-sm deleteConvoBtn" data-convo-id="<?php echo $conversation_id ?>">Delete</button>
                                </div>
                                <div class="col-6 d-flex justify-content-end align-items-center">
                                    <?php echo $latest_message['time_sent'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 px-0">
                        <img class="convo-img" src="<?php echo $convo_image; ?>">
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