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

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $existing_product = $product->readOne($product_id); // Fetch the existing product details

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $product_name = $_POST['product_name'];
        $description = $_POST['description'];
        $sku = $_POST['sku'];
        $price = $_POST['price'];
        $quantity_in_stock = $_POST['quantity_in_stock'];
        $reorder_level = $_POST['reorder_level'];
        $supplier_id = $_POST['supplier_id'];

        if ($product->update($product_id, $product_name, $description, $sku, $price, $quantity_in_stock, $reorder_level, $supplier_id)) {
            echo "Product updated successfully.";
        } else {
            echo "Error updating product.";
        }
    }
} else {
    echo "No product ID specified.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <form method="POST" action="">
        <input type="text" name="product_name" value="<?php echo $existing_product['product_name']; ?>" required>
        <input type="text" name="description" value="<?php echo $existing_product['description']; ?>">
        <input type="text" name="sku" value="<?php echo $existing_product['sku']; ?>" required>
        <input type="number" name="price" value="<?php echo $existing_product['price']; ?>" required>
        <input type="number" name="quantity_in_stock" value="<?php echo $existing_product['quantity_in_stock']; ?>" required>
        <input type="number" name="reorder_level" value="<?php echo $existing_product['reorder_level']; ?>">
        <button type="submit">Update Product</button>
    </form>
</body>
</html>
