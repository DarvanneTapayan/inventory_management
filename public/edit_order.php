<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check if the user is an Admin
if ($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2) {
    echo "Access denied. You do not have permission to access this page.";
    exit;
}

include_once '../config/database.php';
include_once '../classes/Order.php';

$database = new Database();
$db = $database->getConnection();
$order = new Order($db);

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    $existing_order = $order->readOne($order_id); // Fetch existing order details

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $status = $_POST['status'];

        if ($order->update($order_id, $existing_order['customer_id'], $existing_order['total_amount'])) {
            echo "Order status updated successfully.";
        } else {
            echo "Error updating order status.";
        }
    }
} else {
    echo "No order ID specified.";
    exit;
}

include_once '../templates/header.php';
?>

<h1>Edit Order Status</h1>
<form method="POST" action="">
    <label for="status">Order Status:</label>
    <select name="status" required>
        <option value="Pending" <?php echo $existing_order['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
        <option value="Completed" <?php echo $existing_order['status'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
        <option value="Cancelled" <?php echo $existing_order['status'] == 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
    </select>
    <button type="submit">Update Status</button>
</form>

<?php include_once '../templates/footer.php'; ?>
