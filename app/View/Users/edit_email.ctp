<div class="container pt-3">


    <?php
    // if ($this->Session->flash('flash')) :
    echo $this->Session->flash('flash');
    ?>

    <div class="profile-section pt-3">
        <div class="row">
            <div class="col-3">
                <h2>Edit Email Address</h2>
            </div>

            <div class="col-9 d-flex align-items-center justify-content-end">
                <?php echo $this->Html->link('Profile', array('controller' => 'Users', 'action' => 'profile'), ['class' => 'btn btn-dark']); ?>
                <?php echo $this->Html->link('Edit Profile', array('controller' => 'Users', 'action' => 'edit'), ['class' => 'btn btn-secondary']); ?>
                <?php echo $this->Html->link('Change Password', array('controller' => 'Users', 'action' => 'edit_password'), ['class' => 'btn btn-info']); ?>
            </div>

        </div>

        <form action="/message_board/users/edit_email_request" method="post">
            <input type="hidden" value="<?php echo $user['id'] ?>" name="id">

            <div class="row pt-2 pb-3">
                <div class="col-12">
                    <h6>Email:</h6>
                    <input type="text" name="email" class="form-control" value="<?php echo $user['email'] ?>">
                </div>
            </div>


            <button type="submit" class="btn btn-success px-3">Update</button>
        </form>
    </div>
</div>
</div>