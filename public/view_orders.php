<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: login.php");
    exit;
}

include_once '../config/database.php';
include_once '../classes/Order.php';

$database = new Database();
$db = $database->getConnection();
$order = new Order($db);

// Fetch all orders
$orders = $order->read(); // Implement this method to fetch all orders

// Include header
include_once '../templates/header.php';
?>

<h1>Manage Orders</h1>
<table border="1">
    <tr>
        <th>Order ID</th>
        <th>Customer ID</th>
        <th>Total Amount</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($orders as $row): ?>
        <tr>
            <td><?php echo $row['order_id']; ?></td>
            <td><?php echo $row['customer_id']; ?></td>
            <td><?php echo $row['total_amount']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <form method="POST" action="update_order_status.php">
                    <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                    <select name="status">
                        <option value="Pending" <?php echo $row['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                        <option value="Processing" <?php echo $row['status'] == 'Processing' ? 'selected' : ''; ?>>Processing</option>
                        <option value="Shipped" <?php echo $row['status'] == 'Shipped' ? 'selected' : ''; ?>>Shipped</option>
                        <option value="Delivered" <?php echo $row['status'] == 'Delivered' ? 'selected' : ''; ?>>Delivered</option>
                        <option value="Canceled" <?php echo $row['status'] == 'Canceled' ? 'selected' : ''; ?>>Canceled</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
// Include footer
include_once '../templates/footer.php';
?>
