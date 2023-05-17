<?php
require_once('./config/db_conn.php')
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assests/css/dashboard.css">
    <title>My Dashboard</title>
    <?php include 'header.php' ?>
</head>

<body class="mx-auto" style="width: 1301px; padding-top: 150px; padding-left: 180px">
    <!--Main Navigation-->
    <header>
        <!-- Sidebar -->
        <div class="container">
            <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse sidebar-blue">
                <!-- Your new sidebar content goes here -->
                <div class="position-sticky">
                    <div class="list-group list-group-flush mx-3 mt-4 sidebar-blue">
                        <a href="?page=home" id="alllinks" class="list-group-item list-group-item-action py-2 ripple <?php if ($_GET['page'] == 'home') echo 'active'; ?>">
                            <i class="fas fa-home fa-fw me-3"></i><span>Home</span>
                        </a>
                        <a href="?page=users" id="alllinks" class="list-group-item list-group-item-action py-2 ripple <?php if ($_GET['page'] == 'users') echo 'active'; ?>">
                            <i class="fas fa-users fa-fw me-3"></i><span>Users</span>
                        </a>
                        <div id="alllinks" class="list-group-item list-group-item-action py-2 ripple">
                            <i class="fas fa-book fa-fw me-3"></i><span>Library</span>
                            <div class="list-group">
                                <a href="?page=books" id="alllinks" class="list-group-item list-group-item-action py-2 ripple <?php if ($_GET['page'] == 'books') echo 'active'; ?>"><span>Books</span></a>
                                <a href="#" id="alllinks" class="list-group-item list-group-item-action py-2 ripple"><span>Articles</span></a>
                                <a href="#" id="alllinks" class="list-group-item list-group-item-action py-2 ripple"><span>Journals</span></a>
                                <a href="#" id="alllinks" class="list-group-item list-group-item-action py-2 ripple"><span>Magazines</span></a>
                                <a href="#" id="alllinks" class="list-group-item list-group-item-action py-2 ripple"><span>Newspaper</span></a>
                            </div>
                        </div>
                        <a href="#" id="alllinks" class="list-group-item list-group-item-action py-2 ripple">
                            <i class="fas fa-book-reader fa-fw me-3"></i><span>My Books</span>
                        </a>
                        <a href="#" id="alllinks" class="list-group-item list-group-item-action py-2 ripple">
                            <i class="fas fa-gavel fa-fw me-3"></i><span>My Penalties</span>
                        </a>
                        <a href="#" id="alllinks" class="list-group-item list-group-item-action py-2 ripple">
                            <i class="fas fa-user-circle fa-fw me-3"></i><span>My Account</span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar -->

        <!-- Navbar -->
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light fixed-top navbar-black">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Brand -->
                <a class="navbar-brand" href="#">
                    <img src="./assests/img/MAIN LOGO.jpg" height="25" alt="" loading="lazy" />
                </a>

                <!-- Right links -->
                <ul class="navbar-nav ms-auto d-flex flex-row">
                    <!-- Avatar -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle" height="22" alt="" loading="lazy" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">My profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->

    <!-- Main layout-->
    <!-- <main style="margin-top: 58px">
        <div class="container pt-4"> -->
    <!-- User content -->
    <!-- 
                
        </div>
    </main> -->
    <!--Main layout -->
    <?php

    if (isset($_GET['page'])) {
        $page = $_GET['page'];

        switch ($page) {
            case 'home':
                include 'home.php'; // Include the home content file
                break;
            case 'users':
                include './user_content.php'; // Include the users content file
                break;
            case 'books':
                include './books.php'; // Include the users content file
                break;
                // ...
        }
    }

    ?>
    <?php include 'footer.php' ?>
    <script src="./assests/js/app.js"></script>
</body>

</html>