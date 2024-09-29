<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check if the user is an Admin
if ($_SESSION['role_id'] != 1) { // 1 = Admin
    echo "Access denied. You do not have permission to access this page.";
    exit;
}

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
            <th>Actions</th>
        </tr>
        <?php foreach ($categories as $row): ?>
            <tr>
                <td><?php echo $row['category_id']; ?></td>
                <td><?php echo $row['category_name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td>
                    <a href="edit_category.php?id=<?php echo $row['category_id']; ?>">Edit</a> |
                    <a href="delete_category.php?id=<?php echo $row['category_id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
