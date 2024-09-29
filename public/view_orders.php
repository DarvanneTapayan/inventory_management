<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 4) { // Ensure user is logged in as Customer
    header("Location: login.php");
    exit;
}

// Include necessary classes
include_once '../config/database.php';
include_once '../classes/Order.php';

$database = new Database();
$db = $database->getConnection();

$order = new Order($db);
$orders = $order->readByCustomer($_SESSION['user_id']); // Fetch orders for the logged-in customer

// Include header
include_once '../templates/header.php';
?>

<h1>Your Orders</h1>
<table border="1">
    <tr>
        <th>Purchase Order ID</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>Total Amount</th>
    </tr>
    <?php if (empty($orders)): ?>
        <tr><td colspan="4">No orders found.</td></tr>
    <?php else: ?>
        <?php foreach ($orders as $row): ?>
            <tr>
                <td><?php echo $row['purchase_order_id']; ?></td>
                <td><?php echo $row['order_date']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['total_amount']; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

<?php
// Include footer
include_once '../templates/footer.php';
?>
