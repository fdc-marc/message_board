<div class="container pt-3">


    <?php
    // if ($this->Session->flash('flash')) :
    echo $this->Session->flash('flash');
    ?>

    <div class="profile-section pt-3">
        <div class="row">
            <div class="col-3">
                <h2>Edit Profile Info</h2>
            </div>

            <div class="col-9 d-flex align-items-center justify-content-end">
                <?php echo $this->Html->link('Profile', array('controller' => 'Users', 'action' => 'profile'), ['class' => 'btn btn-dark']); ?>
                <?php echo $this->Html->link('Change Email', array('controller' => 'Users', 'action' => 'edit_email'), ['class' => 'btn btn-secondary']); ?>
                <?php echo $this->Html->link('Change Password', array('controller' => 'Users', 'action' => 'edit_password'), ['class' => 'btn btn-info']); ?>
            </div>

        </div>

        <form action="/message_board/users/edit_profile" method="post" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $user['id'] ?>" name="id">
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
                <div class=" col-8 pt-3 d-flex flex-column justify-content-center">
                    <input id="profile-photo" name="profile-photo" type="file" accept=".jpg, .gif, .png">
                </div>
            </div>

            <div class="row pt-2">
                <div class="col-12">
                    <h6>Name:</h6>
                    <input type="text" name="name" class="form-control" value="<?php echo $user['name'] ?>">
                </div>
            </div>
            <div class="row pt-2">
                <div class="col-12">
                    <h6>Birthdate: </h6>
                    <input type="" id="birthdate" name="birthdate" class="form-control" value="<?php echo $user['birthdate'] === "01/01/1970" ? "mm/dd/yyyy" : $user['birthdate'] ?>">

                </div>
            </div>
            <div class="row pt-2">
                <div class="col-12">
                    <h6>Gender: </h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="maleRadio" value="Male" <?php echo $user['gender'] === 'Male' ? "checked" : "" ?>>
                        <label class="form-check-label">
                            Male
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="femaleRadio" value="Female" <?php echo $user['gender'] === 'Female' ? "checked" : "" ?>>
                        <label class="form-check-label">
                            Female
                        </label>
                    </div>
                </div>
            </div>


            <div class="row pt-2 pb-5">
                <div class="col-12">
                    <h6>Hobby:</h6>
                    <textarea class="form-control" name="hobby" id="hobby" rows="5"><?php echo $user['hobby'] ?></textarea>
                </div>
            </div>



            <button type="submit" class="btn btn-success px-3">Update</button>
        </form>
    </div>
</div>
</div>