<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check if the user is an Admin or Manager
if ($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2) {
    echo "Access denied. You do not have permission to access this page.";
    exit;
}

include_once '../config/database.php';
include_once '../classes/Product.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    if ($product->delete($product_id)) {
        echo "Product deleted successfully.";
    } else {
        echo "Error deleting product.";
    }
} else {
    echo "No product ID specified.";
}

header("Location: view_products.php"); // Redirect back to products view
exit;
?>
