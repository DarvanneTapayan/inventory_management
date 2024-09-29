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
include_once '../classes/PurchaseOrder.php';
include_once '../classes/Supplier.php';

$database = new Database();
$db = $database->getConnection();

$purchaseOrder = new PurchaseOrder($db);
$supplier = new Supplier($db);

// Fetch existing suppliers
$suppliers = $supplier->read();

if (isset($_GET['id'])) {
    $purchase_order_id = $_GET['id'];
    $existing_order = $purchaseOrder->readOne($purchase_order_id); // Fetch the existing purchase order details

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $supplier_id = $_POST['supplier_id'];
        $order_date = $_POST['order_date'];
        $status = $_POST['status'];
        $total_amount = $_POST['total_amount'];

        if ($purchaseOrder->update($purchase_order_id, $supplier_id, $order_date, $status, $total_amount)) {
            echo "Purchase Order updated successfully.";
        } else {
            echo "Error updating Purchase Order.";
        }
    }
} else {
    echo "No order ID specified.";
    exit;
}

// Include header
include_once '../templates/header.php';
?>

<h1>Edit Purchase Order</h1>
<form method="POST" action="">
    <label for="supplier_id">Select Supplier:</label>
    <select name="supplier_id" id="supplier_id" required>
        <option value="">Select a supplier</option>
        <?php foreach ($suppliers as $row): ?>
            <option value="<?php echo $row['supplier_id']; ?>" <?php echo $existing_order['supplier_id'] == $row['supplier_id'] ? 'selected' : ''; ?>><?php echo $row['supplier_name']; ?></option>
        <?php endforeach; ?>
    </select>
    
    <input type="date" name="order_date" value="<?php echo $existing_order['order_date']; ?>" required>
    <input type="text" name="status" value="<?php echo $existing_order['status']; ?>" required>
    <input type="number" name="total_amount" value="<?php echo $existing_order['total_amount']; ?>" required>
    <button type="submit">Update Purchase Order</button>
</form>

<?php
// Include footer
include_once '../templates/footer.php';
?>
