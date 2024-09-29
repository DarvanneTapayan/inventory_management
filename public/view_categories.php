<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check if the user is an Admin or Manager
if ($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2) {
    echo "Access denied. You do not have permission to access this page.";
    exit;
}

include_once '../config/database.php';
include_once '../classes/Category.php';

$database = new Database();
$db = $database->getConnection();
$category = new Category($db);

$categories = $category->read();

include_once '../templates/header.php';
?>

<h1>Categories List</h1>
<table border="1">
    <tr>
        <th>Category ID</th>
        <th>Name</th>
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
<a href="add_category.php">Add Category</a>

<?php include_once '../templates/footer.php'; ?>
