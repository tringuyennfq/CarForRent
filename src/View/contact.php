<?php

?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 header">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact">Contact</a>
                </li>
                <li>
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo '<button type="button" class="btn btn-primary home-btn" id="btn-logout" onclick="location.href=\'logout\'">Logout</button>';
                    } else {
                        echo '<button type="button" class="btn btn-primary home-btn" id="btn-login" onclick="location.href=\'login\'">Login</button>';
                    }
                    ?>
                </li>

            </ul>
        </div>
    </div>
</nav>
<h1>Contact me</h1>
