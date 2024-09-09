<?php
include 'db.php'; // Include database connection
session_start();

// Ensure only admins can access this page
// if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
//     header('Location: index.php');
//     exit();
// }
// ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Shoe Store</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Include Bootstrap -->
    <link rel="stylesheet" href="admin.css"> <!-- Include your custom CSS -->
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Manage_products.php">Manage Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_products.php">View Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_manage_users.php">Manage Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_view_orders.php">Manage Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="container mt-4">
        <div class="row">
            <!-- Dashboard Cards for Key Metrics -->
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total Products</div>
                    <div class="card-body">
                        <h5 class="card-title">50</h5> <!-- Example count -->
                        <p class="card-text">Manage all products here.</p>
                        <a href="admin_view_products.php" class="btn btn-light">View Products</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total Users</div>
                    <div class="card-body">
                        <h5 class="card-title">150</h5> <!-- Example count -->
                        <p class="card-text">Manage all registered users here.</p>
                        <a href="admin_manage_users.php" class="btn btn-light">View Users</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Pending Orders</div>
                    <div class="card-body">
                        <h5 class="card-title">20</h5> <!-- Example count -->
                        <p class="card-text">Check and manage pending orders here.</p>
                        <a href="admin_view_orders.php" class="btn btn-light">View Orders</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- More sections can be added here as needed -->
    </div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
