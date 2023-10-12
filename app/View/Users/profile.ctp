<div class="container pt-3">


    <div class="profile-section">
        <h2>User Profile</h2>
        <div class="row pt-3">
            <div class="col-4 d-flex justify-content-center align-items-center">
                <div class="profile-img">
                    <?php echo $this->Html->image('empty-image.jpeg', array('alt' => 'empty-img', 'height' => 250, 'width' => 250)); ?>
                </div>
            </div>
            <div class="col-8 pt-3 d-flex flex-column justify-content-center">
                <div class="row">
                    <div class="col-12">
                        <h3><?php echo $user['name'] ?></h3>
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