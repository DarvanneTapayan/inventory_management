<?php
session_start();
// Check if the user is logged in and is an Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: login.php");
    exit;
}

include_once '../config/database.php';
include_once '../classes/Product.php';
include_once '../classes/Category.php';
include_once '../classes/Supplier.php';
include_once '../classes/PurchaseOrder.php';
include_once '../classes/Sale.php';
include_once '../classes/InventoryAdjustment.php';
include_once '../classes/Order.php'; // Include Order class

$database = new Database();
$db = $database->getConnection();

// Instantiate classes
$product = new Product($db);
$category = new Category($db);
$supplier = new Supplier($db);
$purchaseOrder = new PurchaseOrder($db);
$sale = new Sale($db);
$inventoryAdjustment = new InventoryAdjustment($db);
$order = new Order($db); // Instantiate Order class

// Fetch data for display
$products = $product->read();
$categories = $category->read();
$suppliers = $supplier->read();
$purchaseOrders = $purchaseOrder->read();
$sales = $sale->read();
$inventoryAdjustments = $inventoryAdjustment->read();

// Include header
include_once '../templates/header.php';
?>

<h1>Welcome to the Admin Dashboard</h1>
    
<h2>Manage Products</h2>
<a href="view_products.php">View Products</a>
<a href="add_product.php">Add Product</a>

<h2>Manage Categories</h2>
<a href="view_categories.php">View Categories</a>
<a href="add_category.php">Add Category</a>

<h2>Manage Suppliers</h2>
<a href="view_suppliers.php">View Suppliers</a>
<a href="add_supplier.php">Add Supplier</a>

<h2>Manage Purchase Orders</h2>
<a href="view_purchase_orders.php">View Purchase Orders</a>
<a href="add_purchase_order.php">Add Purchase Order</a>

<h2>Manage Sales</h2>
<a href="view_sales.php">View Sales</a>
<a href="add_sale.php">Add Sale</a>

<h2>Manage Inventory Adjustments</h2>
<a href="view_inventory_adjustments.php">View Inventory Adjustments</a>
<a href="add_inventory_adjustment.php">Add Inventory Adjustment</a>

<h2>Manage Orders</h2>
<a href="view_all_orders.php">View Orders</a> <!-- New Link -->
<a href="add_order.php">Add Order</a> <!-- New Link -->

<br>
<a href="logout.php">Logout</a>

<?php
// Include footer
include_once '../templates/footer.php';
?>
