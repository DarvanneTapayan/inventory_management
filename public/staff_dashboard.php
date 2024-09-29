<?php
session_start();
// Check if the user is logged in and is Staff
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 3) {
    header("Location: login.php");
    exit;
}

include_once '../config/database.php';
include_once '../classes/Product.php';
include_once '../classes/Sale.php';

$database = new Database();
$db = $database->getConnection();

// Instantiate classes
$product = new Product($db);
$sale = new Sale($db);

// Fetch data for display
$products = $product->read();
$sales = $sale->read();

// Include header
include_once '../templates/header.php';
?>

<h1>Welcome to the Staff Dashboard</h1>
    
<h2>View Products</h2>
<a href="view_products.php">View Products</a>

<h2>View Sales</h2>
<a href="view_sales.php">View Sales</a>

<a href="logout.php">Logout</a>

<?php
// Include footer
include_once '../templates/footer.php';
?>
