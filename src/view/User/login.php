<?php

?>
<div class="login-wrapper">
    <form class="form-signin" action="" method="post">
        <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72"
             height="72">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="username" class="sr-only">Username</label>
        <input type="text" id="username" class="form-control" name="username" placeholder="Username" required
               autofocus value="<?php $usr = $username ?? '';
                echo $usr; ?>">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <?php if (isset($error)) {
            echo '<div class="alert alert-danger" role="alert">';
            echo $error;
            echo '</div>';
        } ?>


        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy;Tri Nguyen 2022</p>
    </form>
</div>
