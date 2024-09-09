<?php
include 'db.php'; // Include your database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Redstore</title>
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
                    <li><a href="contact.php" class="text-gray-700 hover:text-blue-600">Contact</a></li>
                    <li><a href="account.php" class="text-gray-700 hover:text-blue-600">Account</a></li>
                </ul>
            </nav>
            <div class="flex items-center space-x-4">
                <a href="cart.php"><img src="images/cart.png" width="30px" height="30px" alt="Cart"></a>
                <button class="text-gray-700 hover:text-blue-600 md:hidden" onclick="menutoggle()"><i class="fas fa-bars"></i></button>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="container mx-auto p-4">
        <h2 class="text-3xl font-bold text-center mb-8">Contact Us</h2>
        
        <div class="bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto">
            <form action="contact_process.php" method="POST" class="space-y-6">
                <div>
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Your Name</label>
                    <input type="text" id="name" name="name" class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Your Email</label>
                    <input type="email" id="email" name="email" class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="subject" class="block text-gray-700 font-semibold mb-2">Subject</label>
                    <input type="text" id="subject" name="subject" class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="message" class="block text-gray-700 font-semibold mb-2">Message</label>
                    <textarea id="message" name="message" rows="5" class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded hover:bg-blue-600 focus:outline-none">Send Message</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <div class="bg-gray-800 text-gray-200 py-8 mt-12">
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
