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

$database = new Database();
$db = $database->getConnection();

$purchaseOrder = new PurchaseOrder($db);
$purchase_orders = $purchaseOrder->read();

// Include header
include_once '../templates/header.php';
?>

<h1>Purchase Orders List</h1>
<table border="1">
    <tr>
        <th>Order ID</th>
        <th>Supplier ID</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>Total Amount</th>
        <th>Actions</th>
    </tr>
    <?php if (empty($purchase_orders)): ?>
        <tr><td colspan="6">No purchase orders found.</td></tr>
    <?php else: ?>
        <?php foreach ($purchase_orders as $row): ?>
            <tr>
                <td><?php echo $row['purchase_order_id']; ?></td>
                <td><?php echo $row['supplier_id']; ?></td>
                <td><?php echo $row['order_date']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['total_amount']; ?></td>
                <td>
                    <a href="edit_purchase_order.php?id=<?php echo $row['purchase_order_id']; ?>">Edit</a> |
                    <a href="delete_purchase_order.php?id=<?php echo $row['purchase_order_id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>
<a href="add_purchase_order.php">Add Purchase Order</a>

<?php
// Include footer
include_once '../templates/footer.php';
?>
