# Online Store Application

This is a simple online store application implemented using PHP. It allows users to browse products, add them to a shopping cart, and place orders.

## Features

- View products available in the store.
- Add products to the shopping cart.
- Remove products from the shopping cart.
- Proceed to checkout and place orders.
- Store personal information securely.

## Requirements

- PHP server environment (e.g., Apache, Nginx)
- Web browser

## Installation

1. Clone or download the repository to your local machine.
2. Place the files in your web server's document root directory.
3. Make sure PHP is installed and configured properly.
4. Start your web server.

## Usage

1. Access the `index.php` file through your web browser to view the store.
2. Browse the available products and add items to your shopping cart.
3. Proceed to checkout to place orders and provide personal information.
4. Confirmation of orders will be displayed on the `place_order.php` page.

## Session Management

- Sessions are utilized to maintain user state throughout the browsing and shopping process.
- The session is initiated when the `index.php` file is accessed.
- An AJAX request is sent to the `keep_session_alive.php` script every 4 minutes to keep the session active.
- Sessions are terminated when the user leaves the website or after a period of inactivity.

## Files

- `index.php`: Main page of the online store with product listings and shopping cart functionality.
- `checkout.php`: Checkout page for entering personal information and placing orders.
- `place_order.php`: Confirmation page displaying order details after successful order placement.
- `keep_session_alive.php`: Script to update the session variable and keep the session active.

## Customization

- Modify the product listings and prices in the `index.php` file to match your store's inventory.
- Customize the CSS styles in the HTML files to change the appearance of the store pages.

