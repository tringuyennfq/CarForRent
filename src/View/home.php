
<div class="main-wrapper">
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

    <div class="title-box">
        <h1 class="head-title"><?= "Tri Nguyen's"; ?> Homepage</h1>
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
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                    </div>
                                    <strong class="text"><?php echo $car->getPrice()." $";?></strong>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            </div>

        </div>
    </div>
</div>