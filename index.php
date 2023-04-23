<?php
require_once('config/db_conn.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Portal</title>
    <?php include 'header.php' ?>
</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container navbar-container">
            <a href="index.php" class="navbar-brand">Library Portal</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu"><span class="navbar-toggler-icon"></span></button>


            <div class="collapse navbar-collapse" id="navmenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="#Home" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="register.php" class="nav-link">Sign Up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End of Navbar -->
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-md-8 text-center">
                    <h1 class="text-white">Welcome to our Library Portal</h1>
                    <p class="text-white">Explore our vast collection of books and discover your next read!</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="login.php" class="btn btn-primary me-md-2">Login</a>
                        <a href="register.php" class="btn btn-secondary">Signup</a>
                </div>
            </div>
        </div>
    </section>
    <!-- End of Hero Section -->
</body>
<?php include 'footer.php' ?>

</html>