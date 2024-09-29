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
include_once '../classes/InventoryAdjustment.php';
include_once '../classes/Product.php';

$database = new Database();
$db = $database->getConnection();

$inventoryAdjustment = new InventoryAdjustment($db);
$product = new Product($db);

// Fetch existing products
$products = $product->read();

if (isset($_GET['id'])) {
    $adjustment_id = $_GET['id'];
    $existing_adjustment = $inventoryAdjustment->readOne($adjustment_id); // Fetch the existing adjustment details

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $product_id = $_POST['product_id'];
        $adjustment_type = $_POST['adjustment_type'];
        $quantity = $_POST['quantity'];
        $reason = $_POST['reason'];
        $adjustment_date = $_POST['adjustment_date'];

        if ($inventoryAdjustment->update($adjustment_id, $product_id, $adjustment_type, $quantity, $reason, $adjustment_date)) {
            echo "Inventory Adjustment updated successfully.";
        } else {
            echo "Error updating Inventory Adjustment.";
        }
    }
} else {
    echo "No adjustment ID specified.";
    exit;
}

// Include header
include_once '../templates/header.php';
?>

<h1>Edit Inventory Adjustment</h1>
<form method="POST" action="">
    <label for="product_id">Select Product:</label>
    <select name="product_id" id="product_id" required>
        <option value="">Select a product</option>
        <?php foreach ($products as $row): ?>
            <option value="<?php echo $row['product_id']; ?>" <?php echo $existing_adjustment['product_id'] == $row['product_id'] ? 'selected' : ''; ?>><?php echo $row['product_name']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="adjustment_type">Adjustment Type:</label>
    <select name="adjustment_type" id="adjustment_type" required>
        <option value="increase" <?php echo $existing_adjustment['adjustment_type'] == 'increase' ? 'selected' : ''; ?>>Increase</option>
        <option value="decrease" <?php echo $existing_adjustment['adjustment_type'] == 'decrease' ? 'selected' : ''; ?>>Decrease</option>
    </select>

    <input type="number" name="quantity" value="<?php echo $existing_adjustment['quantity']; ?>" required>
    <input type="text" name="reason" value="<?php echo $existing_adjustment['reason']; ?>" required>
    <input type="date" name="adjustment_date" value="<?php echo $existing_adjustment['adjustment_date']; ?>" required>
    <button type="submit">Update Inventory Adjustment</button>
</form>

<?php
// Include footer
include_once '../templates/footer.php';
?>
