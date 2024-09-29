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
include_once '../classes/Category.php';
include_once '../classes/Supplier.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$category = new Category($db);
$supplier = new Supplier($db);

// Fetch existing categories and suppliers
$categories = $category->read();
$suppliers = $supplier->read();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $category_id = $_POST['category_id'];
    $description = $_POST['description'];
    $sku = $_POST['sku'];
    $price = $_POST['price'];
    $quantity_in_stock = $_POST['quantity_in_stock'];
    $reorder_level = $_POST['reorder_level'];
    $supplier_id = $_POST['supplier_id'];

    if ($product->create($product_name, $category_id, $description, $sku, $price, $quantity_in_stock, $reorder_level, $supplier_id)) {
        echo "Product added successfully.";
    } else {
        echo "Error adding product.";
    }
}

// Include header
include_once '../templates/header.php';
?>

<h1>Add Product</h1>
<form method="POST" action="">
    <input type="text" name="product_name" placeholder="Product Name" required>
    
    <label for="category_id">Select Category:</label>
    <select name="category_id" id="category_id" required>
        <option value="">Select a category</option>
        <?php foreach ($categories as $row): ?>
            <option value="<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="supplier_id">Select Supplier:</label>
    <select name="supplier_id" id="supplier_id" required>
        <option value="">Select a supplier</option>
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

<?php
// Include footer
include_once '../templates/footer.php';
?>
