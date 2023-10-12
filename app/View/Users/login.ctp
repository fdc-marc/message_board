<div class="container pt-3">


    <?php if ($this->Session->flash()) : ?>
        <div class="success-message">
            <?php echo $this->Session->flash(); ?>
        </div>
    <?php endif; ?>

    <h2>Login</h2>

    <div class="login-form">
        <div class="row py-2">
            <div class="col-6">
                <label for="">Email</label>
                <input class="form-control" type="email" name="email" required>
            </div>
        </div>

        <div class="row py-2">
            <div class="col-6">
                <label for="">Password</label>
                <input class="form-control" type="password" name="password" required>
            </div>
        </div>

        <div class="row pt-3">
            <div class="col-6 d-flex justify-content-end">
                <button class="btn btn-success px-4" id="loginBtn">
                    Login
                </button>
            </div>

        </div>

    </div>


</div>