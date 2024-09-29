<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check if the user is a Manager or Admin
if ($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2) { // 1 = Admin, 2 = Manager
    echo "Access denied. You do not have permission to access this page.";
    exit;
}

include_once '../config/database.php';
include_once '../classes/Sale.php';
include_once '../classes/Product.php';

$database = new Database();
$db = $database->getConnection();

$sale = new Sale($db);
$product = new Product($db);

// Fetch existing products
$products = $product->read();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sale_date = $_POST['sale_date'];
    $customer_name = $_POST['customer_name'];
    $total_amount = $_POST['total_amount'];
    $status = $_POST['status'];

    if ($sale->create($sale_date, $customer_name, $total_amount, $status)) {
        echo "Sale added successfully.";
    } else {
        echo "Error adding Sale.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Sale</title>
</head>
<body>
    <h1>Add Sale</h1>
    <form method="POST" action="">
        <input type="date" name="sale_date" placeholder="Sale Date" required>
        <input type="text" name="customer_name" placeholder="Customer Name" required>
        <input type="number" name="total_amount" placeholder="Total Amount" required>
        <input type="text" name="status" placeholder="Status" required>
        <button type="submit">Add Sale</button>
    </form>
</body>
</html>
