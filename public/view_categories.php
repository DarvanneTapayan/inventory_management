<?php
include_once '../config/database.php';
include_once '../classes/Category.php';

$database = new Database();
$db = $database->getConnection();

$category = new Category($db);
$categories = $category->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Categories</title>
</head>
<body>
    <h1>Categories List</h1>
    <table>
        <tr>
            <th>Category ID</th>
            <th>Category Name</th>
            <th>Description</th>
        </tr>
        <?php
        foreach ($categories as $row) {
            echo "<tr>";
            echo "<td>{$row['category_id']}</td>";
            echo "<td>{$row['category_name']}</td>";
            echo "<td>{$row['description']}</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
