<?php
session_start();
// Check if the user is logged in and is an Admin or Manager
if (!isset($_SESSION['user_id']) || ($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2)) {
    header("Location: login.php");
    exit;
}

include_once '../config/database.php';
include_once '../classes/Order.php';
include_once '../classes/Customer.php';
include_once '../classes/Product.php';

$database = new Database();
$db = $database->getConnection();
$order = new Order($db);
$customer = new Customer($db);
$product = new Product($db);

// Fetch existing customers for dropdown
$customers = $customer->read();

// Fetch existing products for dropdown
$products = $product->read();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    
    // Fetch product price
    $productDetails = $product->readOne($product_id);
    $total_amount = $productDetails['price'] * $quantity;

    // Create the order
    $lastOrderId = $order->create($customer_id, $total_amount);
    
    if ($lastOrderId) {
        // Now, insert the order item
        $orderItemCreated = $order->addOrderItem($lastOrderId, $product_id, $quantity, $productDetails['price']);
        
        if ($orderItemCreated) {
            echo "Order and order item added successfully.";
        } else {
            echo "Order created but failed to add order item.";
        }
    } else {
        echo "Error adding order.";
    }
}

include_once '../templates/header.php';
?>

<h1>Add Order</h1>
<form method="POST" action="">
    <label for="customer_id">Select Customer:</label>
    <select name="customer_id" id="customer_id" required>
        <option value="">Select a customer</option>
        <?php foreach ($customers as $row): ?>
            <option value="<?php echo $row['user_id']; ?>"><?php echo $row['username']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="product_id">Select Product:</label>
    <select name="product_id" id="product_id" required>
        <option value="">Select a product</option>
        <?php foreach ($products as $row): ?>
            <option value="<?php echo $row['product_id']; ?>"><?php echo $row['product_name']; ?></option>
        <?php endforeach; ?>
    </select>

    <input type="number" name="quantity" placeholder="Quantity" min="1" required>

    <button type="submit">Add Order</button>
</form>

<?php include_once '../templates/footer.php'; ?>
