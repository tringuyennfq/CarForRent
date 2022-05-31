
<div class="register-background">

    <div id="alert-wrapper">
        <?php if (isset($success) && $success == true) {
            echo '<div class="alert alert-success" role="alert" id="register-successful">';
            echo "Your account has been created!";
            echo '</div>';
        } ?>
    </div>
    <div class="register-wrapper">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                    <div class="card-img-left d-none d-md-flex">
                    </div>
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title text-center mb-5 fw-light fs-5">Register</h5>
                        <form action="" method="post">

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInputUsername" name="username" placeholder="myusername" autofocus>
                                <label for="floatingInputUsername">Username</label>
                                <p style="color:red; margin-top:10px;"><?=$error['username'] ?? ''?></p>
                                <p style="color:red; margin-top:10px;"><?=$error['exception'] ?? ''?></p>
                            </div>

                            <hr>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                                <p style="color:red; margin-top:10px;"><?=$error['password'] ?? ''?></p>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPasswordConfirm" name="confirmPassword" placeholder="Confirm Password">
                                <label for="floatingPasswordConfirm">Confirm Password</label>
                                <p style="color:red; margin-top:10px;"><?=$error['confirmPassword'] ?? ''?></p>
                            </div>

                            <div class="d-grid mb-2">
                                <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit">Register</button>
                            </div>

                            <a class="d-block text-center mt-2 small" href="login">Have an account? Sign In</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
