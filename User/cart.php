<?php
include 'db.php'; // Include your database connection
session_start(); // Start the session to keep track of the user

// Initialize cart session if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle Add to Cart functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Fetch product details from the database
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        // Add product to cart session
        $_SESSION['cart'][$product_id] = [
            'name' => htmlspecialchars($product['name']),
            'price' => $product['price'],
            'quantity' => $quantity,
            'image' => htmlspecialchars($product['target_file'])
        ];
    }

    // Respond to AJAX request
    echo 'Product added to cart';
    exit; // Exit to avoid further output
}

// Handle Remove from Cart functionality
if (isset($_GET['remove'])) {
    $product_id = intval($_GET['remove']);
    unset($_SESSION['cart'][$product_id]); // Remove product from the session

    header("Location: cart.php"); // Redirect back to cart page
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Redstore</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <script>
        // JavaScript function to update subtotal and total dynamically
        function updateCart() {
            let total = 0;
            const rows = document.querySelectorAll('table tr.product-row');

            rows.forEach(row => {
                const price = parseFloat(row.querySelector('.price').textContent.replace('$', ''));
                const quantity = parseInt(row.querySelector('.quantity-input').value);
                const subtotal = price * quantity;
                row.querySelector('.subtotal').textContent = '$' + subtotal.toFixed(2);
                total += subtotal;
            });

            const tax = total * 0.10; // 10% tax
            const totalWithTax = total + tax;

            document.querySelector('.subtotal-value').textContent = '$' + total.toFixed(2);
            document.querySelector('.tax-value').textContent = '$' + tax.toFixed(2);
            document.querySelector('.total-value').textContent = '$' + totalWithTax.toFixed(2);
        }
    </script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <div class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <a href="index.html"><img src="images/112.PNG" width="125px" alt="Logo"></a>
            </div>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="Landing.php" class="text-gray-700 hover:text-gray-900">Home</a></li>
                    <li><a href="All_products.php" class="text-gray-700 hover:text-gray-900">Products</a></li>
                    <li><a href="#" class="text-gray-700 hover:text-gray-900">About</a></li>
                    <li><a href="#" class="text-gray-700 hover:text-gray-900">Contact</a></li>
                    <li><a href="account.html" class="text-gray-700 hover:text-gray-900">Account</a></li>
                </ul>
            </nav>
            <a href="cart.php"><img src="images/cart.png" width="30px" height="30px" alt="Cart"></a>
        </div>
    </div>

    <!-- Cart Table -->
    <div class="container mx-auto my-8">
        <div class="bg-white p-6 rounded shadow">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Product</th>
                        <th class="py-3 px-6 text-center">Quantity</th>
                        <th class="py-3 px-6 text-center">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php
                    $total = 0; // Initialize total price

                    foreach ($_SESSION['cart'] as $product_id => $cart_item) {
                        $subtotal = $cart_item['price'] * $cart_item['quantity'];
                        $total += $subtotal; // Add to total

                        echo '
                        <tr class="border-b border-gray-200 hover:bg-gray-100 product-row">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="mr-2">
                                        <img src="../' . htmlspecialchars($cart_item['image']) . '" class="w-20 h-20 object-cover" alt="Product Image">
                                    </div>
                                    <div>
                                        <p class="font-medium">' . htmlspecialchars($cart_item['name']) . '</p>
                                        <small class="text-gray-500">Price: $<span class="price">' . htmlspecialchars($cart_item['price']) . '</span></small><br>
                                        <a href="cart.php?remove=' . $product_id . '" class="text-red-500 hover:underline">Remove</a>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <input type="number" class="quantity-input w-16 text-center border rounded py-1" value="' . htmlspecialchars($cart_item['quantity']) . '" min="1" oninput="updateCart()">
                            </td>
                            <td class="py-3 px-6 text-center subtotal">$' . number_format($subtotal, 2) . '</td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>

            <div class="mt-8">
                <div class="flex justify-between items-center bg-gray-100 p-4 rounded">
                    <div class="text-lg font-semibold">Subtotal: <span class="subtotal-value">$<?php echo number_format($total, 2); ?></span></div>
                    <div class="text-lg font-semibold">Tax (10%): <span class="tax-value">$<?php echo number_format($total * 0.10, 2); ?></span></div>
                    <div class="text-xl font-bold">Total: <span class="total-value">$<?php echo number_format($total * 1.10, 2); ?></span></div>
                </div>
                <div class="flex justify-end mt-4">
                    <a href="checkout.php" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Include FontAwesome and Tailwind JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>
</body>
</html>
