<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check if the user is an Admin or Manager
if ($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2) { // 1 = Admin, 2 = Manager
    echo "Access denied. You do not have permission to access this page.";
    exit;
}

include_once '../config/database.php';
include_once '../classes/Product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$products = $product->read(); // Fetch all products

// Include header
include_once '../templates/header.php';
?>

<h1>Products List</h1>
<table border="1">
    <tr>
        <th>Product ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($products as $row): ?>
        <tr>
            <td><?php echo $row['product_id']; ?></td>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['quantity_in_stock']; ?></td>
            <td>
                <a href="edit_product.php?id=<?php echo $row['product_id']; ?>">Edit</a> |
                <a href="delete_product.php?id=<?php echo $row['product_id']; ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="add_product.php">Add Product</a>

<?php
// Include footer
include_once '../templates/footer.php';
?>
