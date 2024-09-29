<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include_once '../config/database.php';
include_once '../classes/Customer.php';

$database = new Database();
$db = $database->getConnection();
$customer = new Customer($db);

$customer_id = $_SESSION['user_id'];
$orders = $customer->fetchOrders($customer_id);

include_once '../templates/header.php';
?>

<h1>Your Order History</h1>
<table border="1">
    <tr>
        <th>Order ID</th>
        <th>Total Amount</th>
        <th>Order Date</th>
        <th>Status</th>
    </tr>
    <?php foreach ($orders as $order): ?>
        <tr>
            <td><?php echo $order['order_id']; ?></td>
            <td><?php echo $order['total_amount']; ?></td>
            <td><?php echo $order['order_date']; ?></td>
            <td><?php echo $order['status']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include_once '../templates/footer.php'; ?>
