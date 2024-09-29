<?php
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Category</title>
</head>
<body>
    <h1>Add Category</h1>
    <form method="POST" action="">
        <input type="text" name="category_name" placeholder="Category Name" required>
        <input type="text" name="description" placeholder="Description">
        <button type="submit">Add Category</button>
    </form>
</body>
</html>
