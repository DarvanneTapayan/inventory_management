<?php
session_start();
include_once '../config/database.php';
include_once '../classes/Cart.php';

$database = new Database();
$db = $database->getConnection();
$cart = new Cart();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Add the item to the cart
    $cart->addToCart($product_id, $quantity);

    header("Location: customer_dashboard.php"); // Redirect back to customer dashboard
    exit;
}
?>
