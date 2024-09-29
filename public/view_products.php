<?php
include_once '../config/database.php';
include_once '../classes/Product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$products = $product->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Products</title>
</head>
<body>
    <h1>Products List</h1>
    <table>
        <tr>
            <th>Product ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <!-- Other headers -->
        </tr>
        <?php
        foreach ($products as $row) {
            echo "<tr>";
            echo "<td>{$row['product_id']}</td>";
            echo "<td>{$row['product_name']}</td>";
            echo "<td>{$row['price']}</td>";
            echo "<td>{$row['quantity_in_stock']}</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
