<?php
include_once '../config/database.php';
include_once '../classes/PurchaseOrder.php';

$database = new Database();
$db = $database->getConnection();

$purchaseOrder = new PurchaseOrder($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $supplier_id = $_POST['supplier_id'];
    $order_date = $_POST['order_date'];
    $status = $_POST['status'];
    $total_amount = $_POST['total_amount'];

    if ($purchaseOrder->create($supplier_id, $order_date, $status, $total_amount)) {
        echo "Purchase Order added successfully.";
    } else {
        echo "Error adding Purchase Order.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Purchase Order</title>
</head>
<body>
    <h1>Add Purchase Order</h1>
    <form method="POST" action="">
        <input type="number" name="supplier_id" placeholder="Supplier ID" required>
        <input type="date" name="order_date" placeholder="Order Date" required>
        <input type="text" name="status" placeholder="Status">
        <input type="number" name="total_amount" placeholder="Total Amount" required>
        <button type="submit">Add Purchase Order</button>
    </form>
</body>
</html>
