<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$role_id = $_SESSION['role_id'];

// Fetch role name from the database
include_once '../config/database.php';
include_once '../classes/Role.php';

$database = new Database();
$db = $database->getConnection();
$role = new Role($db);
$roles = $role->read();
$role_name = '';

foreach ($roles as $r) {
    if ($r['role_id'] == $role_id) {
        $role_name = $r['role_name'];
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($username); ?></h1>
    <p>Your role: <?php echo htmlspecialchars($role_name); ?></p>
    <a href="logout.php">Logout</a>

    <!-- Display options based on role -->
    <?php if ($role_name == 'Admin'): ?>
        <h2>Admin Options</h2>
        <ul>
            <li><a href="add_product.php">Add Product</a></li>
            <li><a href="add_category.php">Add Category</a></li>
            <li><a href="add_supplier.php">Add Supplier</a></li>
            <li><a href="view_purchase_orders.php">View Purchase Orders</a></li>
            <!-- More admin-specific links -->
        </ul>
    <?php elseif ($role_name == 'Manager'): ?>
        <h2>Manager Options</h2>
        <ul>
            <li><a href="view_products.php">View Products</a></li>
            <li><a href="add_purchase_order.php">Add Purchase Order</a></li>
            <!-- More manager-specific links -->
        </ul>
    <?php elseif ($role_name == 'Staff'): ?>
        <h2>Staff Options</h2>
        <ul>
            <li><a href="view_sales.php">View Sales</a></li>
            <li><a href="add_sale.php">Add Sale</a></li>
            <!-- More staff-specific links -->
        </ul>
    <?php endif; ?>
</body>
</html>
