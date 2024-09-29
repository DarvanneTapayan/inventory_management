<?php
session_start();
include_once '../classes/Cart.php';
include_once '../config/database.php';
include_once '../classes/Order.php';

$cart = new Cart();
$cart_items = $cart->viewCart();

if (empty($cart_items)) {
    header("Location: view_cart.php"); // Redirect if cart is empty
    exit;
}

// Check if the customer ID is set in the session
if (!isset($_SESSION['user_id'])) {
    echo "User ID is not set in the session.";
    exit;
} else {
    echo "User ID: " . $_SESSION['user_id'];
}

// Create an Order object
$database = new Database();
$db = $database->getConnection();
$order = new Order($db);

// Initialize total amount
$total_amount = 0;

// Validate customer ID from session
$customer_id = $_SESSION['user_id'];

// Check if customer ID exists in users table
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
    // Calculate total amount
    foreach ($cart_items as $product_id => $quantity) {
        // Fetch product price
        $query = "SELECT price FROM products WHERE product_id = :product_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_amount += $product['price'] * $quantity;
    }

    // Place the order
    if ($order->create($customer_id, $total_amount)) {
        // Clear the cart after successful order placement
        $cart->clearCart();
        echo "Order placed successfully!";
    } else {
        echo "Error placing the order.";
    }
}

// Include header
include_once '../templates/header.php';
?>

<h1>Checkout</h1>
<form method="POST" action="">
    <h3>Your Cart Items:</h3>
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
    <button type="submit">Place Order</button>
</form>

<?php
// Include footer
include_once '../templates/footer.php';
?>
