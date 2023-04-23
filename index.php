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
        <div class="container">
            <a href="index.php" class="navbar-brand">Library Portal</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu"><span class="navbar-toggler-icon"></span></button>


            <div class="collapse navbar-collapse" id="navmenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="#Home" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#Login" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="#SignUp" class="nav-link">Sign Up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End of Navbar -->
    <!-- Hero Section -->
    
    <!-- End of Hero Section -->
</body>
<?php include 'footer.php' ?>

</html>