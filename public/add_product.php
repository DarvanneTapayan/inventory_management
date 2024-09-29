<?php
include_once '../config/database.php';
include_once '../classes/Product.php';
include_once '../classes/Category.php'; // Include Category class
include_once '../classes/Supplier.php'; // Include Supplier class

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$category = new Category($db);
$supplier = new Supplier($db); // Create a new Supplier object

// Fetch existing categories
$categories = $category->read();

// Fetch existing suppliers
$suppliers = $supplier->read(); // Fetch suppliers

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and assign the input data
    $product_name = $_POST['product_name'];
    $category_id = $_POST['category_id']; // From category dropdown
    $description = $_POST['description'];
    $sku = $_POST['sku'];
    $price = $_POST['price'];
    $quantity_in_stock = $_POST['quantity_in_stock'];
    $reorder_level = $_POST['reorder_level'];
    $supplier_id = $_POST['supplier_id']; // From supplier dropdown

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
        
        <!-- Dropdown for Categories -->
        <label for="category_id">Select Category:</label>
        <select name="category_id" id="category_id" required>
            <option value="">Select a category</option> <!-- Placeholder option -->
            <?php foreach ($categories as $row): ?>
                <option value="<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></option>
            <?php endforeach; ?>
        </select>

        <!-- Dropdown for Suppliers -->
        <label for="supplier_id">Select Supplier:</label>
        <select name="supplier_id" id="supplier_id" required>
            <option value="">Select a supplier</option> <!-- Placeholder option -->
            <?php foreach ($suppliers as $row): ?>
                <option value="<?php echo $row['supplier_id']; ?>"><?php echo $row['supplier_name']; ?></option>
            <?php endforeach; ?>
        </select>

        <input type="text" name="description" placeholder="Description">
        <input type="text" name="sku" placeholder="SKU" required>
        <input type="number" name="price" placeholder="Price" required>
        <input type="number" name="quantity_in_stock" placeholder="Quantity in Stock" required>
        <input type="number" name="reorder_level" placeholder="Reorder Level">
        <button type="submit">Add Product</button>
    </form>
</body>
</html>
