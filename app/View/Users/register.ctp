<div class="container pt-3">


    <h2>Register</h2>

    <form class="register-form" method="POST">
        <div class="validation-errors">
            <div class="row">
                <small id="name_valid" class="form-text text-danger invalid-feedback">
                    Your name must have 5 - 20 characters.
                </small>
            </div>
            <div class="row">
                <small id="email_valid" class="form-text text-danger invalid-feedback">
                    Your email must be a valid email.
                </small>
            </div>
            <div class="row">
                <small id="password_valid" class="form-text text-danger invalid-feedback">
                    Your password must have more than 3 characters.
                </small>
            </div>
            <div class="row">

                <small id="confirmpass_valid" class="form-text text-danger invalid-feedback">
                    Your passwords did not match.
                </small>
            </div>



        </div>

        <div class="row py-2">
            <div class="col-6">
                <label for="">Name</label>
                <input class="form-control" type="text" id="name" name="name" required>

            </div>

        </div>
        <div class="row py-2">
            <div class="col-6">
                <label for="">Email</label>
                <input class="form-control" type="email" id="email" name="email" required>

            </div>

        </div>

        <div class="row py-2">
            <div class="col-6">
                <label for="">Password</label>
                <input class="form-control" type="password" id="password" name="password" required>

            </div>
        </div>

        <div class="row py-2">
            <div class="col-6">
                <label for="">Confirm Password</label>
                <input class="form-control" type="password" id="confirmPassword" name="confirmPassword" required>

            </div>
        </div>

        <div class="row pt-3">
            <div class="col-6 d-flex justify-content-end">
                <button type="submit" class="btn btn-success px-4" id="registerBtn">
                    Login
                </button>
            </div>

        </div>

    </form>


</div>