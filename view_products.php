<?php
include 'db.php'; // Include database connection
session_start();

// Ensure only admins can access this page
// if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
//     header('Location: index.php');
//     exit();
// }

// Fetch products from the database
$result = $conn->query("SELECT * FROM products");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Products - Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 1200px;
        }
        .product-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .product-card:hover {
            transform: translateY(-5px);
        }
        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid #ddd;
        }
        .product-info {
            padding: 15px;
        }
        .product-title {
            font-size: 1.2em;
            margin-bottom: 10px;
        }
        .product-price {
            font-size: 1.1em;
            color: #28a745;
            margin-bottom: 10px;
        }
        .product-description {
            font-size: 0.9em;
            color: #555;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="admin_dashboard.php">Admin Panel</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Manage_products.php">Manage Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="view_products.php">View Products</a>
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

    <!-- Main Content -->
    <div class="container mt-4">
        

        <div class="row">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($product = $result->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="product-card">
                            <img src="<?= htmlspecialchars($product['target_file']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" class="product-image">
                            <div class="product-info">
                                <h5 class="product-title"><?= htmlspecialchars($product['name']); ?></h5>
                                <p class="product-price">$<?= htmlspecialchars($product['price']); ?></p>
                                <p class="product-description"><?= htmlspecialchars(substr($product['description'], 0, 100)) . '...'; ?></p>
                                <p class="product-size"><strong>Size:</strong> <?= htmlspecialchars($product['size']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center">No products found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
