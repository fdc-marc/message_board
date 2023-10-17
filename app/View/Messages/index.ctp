<div class="container py-3">
    <?php
    // if ($this->Session->flash('flash')) :
    echo $this->Session->flash('flash');
    ?>


    <h1>Message List</h1>

    <div class="row pb-3">
        <div class="col-12 d-flex justify-content-end">
            <?php echo $this->Html->link('New Message', array('controller' => 'messages', 'action' => 'create'), ['class' => 'btn btn-success px-3 py-2']); ?>
        </div>
    </div>


    <div class="sender-convo-container">
        <div class="row">
            <div class="col-1 px-0">
                <img class="convo-img" src="<?php echo $this->webroot; ?>img/empty-image.jpeg">
            </div>
            <div class="col-11">
                <div class="row convo-content p-3">
                    <div class="col-12 d-flex align-items-center">
                        <p class="text-truncate mb-0">
                            New Message button will link to add new message page
                            List the new message by conversations into chronological order.
                            Show more link is just like pagination. by click on it should generate next 10 items.
                            Delete (AJAX) - when clicking the delete button the message will fadeout and remove in the row and it should delete also all conversation (Child tables)
                            New Message button will link to add new message page
                            List the new message by conversations into chronological order.
                            Show more link is just like pagination. by click on it should generate next 10 items.</p>

                    </div>

                </div>
                <div class="row convo-footer px-3">
                    <div class="col-12 d-flex justify-content-end">
                        2014/08/04 03:20
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="receiver-convo-container">
        <div class="row">

            <div class="col-11">
                <div class="row convo-content p-3">
                    <div class="col-12 d-flex align-items-center">
                        <p class="text-truncate mb-0">
                            New Message button will link to add new message page
                            List the new message by conversations into chronological order.
                            Show more link is just like pagination. by click on it should generate next 10 items.
                            Delete (AJAX) - when clicking the delete button the message will fadeout and remove in the row and it should delete also all conversation (Child tables)
                            New Message button will link to add new message page
                            List the new message by conversations into chronological order.
                            Show more link is just like pagination. by click on it should generate next 10 items.</p>

                    </div>

                </div>
                <div class="row convo-footer px-3">
                    <div class="col-12 d-flex justify-content-end">
                        <p>
                            2014/08/04 03:20
                        </p>

                    </div>
                </div>
            </div>
            <div class="col-1 px-0">
                <img class="convo-img" src="<?php echo $this->webroot; ?>img/empty-image.jpeg">
            </div>
        </div>
    </div>


</div>