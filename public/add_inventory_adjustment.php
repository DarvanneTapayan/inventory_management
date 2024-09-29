<?php
include_once '../config/database.php';
include_once '../classes/InventoryAdjustment.php';

$database = new Database();
$db = $database->getConnection();

$inventoryAdjustment = new InventoryAdjustment($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $adjustment_type = $_POST['adjustment_type'];
    $quantity = $_POST['quantity'];
    $reason = $_POST['reason'];
    $adjustment_date = $_POST['adjustment_date'];

    if ($inventoryAdjustment->create($product_id, $adjustment_type, $quantity, $reason, $adjustment_date)) {
        echo "Inventory Adjustment added successfully.";
    } else {
        echo "Error adding Inventory Adjustment.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Inventory Adjustment</title>
</head>
<body>
    <h1>Add Inventory Adjustment</h1>
    <form method="POST" action="">
        <input type="number" name="product_id" placeholder="Product ID" required>
        <input type="text" name="adjustment_type" placeholder="Adjustment Type" required>
        <input type="number" name="quantity" placeholder="Quantity" required>
        <input type="text" name="reason" placeholder="Reason">
        <input type="date" name="adjustment_date" placeholder="Adjustment Date" required>
        <button type="submit">Add Adjustment</button>
    </form>
</body>
</html>
