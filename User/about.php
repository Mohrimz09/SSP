<?php
include 'db.php'; // Include your database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Redstore</title>
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
                    <li><a href="about.php" class="text-gray-700 hover:text-blue-600">About</a></li>
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

    <!-- About Us Section -->
    <div class="container mx-auto p-4">
        <h2 class="text-3xl font-bold text-center mb-8">About Us</h2>
        
        <!-- Our Mission -->
        <div class="bg-white p-8 rounded-lg shadow-md mb-8">
            <h3 class="text-2xl font-semibold mb-4">Our Mission</h3>
            <p class="text-gray-700 leading-relaxed">
                At Redstore, our mission is to make the pleasure and benefits of sports accessible to everyone. We believe that fitness is not just a routine but a lifestyle. We strive to provide high-quality products that cater to all fitness enthusiasts, from beginners to professionals. Our commitment is to offer premium sports gear, innovative equipment, and exceptional customer service that empowers everyone to achieve their fitness goals.
            </p>
        </div>

        <!-- Our Story -->
        <div class="bg-white p-8 rounded-lg shadow-md mb-8">
            <h3 class="text-2xl font-semibold mb-4">Our Story</h3>
            <p class="text-gray-700 leading-relaxed">
                Founded in 2021, Redstore was born out of a passion for sports and a commitment to bringing the best sports gear to everyone. Our founders, John Doe and Jane Smith, envisioned a one-stop shop for all fitness needs. Over the years, we have partnered with top brands like Adidas, Nike, and Puma to provide a curated selection of sportswear, equipment, and accessories. Our journey started with a small store and has now grown into a leading e-commerce platform with thousands of happy customers worldwide.
            </p>
        </div>

        <!-- Our Values -->
        <div class="bg-white p-8 rounded-lg shadow-md mb-8">
            <h3 class="text-2xl font-semibold mb-4">Our Values</h3>
            <ul class="list-disc list-inside text-gray-700 leading-relaxed">
                <li><strong>Customer First:</strong> We prioritize our customers and aim to provide the best shopping experience.</li>
                <li><strong>Innovation:</strong> We continuously innovate to bring you the latest and most effective sports gear.</li>
                <li><strong>Sustainability:</strong> We are committed to sustainable practices, from sourcing materials to packaging.</li>
                <li><strong>Integrity:</strong> We believe in transparency, fairness, and ethical business practices.</li>
            </ul>
        </div>

        <!-- Meet the Team -->
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h3 class="text-2xl font-semibold mb-4">Meet the Team</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <img src="images/joe.PNG" alt="Team Member" class="w-32 h-32 rounded-full mx-auto">
                    <h4 class="text-xl font-bold mt-4">John Doe</h4>
                    <p class="text-gray-500">Founder & CEO</p>
                    <p class="mt-2 text-gray-600">John has over 15 years of experience in the sports industry and is passionate about fitness and innovation.</p>
                </div>
                <div class="text-center">
                    <img src="images/joe2.PNG" alt="Team Member" class="w-32 h-32 rounded-full mx-auto">
                    <h4 class="text-xl font-bold mt-4">Jane Smith</h4>
                    <p class="text-gray-500">Head of Marketing</p>
                    <p class="mt-2 text-gray-600">Jane brings creativity and energy to the team, driving our marketing strategies to new heights.</p>
                </div>
                <div class="text-center">
                    <img src="images/joe3.PNG" alt="Team Member" class="w-32 h-32 rounded-full mx-auto">
                    <h4 class="text-xl font-bold mt-4">Alice Johnson</h4>
                    <p class="text-gray-500">Chief Technology Officer</p>
                    <p class="mt-2 text-gray-600">Alice is a tech enthusiast who ensures our platform runs smoothly and stays ahead in the digital world.</p>
                </div>
            </div>
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
