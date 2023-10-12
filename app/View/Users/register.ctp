<div class="container pt-3">

    <h2>Register</h2>

    <form class="register-form">
        <div class="row py-2">
            <div class="col-6">
                <label for="">Name</label>
                <input class="form-control" type="text" id="name" name="name" required>
                <small id="namevalid" class="form-text text-danger invalid-feedback">
                    Name cannot be empty.
                </small>
            </div>

        </div>
        <div class="row py-2">
            <div class="col-6">
                <label for="">Email</label>
                <input class="form-control" type="email" id="email" name="email" required>
                <small id="emailvalid" class="form-text text-danger invalid-feedback">
                    Your email must be a valid email.
                </small>
            </div>

        </div>

        <div class="row py-2">
            <div class="col-6">
                <label for="">Password</label>
                <input class="form-control" type="password" id="password" name="password" required>
                <small id="passwordvalid" class="form-text text-danger invalid-feedback">
                    Password length must be greater than 3.
                </small>
            </div>
        </div>

        <div class="row py-2">
            <div class="col-6">
                <label for="">Confirm Password</label>
                <input class="form-control" type="password" id="confirmPassword" name="confirmPassword" required>
                <small id="confirmpassvalid" class="form-text text-danger invalid-feedback">
                    Passwords did not match.
                </small>
            </div>
        </div>

        <div class="row pt-3">
            <div class="col-6 d-flex justify-content-end">
                <button class="btn btn-success px-4" id="registerBtn">
                    Login
                </button>
            </div>

        </div>

    </form>


</div>