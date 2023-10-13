<div class="container pt-3">


    <?php
    // if ($this->Session->flash('flash')) {
    echo $this->Session->flash('flash');
    // }
    ?>


    <h2>Login</h2>

    <form action="/message_board/users/login_request" method="POST" class="login-form">
        <div class="row py-2">
            <div class="col-6">
                <label for="">Email</label>
                <input class="form-control" type="email" id="login_email" name="login_email" required>
            </div>
        </div>

        <div class="row py-2">
            <div class="col-6">
                <label for="">Password</label>
                <input class="form-control" type="password" id="login_password" name="login_password" required>
            </div>
        </div>

        <div class="row pt-3">
            <div class="col-6 d-flex justify-content-end">
                <button type="submit" class="btn btn-success px-4" id="loginBtn">
                    Login
                </button>
            </div>

        </div>

    </form>


</div>