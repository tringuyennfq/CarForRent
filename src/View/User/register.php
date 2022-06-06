
<div class="register-background">

    <div id="alert-wrapper">
        <?php

        if (isset($success) && $success == true) {
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
                        <h1 class="h3 mb-5 font-weight-normal">Register</h1>
                        <form action="" method="post">

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInputUsername" name="username" placeholder="myusername" value="<?=$username ?? ''?>" autofocus>
                                <label for="floatingInputUsername">Username</label>
                                <div style="line-height: 20px;height: 20px;">
                                    <span style="color:red;"><?=$error['username'] ?? ''?></span>
                                    <span style="color:red;"><?=$error['exception'] ?? ''?></span>
                                </div>

                            </div>


                            <div class="form-floating ">
                                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                                <p style="color:red;height: 20px;"><?=$error['password'] ?? ''?></p>
                            </div>

                            <div class="form-floating ">
                                <input type="password" class="form-control" id="floatingPasswordConfirm" name="confirmPassword" placeholder="Confirm Password">
                                <label for="floatingPasswordConfirm">Confirm Password</label>
                                <p style="color:red; height: 20px;"><?=$error['confirmPassword'] ?? ''?></p>
                            </div>

                            <div class="d-grid mb-2">
                                <button class="btn btn-lg btn-secondary btn-block text-uppercase" type="submit">Register</button>
                            </div>

                            <a class="d-block text-center mt-2 small" href="login">Have an account? Sign In</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
