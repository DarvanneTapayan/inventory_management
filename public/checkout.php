<?php
session_start();
include_once '../classes/Cart.php';
include_once '../config/database.php';
include_once '../classes/Order.php';

$cart = new Cart();
$cart_items = $cart->viewCart();

if (empty($cart_items)) {
    header("Location: view_cart.php");
    exit;
}

$database = new Database();
$db = $database->getConnection();
$order = new Order($db);
$total_amount = 0;
$customer_id = $_SESSION['user_id'];

// Validate customer ID
$query = "SELECT * FROM users WHERE user_id = :user_id";
$stmt = $db->prepare($query);
$stmt->bindParam(':user_id', $customer_id);
$stmt->execute();

if ($stmt->rowCount() === 0) {
    echo "Invalid customer ID. Please log in again.";
    exit;
}

// Process the order if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($cart_items as $product_id => $quantity) {
        $query = "SELECT price FROM products WHERE product_id = :product_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_amount += $product['price'] * $quantity;
    }

    if ($order->create($customer_id, $total_amount)) {
        $cart->clearCart();
        echo "Order placed successfully!";
    } else {
        echo "Error placing the order.";
    }
}

include_once '../templates/header.php';
?>

<h1>Checkout</h1>
<h2>Your Cart Items:</h2>
<table border="1">
    <tr>
        <th>Product ID</th>
        <th>Quantity</th>
    </tr>
    <?php foreach ($cart_items as $product_id => $quantity): ?>
        <tr>
            <td><?php echo $product_id; ?></td>
            <td><?php echo $quantity; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<h3>Total Amount: <?php echo $total_amount; ?> USD</h3>

<form method="POST" action="">
    <button type="submit">Place Order</button>
</form>

<?php include_once '../templates/footer.php'; ?>
