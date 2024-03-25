<!DOCTYPE html>
<html lang="en">
<head></head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Store</title>
    <style>
        /* CSS styles */
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
            position: relative;
        }
        h1, h2 {
            color: #333;
            text-align: center;
        }
    
        form {
            margin-bottom: 20px;
            margin-left: 10px;
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

    </style></html>
<!-- Display orders -->
<div class="orders">
            <h2>Orders</h2>
            <?php
            // Read and display the contents of the CSV file
            $file_path = 'products.csv';
            if (file_exists($file_path)) {
                $file = fopen($file_path, 'r');
                if ($file) {
                    echo "<ul>";
                    while (($line = fgetcsv($file)) !== false) {
                        echo "<li>" . implode(", ", $line) . "</li>";
                    }
                    echo "</ul>";
                    fclose($file);
                } else {
                    echo "Failed to open file.";
                }
            } else {
                echo "File does not exist.";
            }
            ?>
        </div>
        </form>
    <!-- Link to go back to index page -->
    <a href="index.php">Back to Store</a>
        
    </form>