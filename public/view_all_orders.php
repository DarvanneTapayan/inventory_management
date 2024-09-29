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
include_once '../classes/Order.php';

$database = new Database();
$db = $database->getConnection();
$order = new Order($db);

$orders = $order->read();

include_once '../templates/header.php';
?>

<h1>All Orders</h1>
<table border="1">
    <tr>
        <th>Order ID</th>
        <th>Customer ID</th>
        <th>Total Amount</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($orders as $row): ?>
        <tr>
            <td><?php echo $row['order_id']; ?></td>
            <td><?php echo $row['customer_id']; ?></td>
            <td><?php echo $row['total_amount']; ?></td>
            <td><?php echo $row['order_date']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <a href="edit_order.php?id=<?php echo $row['order_id']; ?>">Edit</a> |
                <?php if ($_SESSION['role_id'] == 1): // Only Admin can delete ?>
                    <a href="delete_order.php?id=<?php echo $row['order_id']; ?>">Delete</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include_once '../templates/footer.php'; ?>
