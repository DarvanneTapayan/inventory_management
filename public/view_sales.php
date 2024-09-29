<?php
include_once '../config/database.php';
include_once '../classes/Sale.php';

$database = new Database();
$db = $database->getConnection();

$sale = new Sale($db);
$sales = $sale->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Sales</title>
</head>
<body>
    <h1>Sales List</h1>
    <table>
        <tr>
            <th>Sale ID</th>
            <th>Sale Date</th>
            <th>Customer Name</th>
            <th>Total Amount</th>
            <th>Status</th>
        </tr>
        <?php
        foreach ($sales as $row) {
            echo "<tr>";
            echo "<td>{$row['sale_id']}</td>";
            echo "<td>{$row['sale_date']}</td>";
            echo "<td>{$row['customer_name']}</td>";
            echo "<td>{$row['total_amount']}</td>";
            echo "<td>{$row['status']}</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
