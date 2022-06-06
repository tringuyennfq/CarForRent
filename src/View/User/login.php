<?php

?>
<div class="login-background">
    <div class="login-wrapper">
        <form class="form-signin" action="" method="post" style="min-width: 500px;">
            <img class="mb-4" src="https://i.pinimg.com/originals/74/ab/48/74ab48240e34df5e05a398e997a42b0e.png" alt="" width="72"
                 height="72">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <label for="username" class="sr-only">Username</label>
            <input type="text" id="username" class="form-control" name="username" placeholder="Username"
                   autofocus value="<?php $usr = $username ?? '';
                    echo $usr; ?>">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password">
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <div id="alert" style="height: 70px;">
                <?php if (isset($error) && $error != '') {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo $error;
                    echo '</div>';
                } ?>
            </div>



            <button class="btn btn-lg btn-secondary btn-block" type="submit">Sign in</button>
            <a class="d-block text-center mt-2 small" href="register">Don't have an account? Sign up</a>
            <p class="mt-3 mb-3 text-muted">&copy;Tri Nguyen 2022</p>
        </form>
    </div>
</div>

