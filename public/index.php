<?php
include_once '../config/database.php';
include_once '../classes/Category.php';
include_once '../classes/Supplier.php';
include_once '../classes/Product.php';
include_once '../classes/PurchaseOrder.php';
include_once '../classes/Sale.php';
include_once '../classes/InventoryAdjustment.php';

$database = new Database();
$db = $database->getConnection();

$category = new Category($db);
$supplier = new Supplier($db);
$product = new Product($db);
$purchaseOrder = new PurchaseOrder($db);
$sale = new Sale($db);
$inventoryAdjustment = new InventoryAdjustment($db);

// Fetch categories, suppliers, products for display as needed
$categories = $category->read();
$suppliers = $supplier->read();
$products = $product->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Management</title>
</head>
<body>
    <h1>Inventory Management System</h1>
    <nav>
        <h2>Manage</h2>
        <ul>
            <li><a href="add_product.php">Add Product</a></li>
            <li><a href="view_products.php">View Products</a></li>
            <br>
            <li><a href="add_category.php">Add Category</a></li>
            <li><a href="view_categories.php">View Categories</a></li>
            <br>
            <li><a href="add_supplier.php">Add Supplier</a></li>
            <li><a href="view_suppliers.php">View Suppliers</a></li>
            <br>
            <li><a href="add_purchase_order.php">Add Purchase Order</a></li>
            <li><a href="view_purchase_orders.php">View Purchase Orders</a></li>
            <br>
            <li><a href="add_sale.php">Add Sale</a></li>
            <li><a href="view_sales.php">View Sales</a></li>
            <br>
            <li><a href="add_inventory_adjustment.php">Add Inventory Adjustment</a></li>
            <li><a href="view_inventory_adjustments.php">View Inventory Adjustments</a></li>
        </ul>
    </nav>
    <h2>Overview</h2>
    <p>Number of Categories: <?php echo count($categories); ?></p>
    <p>Number of Suppliers: <?php echo count($suppliers); ?></p>
    <p>Number of Products: <?php echo count($products); ?></p>
</body>
</html>
