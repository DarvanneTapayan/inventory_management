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

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];

    if ($category->delete($category_id)) {
        echo "Category deleted successfully.";
    } else {
        echo "Error deleting category.";
    }
} else {
    echo "No category ID specified.";
}

?>

<a href="view_categories.php">Back to Categories List</a>
