<?php
include_once '../config/database.php';
include_once '../classes/Product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and assign the input data
    $product_name = $_POST['product_name'];
    $category_id = $_POST['category_id'];
    $description = $_POST['description'];
    $sku = $_POST['sku'];
    $price = $_POST['price'];
    $quantity_in_stock = $_POST['quantity_in_stock'];
    $reorder_level = $_POST['reorder_level'];
    $supplier_id = $_POST['supplier_id'];

    // Call the create method
    if ($product->create($product_name, $category_id, $description, $sku, $price, $quantity_in_stock, $reorder_level, $supplier_id)) {
        echo "Product added successfully.";
    } else {
        echo "Error adding product.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
</head>
<body>
    <h1>Add Product</h1>
    <form method="POST" action="">
        <input type="text" name="product_name" placeholder="Product Name" required>
        <input type="number" name="category_id" placeholder="Category ID" required>
        <input type="text" name="description" placeholder="Description">
        <input type="text" name="sku" placeholder="SKU" required>
        <input type="number" name="price" placeholder="Price" required>
        <input type="number" name="quantity_in_stock" placeholder="Quantity in Stock" required>
        <input type="number" name="reorder_level" placeholder="Reorder Level">
        <input type="number" name="supplier_id" placeholder="Supplier ID" required>
        <button type="submit">Add Product</button>
    </form>
</body>
</html>
