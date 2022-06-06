<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Car Rental</a>
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
                <?php

                if (isset($_SESSION['username']) && $_SESSION['username'] == 'khaitri') {
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="addcar">Add car</a>';
                    echo '</li>';
                }
                ?>

                <li id="btn-wrapper">
                    <?php
                    if (isset($_SESSION['user_ID'])) {
                        echo '<p id="hello">Hello ' . $_SESSION['username'] . '</p>';
                        echo '<form action="/logout" method="post">';
                        echo '<button type="submit" class="btn btn-primary home-btn" id="btn-logout"">Logout</button>';
                        echo '</form>';
                    } else {
                        echo '<button type="button" class="btn btn-primary home-btn" id="btn-login" onclick="location.href=\'login\'">Login</button>';
                        echo '<button type="button" class="btn btn-primary home-btn" id="btn-register" onclick="location.href=\'register\'">Register</button>';
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="contact-background">
    <div class="contact-wrapper">
        <form id="contact" action="" method="post">
            <h3>Quick Contact</h3>
            <h4>Contact us today, and get reply with in 24 hours!</h4>
            <fieldset>
                <input placeholder="Your name" type="text" tabindex="1" required autofocus>
            </fieldset>
            <fieldset>
                <input placeholder="Your Email Address" type="email" tabindex="2" required>
            </fieldset>
            <fieldset>
                <input placeholder="Your Phone Number" type="tel" tabindex="3" required>
            </fieldset>
            <fieldset>
                <textarea placeholder="Type your Message Here...." tabindex="5" required></textarea>
            </fieldset>
            <fieldset>
                <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
            </fieldset>
        </form>
    </div>
</div>
