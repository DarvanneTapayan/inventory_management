<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check if the user is an Admin
if ($_SESSION['role_id'] != 1) {
    echo "Access denied. You do not have permission to access this page.";
    exit;
}

include_once '../config/database.php';
include_once '../classes/Category.php';

$database = new Database();
$db = $database->getConnection();

$category = new Category($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = $_POST['category_name'];
    $description = $_POST['description'];

    if ($category->create($category_name, $description)) {
        echo "Category added successfully.";
    } else {
        echo "Error adding category.";
    }
}

include_once '../templates/header.php';
?>

<h1>Add Category</h1>
<form method="POST" action="">
    <input type="text" name="category_name" placeholder="Category Name" required>
    <textarea name="description" placeholder="Description"></textarea>
    <button type="submit">Add Category</button>
</form>

<?php include_once '../templates/footer.php'; ?>
