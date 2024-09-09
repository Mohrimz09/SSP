<?php
include 'db.php'; // Adjust the path to include your database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redstore | Ecommerce website</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div>
                <a href="cart.php"><img src="images/112.PNG" alt="Logo" class="w-32"></a>
            </div>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="Landing.php" class="text-gray-700 hover:text-blue-600">Home</a></li>
                    <li><a href="All_products.php" class="text-gray-700 hover:text-blue-600">Products</a></li>
                    <li><a href="#" class="text-gray-700 hover:text-blue-600">About</a></li>
                    <li><a href="#" class="text-gray-700 hover:text-blue-600">Contact</a></li>
                    <li><a href="account.html" class="text-gray-700 hover:text-blue-600">Account</a></li>
                </ul>
            </nav>
            <div class="flex items-center space-x-4">
                <a href="cart.php"><img src="images/cart.png" width="30px" height="30px" alt="Cart"></a>
                <button class="text-gray-700 hover:text-blue-600 md:hidden" onclick="menutoggle()"><i class="fas fa-bars"></i></button>
            </div>
        </div>
    </header>

    <!-- Main Hero Section -->
    <div class="bg-blue-100 py-16">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-8 md:mb-0">
                <h1 class="text-4xl md:text-6xl font-bold text-gray-800 mb-6">Give your Workout <br>A New Style!</h1>
                <p class="text-gray-600 mb-8">Success isn't always about greatness. It's about consistency. Consistent hard work gains success. Greatness will come.</p>
                <a href="products.html" class="bg-blue-600 text-white py-3 px-6 rounded hover:bg-blue-700">Explore Now &#8594;</a>
            </div>
            <div class="md:w-1/2">
                <img src="images/image1.png" alt="Workout" class="w-full h-auto">
            </div>
        </div>
    </div>

    <!-- Featured Categories -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white shadow-md rounded-lg p-4">
                    <img src="images/100.PNG" alt="Category 1" class="w-full h-48 object-cover rounded-lg">
                </div>
                <div class="bg-white shadow-md rounded-lg p-4">
                    <img src="images/200.PNG" alt="Category 2" class="w-full h-48 object-cover rounded-lg">
                </div>
                <div class="bg-white shadow-md rounded-lg p-4">
                    <img src="images/300.PNG" alt="Category 3" class="w-full h-48 object-cover rounded-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products (Dynamic) -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold text-center mb-12">Featured Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                <?php
                // Fetch products from the database
                $result = $conn->query("SELECT * FROM products");

                if ($result->num_rows > 0) {
                    while ($product = $result->fetch_assoc()) {
                        $imagePath = '../' . htmlspecialchars($product['target_file']); // Adjusted path

                        echo '
                        <div class="bg-white shadow-md rounded-lg p-4">
                            <a href="Product_view.php?id=' . $product['id'] . '">
                                <img src="' . $imagePath . '" alt="' . htmlspecialchars($product['name']) . '" class="w-full h-48 object-cover rounded-lg mb-4">
                            </a>
                            <a href="Product_view.php?id=' . $product['id'] . '" class="block text-lg font-semibold text-gray-800 hover:text-blue-600 mb-2">' . htmlspecialchars($product['name']) . '</a>
                            <div class="flex space-x-1 text-yellow-500">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <p class="text-lg font-bold text-gray-700 mt-2">$' . htmlspecialchars($product['price']) . '</p>
                        </div>';
                    }
                } else {
                    echo '<p class="text-center text-gray-600">No products found.</p>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Offer Section -->
    <section class="py-16">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-8 md:mb-0">
                <img src="images/jordan.jpg" class="w-full h-auto rounded-lg shadow-lg">
            </div>
            <div class="md:w-1/2 md:pl-12">
                <p class="text-gray-600 mb-4">Exclusively Available on Shoe Reps</p>
                <h1 class="text-3xl font-bold text-gray-800 mb-4">Sports Shoes</h1>
                <p class="text-gray-600 mb-8">Buy the latest collections of sports shoes online on Redstore at best prices from top brands such as Adidas, Nike, Puma, Asics, and Sparx at your leisure at the best prices.</p>
                <a href="All_products.php" class="bg-blue-600 text-white py-3 px-6 rounded hover:bg-blue-700">Buy Now &#8594;</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-200 py-16">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-semibold mb-4">Download Our App</h3>
                <p class="text-gray-400">Download App for Android and iOS mobile phone.</p>
                <div class="flex space-x-4 mt-4">
                    <img src="images/play-store.png" alt="Play Store" class="w-24">
                    <img src="images/app-store.png" alt="App Store" class="w-24">
                </div>
            </div>
            <div>
                <img src="" alt="Logo" class="w-32">
                <p class="text-gray-400 mt-4">Our Purpose Is To Sustainably Make the Pleasure and Benefits of Sports Accessible to the Many.</p>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-4">Useful Links</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white">Coupons</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Blog Post</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Return Policy</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Join Affiliate</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-4">Follow us</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white">Facebook</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Twitter</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Instagram</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Youtube</a></li>
                </ul>
            </div>
        </div>
        <hr class="border-gray-700 my-6">
        <p class="text-center text-gray-500">&copy; 2024 Mohomed Rimzan</p>
    </footer>

    <!-- JS for Toggle Menu -->
    <script>
        function menutoggle() {
            const menuItems = document.getElementById("MenuItems");
            menuItems.classList.toggle("hidden");
        }
    </script>
</body>

</html>
