<?php
    session_start();

    if(!isset($_SESSION['admin_id'])){
        header("location: login-admin.php");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles/style.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<div id="wrapper">
    <nav class="navbar header-top fixed-top navbar-expand-lg  navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">COFFEE<small>Blend</small></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav side-nav" >
                    <li class="nav-item">
                        <a class="nav-link" style="margin-left: 20px;" href="index.php">Dashboard
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <?php if($_SESSION['admin_role']=='admin'): ?>

                        <li class="nav-item">
                            <a class="nav-link" href="admins.php" style="margin-left: 20px;">Users</a>
                        </li>

                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="show-products.php" style="margin-left: 20px;">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="orders-admins/show-orders.html" style="margin-left: 20px;">Orders</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="bookings-admins/show-bookings.html" style="margin-left: 20px;">Bookings</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-md-auto d-md-flex">
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $_SESSION['admin_username']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </nav>