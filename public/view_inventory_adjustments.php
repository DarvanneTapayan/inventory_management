<?php
include_once '../config/database.php';
include_once '../classes/InventoryAdjustment.php';

$database = new Database();
$db = $database->getConnection();

$inventoryAdjustment = new InventoryAdjustment($db);
$adjustments = $inventoryAdjustment->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Inventory Adjustments</title>
</head>
<body>
    <h1>Inventory Adjustments List</h1>
    <table>
        <tr>
            <th>Adjustment ID</th>
            <th>Product ID</th>
            <th>Adjustment Type</th>
            <th>Quantity</th>
            <th>Reason</th>
            <th>Adjustment Date</th>
        </tr>
        <?php
        foreach ($adjustments as $row) {
            echo "<tr>";
            echo "<td>{$row['adjustment_id']}</td>";
            echo "<td>{$row['product_id']}</td>";
            echo "<td>{$row['adjustment_type']}</td>";
            echo "<td>{$row['quantity']}</td>";
            echo "<td>{$row['reason']}</td>";
            echo "<td>{$row['adjustment_date']}</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
