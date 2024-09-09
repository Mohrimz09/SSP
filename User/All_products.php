<?php
include 'db.php'; // Include your database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products - Redstore</title>
    <!-- Include Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center">
            <div class="logo">
                <a href="index.html"><img src="images/11.PNG" width="125px" alt="Logo"></a>
            </div>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="Landing.php" class="text-gray-700 hover:text-blue-600">Home</a></li>
                    <li><a href="All_products.php" class="text-gray-700 hover:text-blue-600">Products</a></li>
                    <li><a href="#" class="text-gray-700 hover:text-blue-600">About</a></li>
                    <li><a href="#" class="text-gray-700 hover:text-blue-600">Contact</a></li>
                    <li><a href="account.php" class="text-gray-700 hover:text-blue-600">Account</a></li>
                </ul>
            </nav>
            <div class="flex items-center space-x-4">
                <a href="cart.php"><img src="images/cart.png" width="30px" height="30px" alt="Cart"></a>
                <button class="text-gray-700 hover:text-blue-600 md:hidden" onclick="menutoggle()"><i class="fas fa-bars"></i></button>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">All Products</h2>
            <select class="border border-gray-300 rounded-md p-2">
                <option>Default sorting</option>
                <option>Sort by price</option>
                <option>Sort by popularity</option>
                <option>Sort by rating</option>
                <option>Sort by sale</option>
            </select>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php
            // Fetch products from the database
            $result = $conn->query("SELECT * FROM products"); // Assuming 'products' is your table name

            // Check if there are any products
            if ($result->num_rows > 0) {
                // Loop through each product and display it
                while ($product = $result->fetch_assoc()) {
                    // Use the path from the database as it already includes the 'uploads/' folder
                    $imagePath = '../' . htmlspecialchars($product['target_file']); 

                    echo '
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <a href="Product_view.php?id=' . $product['id'] . '">
                            <img src="' . $imagePath . '" alt="' . htmlspecialchars($product['name']) . '" class="w-full h-48 object-cover rounded">
                        </a>
                        <a href="Product_view.php?id=' . $product['id'] . '">
                            <h4 class="text-lg font-semibold mt-2">' . htmlspecialchars($product['name']) . '</h4>
                        </a>
                        <div class="flex space-x-1 text-yellow-500 mt-2">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-alt"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <p class="text-lg font-bold text-gray-700 mt-2">$' . htmlspecialchars($product['price']) . '</p>
                    </div>';
                }
            } else {
                echo '<p class="text-center text-gray-600">No products found.</p>';
            }
            ?>
        </div>
        
        <!-- Pagination -->
        <div class="flex justify-center mt-8 space-x-4">
            <span class="cursor-pointer px-4 py-2 bg-blue-500 text-white rounded">1</span>
            <span class="cursor-pointer px-4 py-2 bg-gray-300 text-gray-700 rounded">2</span>
            <span class="cursor-pointer px-4 py-2 bg-gray-300 text-gray-700 rounded">3</span>
            <span class="cursor-pointer px-4 py-2 bg-gray-300 text-gray-700 rounded">4</span>
            <span class="cursor-pointer px-4 py-2 bg-gray-300 text-gray-700 rounded">&#8594;</span>
        </div>
    </div>

    <!-- Footer -->
    <div class="bg-gray-800 text-gray-200 py-8">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-semibold mb-4">Download Our App</h3>
                <p>Download App for Android and iOS mobile phone.</p>
                <div class="flex space-x-2 mt-4">
                    <img src="images/play-store.png" alt="" class="w-24">
                    <img src="images/app-store.png" alt="" class="w-24">
                </div>
            </div>
            <div>
                <img src="images/logo-white.png" alt="Logo" class="w-32">
                <p class="mt-4">Our Purpose Is To Sustainably Make the Pleasure and Benefits of Sports Accessible to the Many.</p>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-4">Useful Links</h3>
                <ul class="space-y-2">
                    <li>Coupons</li>
                    <li>Blog Post</li>
                    <li>Return Policy</li>
                    <li>Join Affiliate</li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-4">Follow us</h3>
                <ul class="space-y-2">
                    <li>Facebook</li>
                    <li>Twitter</li>
                    <li>Instagram</li>
                    <li>Youtube</li>
                </ul>
            </div>
        </div>
        <hr class="border-gray-700 my-6">
        <p class="text-center text-gray-500">&copy; 2024 Mohomed Rimzan</p>
    </div>

    <!-- JS for Toggle Menu -->
    <script>
        function menutoggle() {
            const menuItems = document.getElementById("MenuItems");
            menuItems.classList.toggle("hidden");
        }
    </script>
</body>
</html>
