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
include_once '../classes/PurchaseOrder.php';
include_once '../classes/Supplier.php';

$database = new Database();
$db = $database->getConnection();
$purchaseOrder = new PurchaseOrder($db);
$supplier = new Supplier($db);

// Fetch existing suppliers
$suppliers = $supplier->read();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $supplier_id = $_POST['supplier_id'];
    $order_date = date("Y-m-d H:i:s"); // Current date
    $status = $_POST['status'];
    $total_amount = $_POST['total_amount']; // Assuming this is calculated

    if ($purchaseOrder->create($supplier_id, $order_date, $status, $total_amount)) {
        echo "Purchase order added successfully.";
    } else {
        echo "Error adding purchase order.";
    }
}

include_once '../templates/header.php';
?>

<h1>Add Purchase Order</h1>
<form method="POST" action="">
    <label for="supplier_id">Select Supplier:</label>
    <select name="supplier_id" required>
        <option value="">Select a supplier</option>
        <?php foreach ($suppliers as $row): ?>
            <option value="<?php echo $row['supplier_id']; ?>"><?php echo $row['supplier_name']; ?></option>
        <?php endforeach; ?>
    </select>

    <input type="number" name="total_amount" placeholder="Total Amount" required>
    
    <label for="status">Order Status:</label>
    <select name="status" required>
        <option value="Pending">Pending</option>
        <option value="Completed">Completed</option>
        <option value="Cancelled">Cancelled</option>
    </select>

    <button type="submit">Add Purchase Order</button>
</form>

<?php include_once '../templates/footer.php'; ?>
