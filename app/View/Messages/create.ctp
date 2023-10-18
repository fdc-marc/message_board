<div class="container py-3">
    <?php
    // if ($this->Session->flash('flash')) :
    echo $this->Session->flash('flash');
    ?>


    <div class="row">
        <div class="col-6">
            <h1>Create New Message</h1>
        </div>
        <div class="col-6 d-flex justify-content-end align-items-center">
            <?php echo $this->Html->link('Back to Message List', array('controller' => 'messages', 'action' => 'index'), ['class' => 'btn btn-dark']); ?>
        </div>
    </div>


    <form action="/message_board/messages/create_message" method="post">
        <div class="row">
            <div class="col-6">
                <label>Recipient:</label>
                <select id="add-recipient" name="recipient" style="width:100%;">

                </select>
            </div>
        </div>

        <div class="row pt-3">
            <div class="col-12">
                <label>Message:</label>
            </div>
            <div class="col-6">
                <textarea name="content" rows="4" placeholder="Write message here..." style="width: 100%"></textarea>
            </div>

        </div>

        <div class="row pt-3">
            <div class="col-6 d-flex justify-content-end">
                <button type="submit" class="btn btn-success px-4" id="createMessageBtn">
                    Create Message
                </button>
            </div>

        </div>
    </form>


</div>