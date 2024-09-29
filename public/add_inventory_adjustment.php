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
include_once '../classes/InventoryAdjustment.php';
include_once '../classes/Product.php';

$database = new Database();
$db = $database->getConnection();
$inventoryAdjustment = new InventoryAdjustment($db);
$product = new Product($db);

// Fetch existing products for dropdown
$products = $product->read();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $adjustment_type = $_POST['adjustment_type'];
    $quantity = $_POST['quantity'];
    $reason = $_POST['reason'];
    
    if ($inventoryAdjustment->create($product_id, $adjustment_type, $quantity, $reason, date("Y-m-d H:i:s"))) {
        echo "Inventory adjustment added successfully.";
    } else {
        echo "Error adding inventory adjustment.";
    }
}

include_once '../templates/header.php';
?>

<h1>Add Inventory Adjustment</h1>
<form method="POST" action="">
    <label for="product_id">Select Product:</label>
    <select name="product_id" required>
        <option value="">Select a product</option>
        <?php foreach ($products as $row): ?>
            <option value="<?php echo $row['product_id']; ?>"><?php echo $row['product_name']; ?></option>
        <?php endforeach; ?>
    </select>
    
    <label for="adjustment_type">Adjustment Type:</label>
    <select name="adjustment_type" required>
        <option value="Increase">Increase</option>
        <option value="Decrease">Decrease</option>
    </select>

    <input type="number" name="quantity" placeholder="Quantity" required>
    <textarea name="reason" placeholder="Reason for adjustment"></textarea>
    <button type="submit">Add Adjustment</button>
</form>

<?php include_once '../templates/footer.php'; ?>
