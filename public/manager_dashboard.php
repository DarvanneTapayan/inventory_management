<?php
session_start();
// Check if the user is logged in and is a Manager
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
    header("Location: login.php");
    exit;
}

include_once '../config/database.php';
include_once '../classes/Product.php';
include_once '../classes/Sale.php';
include_once '../classes/Order.php'; // Include Order class

$database = new Database();
$db = $database->getConnection();

// Instantiate classes
$product = new Product($db);
$sale = new Sale($db);
$order = new Order($db); // Instantiate Order class

// Fetch data for display
$products = $product->read();
$sales = $sale->read();

// Include header
include_once '../templates/header.php';
?>

<h1>Welcome to the Manager Dashboard</h1>
    
<h2>Manage Products</h2>
<a href="view_products.php">View Products</a>
<a href="add_product.php">Add Product</a>

<h2>Manage Sales</h2>
<a href="view_sales.php">View Sales</a>
<a href="add_sale.php">Add Sale</a>

<h2>Manage Orders</h2>
<a href="view_all_orders.php">View Orders</a> <!-- New Link -->
<a href="add_order.php">Add Order</a> <!-- New Link -->

<br>
<a href="logout.php">Logout</a>

<?php
// Include footer
include_once '../templates/footer.php';
?>
