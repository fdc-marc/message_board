<div class="container pt-3">


    <?php
    // if ($this->Session->flash('flash')) :
    echo $this->Session->flash('flash');
    ?>

    <div class="profile-section pt-3">
        <div class="row">
            <div class="col-3">
                <h2>User Profile</h2>
            </div>

            <div class="col-9 d-flex align-items-center justify-content-end">
                <?php echo $this->Html->link('Edit Profile', array('controller' => 'Users', 'action' => 'edit'), ['class' => 'btn btn-dark']); ?>
                <?php echo $this->Html->link('Change Email', array('controller' => 'Users', 'action' => 'edit_email'), ['class' => 'btn btn-secondary']); ?>
                <?php echo $this->Html->link('Change Password', array('controller' => 'Users', 'action' => 'edit_password'), ['class' => 'btn btn-info']); ?>
            </div>

        </div>

        <div class="row pt-3">
            <div class="col-4 d-flex justify-content-center align-items-center">
                <div class="profile-img">
                    <?php
                    if (!$user['photo']) : ?>
                        <img id="image-preview" src="<?php echo $this->webroot; ?>img/empty-image.jpeg">
                    <?php else : ?>
                        <img id="image-preview" src="<?php echo $this->webroot; ?>img/profile-photos/<?php echo $user['photo'] ?>">
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-8 pt-3 d-flex flex-column justify-content-center">
                <div class="row">
                    <div class="col-12">
                        <h3><?php echo isset($user['name']) ? $user['name'] : $user['User']['name'] ?></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h6>Gender: <?php echo $user['gender'] ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h6>Birthdate: <?php echo $user['birthdate'] ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h6>Joined: <?php echo $user['joined_date'] ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h6>Last Login: <?php echo $user['last_login_date'] ?></h6>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h6>Hobby:</h6>
                <h6><?php echo $user['hobby'] ?></h6>
            </div>
        </div>


    </div>
</div>
</div>