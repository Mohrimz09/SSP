<?php
include 'db.php'; // Include your database connection
session_start();

// Ensure only admins can access this page
// if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
//     header('Location: index.php');
//     exit();
// }

// Check if the product ID is provided
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Prepare the delete statement
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $productId);

    // Execute the delete query
    if ($stmt->execute()) {
        // Redirect back to the manage products page after deletion
        header('Location: Manage_products.php');
    } else {
        echo "Error deleting product: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No product ID provided.";
}

$conn->close(); // Close the database connection
?>
