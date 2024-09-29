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

// Include header
include_once '../templates/header.php';
?>

<h1>Customer Dashboard</h1>
<h2>Your Orders</h2>
<table border="1">
    <tr>
        <th>Order ID</th>
        <th>Total Amount</th>
        <th>Status</th>
        <th>Order Date</th>
    </tr>
    <?php foreach ($orders as $order): ?>
        <tr>
            <td><?php echo $order['order_id']; ?></td>
            <td><?php echo $order['total_amount']; ?></td>
            <td><?php echo $order['status']; ?></td>
            <td><?php echo $order['order_date']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="view_cart.php">View Cart</a>

<?php
// Include footer
include_once '../templates/footer.php';
?>
