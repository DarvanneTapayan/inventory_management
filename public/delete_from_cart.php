<?php
session_start();
include_once '../classes/Cart.php';

$cart = new Cart();

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $cart->removeItem($product_id);
}

header("Location: view_cart.php"); // Redirect back to the cart view
exit;
?>
