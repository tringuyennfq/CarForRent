
<div class="main-wrapper">
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
                    if(isset($_SESSION['username']) && $_SESSION['username'] == 'khaitri'){
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


    <div class="site-section" style="background:transparent; color: #DFF6FF;">
        <div class="container">
            <div class="row align-items-center" style="justify-content: center;">
                <div class="col-lg-7 text-center order-lg-2">
                    <div class="img-wrap-1 mb-5" style="margin-inline: auto;">
                        <img src="https://i.imgur.com/F6Yn1Z1.png" alt="Image" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-4 ml-auto order-lg-1">
                    <h3 class="mb-4 section-heading"><strong>You can easily avail our promo for renting a car.</strong></h3>
                    <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae, explicabo iste a labore id est quas, doloremque veritatis! Provident odit pariatur dolorem quisquam, voluptatibus voluptates optio accusamus, vel quasi quidem!</p>

                    <p><a href="#" class="btn btn-primary">Meet them now</a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="album py-5 bg-light content-wrapper">
        <div class="container">

            <div class="row">

                <?php foreach ($carList as $car)
                {
                    ?>
                    <div class="col-md-4 mt-5 card-wrapper">
                        <div class="card mb-4 box-shadow card">
                            <img class="card-img-top"
                                 src="<?php echo $car->getImagePath();?>"
                                 alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text"><?php echo $car->getBrand()." - ".$car->getName();?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong class="text" style="font-size: 23px;"><?php echo $car->getPrice()." $";?></strong>
                                    <button type="button" class="btn btn-secondary">Rent Now</button>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            </div>

        </div>
    </div>
</div>