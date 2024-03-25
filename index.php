<?php
// Set session cookie parameters to expire when the browser is closed
session_set_cookie_params(300);

session_start();
// Clear the CSV file when the session starts


// Initialize cart if not already set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add item to cart when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    // Retrieve product details from the form submission
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image']; 

    // Add item to cart array
    $_SESSION['cart'][] = array(
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price,
        'image' => $product_image // Store image path
    );

    // Redirect back to index page
    header("Location: index.php");
}

// Remove item from cart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_item'])) {
    $remove_index = $_POST['remove_index'];
    unset($_SESSION['cart'][$remove_index]);
    // Reset array keys to ensure consistency
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    // Redirect back to index page
    header("Location: index.php");
}
// Logout functionality
if (isset($_GET['logout'])) {
    $file_path = 'products.csv';
    $myfile = fopen($file_path, 'w') or die('Cannot open file');
    fclose($myfile);
    // Destroy the session
    session_destroy();
    // Redirect back to the index page or any other desired location
    header("Location: index.php");
    exit();
}

// Calculate total price
$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_price += $item['price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Store</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #333;
            text-align: center;
        }
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0; 
        }
        li {
            display: inline-block; 
            margin-right: 10px; 
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
            text-align: center; /
        }
        img {
            width: 100px;
            height: auto;
            display: block; 
            margin: 0 auto 10px; 
        }
        form {
            margin-bottom: 20px;
            margin-left: 10px;
        }
        input[type="text"] {
            width: 15%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        a {
            display: inline-block;
            background-color: #008CBA;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            margin-left: 10px;
        }
        a:hover {
            background-color: #005f7a;
        }
        .checkout-form {
            margin: 20px auto;
            max-width: 400px; 
            margin-left: 10px;
        }
        .ll {
            margin-left: 10px;
        }
        /* Positioning the logout button */
        .logout-button {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        /* Positioning the view orders button */
        .view-orders-button {
            position: absolute;
            top: 20px;
            left: 20px;
        }
    </style>
</head>
<body>
    <h1>Welcome to Our Online Store</h1>
    <h2>Products</h2>

    <!-- Display products -->
    <!-- List each product with a form to add it to the cart, price, name and a picture -->
    <ul>
        <li>
            <img src="tshirt.jpg" alt="T-Shirt">
            <form action="" method="post">
                <input type="hidden" name="product_id" value="1">
                <input type="hidden" name="product_name" value="T-Shirt">
                <input type="hidden" name="product_price" value="20">
                <input type="hidden" name="product_image" value="tshirt.jpg"> 
                <p>T-Shirt - $20</p>
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </li>
        <li>
        <img src="jeans.jpg" alt="Jeans">
            <form action="" method="post">
                <input type="hidden" name="product_id" value="2">
                <input type="hidden" name="product_name" value="Jeans">
                <input type="hidden" name="product_price" value="30">
                <input type="hidden" name="product_image" value="jeans.jpg"> 
                <p>Jeans - $30</p>
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </li>
        <li>
            <img src="dress.jpg" alt="Dress">
            <form action="" method="post">
                <input type="hidden" name="product_id" value="3">
                <input type="hidden" name="product_name" value="Dress">
                <input type="hidden" name="product_price" value="50">
                <input type="hidden" name="product_image" value="dress.jpg"> 
                <p>Dress - $50</p>
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </li>
        <li>
            <img src="shoes.jpg" alt="Shoes">
            <form action="" method="post">
                <input type="hidden" name="product_id" value="4">
                <input type="hidden" name="product_name" value="Shoes">
                <input type="hidden" name="product_price" value="40">
                <input type="hidden" name="product_image" value="shoes.jpg"> 
                <p>Shoes - $40</p>
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </li>
        
    </ul>
    <h2>Shopping Cart</h2>

    <!-- Display cart items -->
    <!-- Display item image, name, price, and remove button -->
    <ul>
        <?php foreach ($_SESSION['cart'] as $index => $item): ?>
            <li>
            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">    
            <?php echo $item['name']; ?> - $<?php echo $item['price']; ?>
                <form action="" method="post">
                    <input type="hidden" name="remove_index" value="<?php echo $index; ?>">
                    <button type="submit" name="remove_item">Remove</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    <!-- Display total price of items in the cart -->
    <p class="ll">Total Price: $<?php echo $total_price; ?></p>

    <!-- Link to checkout page -->
    <a href="checkout.php">Checkout</a>
    <!-- Logout button -->
    <form class="logout-button" action="index.php" method="GET">
        <button type="submit" name="logout">Logout</button>
    </form>

    <div class="view-orders-button">
        <a href="orders.php" target="_blank" class="button">View Orders</a>
    </div>
   
</body>
</html>
