<div class="container pt-3">


    <?php
    // if ($this->Session->flash('flash')) :
    echo $this->Session->flash('flash');
    ?>

    <div class="profile-section pt-3">
        <div class="row">
            <div class="col-3">
                <h2>Change Password</h2>
            </div>

            <div class="col-9 d-flex align-items-center justify-content-end">
                <?php echo $this->Html->link('Profile', array('controller' => 'Users', 'action' => 'profile'), ['class' => 'btn btn-dark']); ?>
                <?php echo $this->Html->link('Edit Profile', array('controller' => 'Users', 'action' => 'edit'), ['class' => 'btn btn-secondary']); ?>
                <?php echo $this->Html->link('Change Email', array('controller' => 'Users', 'action' => 'edit_email'), ['class' => 'btn btn-info']); ?>
            </div>

        </div>

        <form action="/message_board/users/edit_password_request" method="post">
            <input type="hidden" value="<?php echo $user['id'] ?>" name="id">

            <div class="row pt-2 pb-3">
                <div class="col-12">
                    <h6>New Password:</h6>
                    <input type="password" name="password" class="form-control">
                </div>
            </div>

            <div class=" row pt-2 pb-3">
                <div class="col-12">
                    <h6>Confirm New Password:</h6>
                    <input type="password" name="confirmPassword" class="form-control">
                </div>
            </div>

            <button type="submit" class="btn btn-success px-3">Update</button>
        </form>
    </div>
</div>
</div>