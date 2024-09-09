<?php
include 'db.php'; // Include your database connection

// Fetch product ID from the URL
if (isset($_GET['id'])) {
    $productId = intval($_GET['id']);

    // Fetch product details from the database
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        echo "Product not found!";
        exit;
    }
} else {
    echo "No product selected!";
    exit;
}

// Split sizes into an array
$sizes = explode(',', $product['size']);

// Split sub-images into an array if available
$subImages = $product['sub_images'] ? explode(',', $product['sub_images']) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - Redstore</title>
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

    <!-- Single Product Details -->
    <div class="container mx-auto p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Product Images -->
            <div>
                <!-- Display the main product image -->
                <img src="../<?php echo htmlspecialchars($product['target_file']); ?>" class="w-full h-96 object-cover rounded-lg mb-4" id="productImg">
                
                <!-- Small images gallery -->
                <div class="flex space-x-2">
                    <?php foreach ($subImages as $subImage): ?>
                        <img src="../<?php echo htmlspecialchars($subImage); ?>" class="w-20 h-20 object-cover rounded cursor-pointer small-img" onclick="productImg.src=this.src">
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Product Details -->
            <div>
                <p class="text-sm text-gray-500 mb-2">Home / Shoes</p>
                <h1 class="text-3xl font-bold mb-4"><?php echo htmlspecialchars($product['name']); ?></h1>
                <h4 class="text-2xl font-bold text-gray-800 mb-4">$<?php echo htmlspecialchars($product['price']); ?></h4>

                <!-- Display available sizes dynamically -->
                <select id="sizeSelect" class="border border-gray-300 rounded p-2 w-full mb-4">
                    <option>Select Size</option>
                    <?php foreach ($sizes as $size): ?>
                        <option value="<?php echo htmlspecialchars($size); ?>"><?php echo htmlspecialchars($size); ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Form to add product to cart -->
                <form id="addToCartForm" class="mb-6">
                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                    <input type="number" name="quantity" value="1" min="1" max="3" id="quantity" class="border border-gray-300 rounded p-2 w-20 mb-4" oninput="validateQuantity(this)">
                    <button type="button" onclick="addToCart()" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Add to Cart</button>
                </form>


                <h3 class="text-lg font-semibold mb-2">Product Details <i class="fa fa-indent"></i></h3>
                <p class="text-gray-600"><?php echo htmlspecialchars($product['description']); ?></p>
            </div>
        </div>
    </div>

    <!-- Related Products Section -->
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Related Products</h2>
            <a href="All_products.php" class="text-blue-500 hover:underline">View More</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php
            // Fetch 4 related products from the database
            $relatedProductsQuery = "SELECT * FROM products WHERE id != ? LIMIT 4"; // Exclude the current product
            $stmtRelated = $conn->prepare($relatedProductsQuery);
            $stmtRelated->bind_param("i", $productId); // Exclude the current product
            $stmtRelated->execute();
            $relatedProductsResult = $stmtRelated->get_result();

            // Check if there are related products
            if ($relatedProductsResult->num_rows > 0) {
                while ($relatedProduct = $relatedProductsResult->fetch_assoc()) {
                    $relatedImagePath = '../' . htmlspecialchars($relatedProduct['target_file']); // Adjusted path

                    echo '
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <a href="Product_view.php?id=' . $relatedProduct['id'] . '">
                            <img src="' . $relatedImagePath . '" alt="' . htmlspecialchars($relatedProduct['name']) . '" class="w-full h-48 object-cover rounded">
                        </a>
                        <a href="Product_view.php?id=' . $relatedProduct['id'] . '">
                            <h4 class="text-lg font-semibold mt-2">' . htmlspecialchars($relatedProduct['name']) . '</h4>
                        </a>
                        <div class="flex space-x-1 text-yellow-500 mt-2">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-alt"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <p class="text-lg font-bold text-gray-700 mt-2">$' . htmlspecialchars($relatedProduct['price']) . '</p>
                    </div>';
                }
            } else {
                echo '<p class="text-center text-gray-600">No related products found.</p>';
            }
            ?>
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

    <!-- JS for Product Gallery -->
    <script>
        var productImg = document.getElementById("productImg");
        var smallImg = document.getElementsByClassName("small-img");
        
        Array.from(smallImg).forEach(img => {
            img.onclick = function(){
                productImg.src = this.src;
            }
        });
    </script>

    <!-- AJAX Add to Cart -->
    <script>
    function addToCart() {
        var productId = <?php echo $productId; ?>; // Get the product ID
        var quantity = document.getElementById('quantity').value; // Get the quantity
        var size = document.getElementById('sizeSelect').value; // Get the selected size

        // Create an AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'cart.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        // Handle the response from the server
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert('Product added to cart!'); // Show success message
            } else {
                alert('Failed to add product to cart.'); // Show error message
            }
        };

        // Send the request with product ID, quantity, and size
        xhr.send('add_to_cart=true&product_id=' + productId + '&quantity=' + quantity + '&size=' + size);
    }
    </script>
    <!-- Add this JavaScript validation function -->
    <script>
        function validateQuantity(input) {
            if (input.value < 1) input.value = 1; // Ensure minimum is 1
            if (input.value > 3) input.value = 3; // Ensure maximum is 3
        }
        
        function addToCart() {
            var productId = <?php echo $productId; ?>; // Get the product ID
            var quantity = document.getElementById('quantity').value; // Get the quantity
            var size = document.getElementById('sizeSelect').value; // Get the selected size

            // Create an AJAX request
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'cart.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            // Handle the response from the server
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert('Product added to cart!'); // Show success message
                } else {
                    alert('Failed to add product to cart.'); // Show error message
                }
            };

            // Send the request with product ID, quantity, and size
            xhr.send('add_to_cart=true&product_id=' + productId + '&quantity=' + quantity + '&size=' + size);
        }
    </script>

</body>
</html>
