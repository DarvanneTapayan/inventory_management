<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
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
            <li><a href="add_category.php">Add Category</a></li>
            <li><a href="view_categories.php">View Categories</a></li>
            <li><a href="add_supplier.php">Add Supplier</a></li>
            <li><a href="view_suppliers.php">View Suppliers</a></li>
            <li><a href="add_purchase_order.php">Add Purchase Order</a></li>
            <li><a href="view_purchase_orders.php">View Purchase Orders</a></li>
            <li><a href="add_sale.php">Add Sale</a></li>
            <li><a href="view_sales.php">View Sales</a></li>
            <li><a href="add_inventory_adjustment.php">Add Inventory Adjustment</a></li>
            <li><a href="view_inventory_adjustments.php">View Inventory Adjustments</a></li>
        </ul>
    </nav>
</body>
</html>
