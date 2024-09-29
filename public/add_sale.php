<?php
include_once '../config/database.php';
include_once '../classes/Sale.php';

$database = new Database();
$db = $database->getConnection();

$sale = new Sale($db);

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
        <input type="text" name="status" placeholder="Status">
        <button type="submit">Add Sale</button>
    </form>
</body>
</html>
