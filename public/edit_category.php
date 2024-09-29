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

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
    $existing_category = $category->readOne($category_id); // Fetch existing category details

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $category_name = $_POST['category_name'];
        $description = $_POST['description'];

        if ($category->update($category_id, $category_name, $description)) {
            echo "Category updated successfully.";
        } else {
            echo "Error updating category.";
        }
    }
} else {
    echo "No category ID specified.";
    exit;
}

include_once '../templates/header.php';
?>

<h1>Edit Category</h1>
<form method="POST" action="">
    <input type="text" name="category_name" value="<?php echo $existing_category['category_name']; ?>" required>
    <textarea name="description"><?php echo $existing_category['description']; ?></textarea>
    <button type="submit">Update Category</button>
</form>

<?php include_once '../templates/footer.php'; ?>
