<?php
// Set session cookie parameters to expire when the browser is closed
session_set_cookie_params(300);

// File path to the CSV file containing personal information
$file_path = 'products.csv';
// Check if the file exists
if (file_exists($file_path)) {
    // Read file contents into an array, ignoring empty lines
    $lines = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    // Iterate through each line in reverse order to find the last name
    for ($i = count($lines) - 1; $i >= 0; $i--) {
        // Check if the line contains the 'Name' field
        if (strpos($lines[$i], 'Name: ') !== false) {
            // Extract the name from the line
            $name = substr($lines[$i], strlen('Name: '));
            break;
        }
    }
}

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thank You</title>
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
        }
        a:hover {
            background-color: #005f7a;
        }
        .checkout-form {
            margin: 20px auto; 
            max-width: 400px; 
        }
    </style>
    </head>
    <body>
        <h1>Thank You, <?php echo htmlspecialchars($name); ?>!</h1>
        <p>Your order has been confirmed.</p>
        <a href="index.php">Back to Store</a>
    </body>
    </html>
