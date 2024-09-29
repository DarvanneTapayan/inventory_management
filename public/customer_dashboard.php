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
$products = $customer->viewProducts();

include_once '../templates/header.php';
echo "Customer ID: " . $customer_id; // Debugging line

?>

<h1>Customer Dashboard</h1>
    
<h2>Your Orders</h2>
<table border="1">
    <tr>
        <th>Order ID</th>
        <th>Product Name</th> <!-- Display Product Name -->
        <th>Quantity</th> <!-- Display Quantity -->
        <th>Total Amount</th>
        <th>Order Date</th>
        <th>Status</th>
    </tr>
    <?php if (count($orders) > 0): ?>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo $order['order_id']; ?></td>
                <td><?php echo $order['product_name']; ?></td> <!-- Display Product Name -->
                <td><?php echo $order['quantity']; ?></td> <!-- Display Quantity -->
                <td><?php echo $order['total_amount']; ?></td>
                <td><?php echo $order['order_date']; ?></td>
                <td><?php echo $order['status']; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">No orders found.</td>
        </tr>
    <?php endif; ?>
</table>

<h2>Available Products</h2>
<table border="1">
    <tr>
        <th>Product ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo $product['product_id']; ?></td>
            <td><?php echo $product['product_name']; ?></td>
            <td><?php echo $product['price']; ?></td>
            <td>
                <form method="POST" action="add_to_cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                    <input type="number" name="quantity" value="1" min="1" required>
                    <button type="submit">Add to Cart</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="view_cart.php">View Cart</a>



<?php include_once '../templates/footer.php'; ?>
