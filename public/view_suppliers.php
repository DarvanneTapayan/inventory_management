<?php
include_once '../config/database.php';
include_once '../classes/Supplier.php';

$database = new Database();
$db = $database->getConnection();

$supplier = new Supplier($db);
$suppliers = $supplier->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Suppliers</title>
</head>
<body>
    <h1>Suppliers List</h1>
    <table>
        <tr>
            <th>Supplier ID</th>
            <th>Supplier Name</th>
            <th>Contact Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
        </tr>
        <?php
        foreach ($suppliers as $row) {
            echo "<tr>";
            echo "<td>{$row['supplier_id']}</td>";
            echo "<td>{$row['supplier_name']}</td>";
            echo "<td>{$row['contact_name']}</td>";
            echo "<td>{$row['phone']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['address']}</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
