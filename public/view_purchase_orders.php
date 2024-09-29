<?php
include_once '../config/database.php';
include_once '../classes/PurchaseOrder.php';

$database = new Database();
$db = $database->getConnection();

$purchaseOrder = new PurchaseOrder($db);
$purchase_orders = $purchaseOrder->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Purchase Orders</title>
</head>
<body>
    <h1>Purchase Orders List</h1>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Supplier ID</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Total Amount</th>
        </tr>
        <?php
        foreach ($purchase_orders as $row) {
            echo "<tr>";
            echo "<td>{$row['order_id']}</td>";
            echo "<td>{$row['supplier_id']}</td>";
            echo "<td>{$row['order_date']}</td>";
            echo "<td>{$row['status']}</td>";
            echo "<td>{$row['total_amount']}</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
