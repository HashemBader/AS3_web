<?php
// Set session cookie parameters to expire when the browser is closed
session_set_cookie_params(0);

session_start();



// Redirect user to index.php if cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: index.php");
}

// Calculate total price of items in the cart
$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_price += $item['price'];
}

// Store personal information in a file and place the order
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {
    // Retrieve personal information from the form submission
    $name = $_POST['name'];
    $card_number = $_POST['card_number'];
    $ccv = $_POST['ccv'];
    $address = $_POST['address'];

        // Prepare the data to be stored in a file
        $data = "Name: $name\nCard Number: $card_number\nCCV: $ccv\nAddress: $address\n\n";
        
        // Open file for writing (create file if it doesn't exist)
        $myfile = fopen("products.csv", 'a') or die('Cannot open file');

        // Write data to file
        fwrite($myfile, $data);
        
        // Close file handle
        fclose($myfile);
        
    // Clear the cart after placing the order
    $_SESSION['cart'] = [];

    // Redirect to place_order.php
    header("Location: place_order.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
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
            text-align: center; 
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
            margin-left: 10px;
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
    </style>
</head>
<body>
    <h1>Checkout</h1>
    <h2>Items in Your Cart</h2>

    <!-- Display cart items -->
    <ul>
        <?php foreach ($_SESSION['cart'] as $item): ?>
            <li>
            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">    
            <?php echo $item['name']; ?> - $<?php echo $item['price']; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <!-- Display total price of items in the cart -->
    <p class="ll">Total Price: $<?php echo $total_price; ?></p>

        <!-- Checkout form -->
        <h2>Personal Information</h2>
        <!-- Input fields for personal information -->
        <form action="" method="post">
        <label class="ll" for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label class="ll" for="card_number">Card Number:</label>
        <input type="text" id="card_number" name="card_number" title="Please enter a valid 16-digit card number" required><br><br>
        
        <label class="ll" for="ccv">CCV:</label>
        <input type="text" id="ccv" name="ccv" title="Please enter a valid 3-digit CCV number" required><br><br>
        
        <label class="ll" for="address">Address:</label>
        <input type="text" id="address" name="address" required><br><br>
        <!-- Button to store personal information and place order -->
        <button type="submit" name="place_order">Place Order</button>
    </form>
    <!-- Link to go back to index page -->
    <a href="index.php">Back to Store</a>
        
    </form>
</body>
</html>
