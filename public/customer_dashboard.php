<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 4) { // Ensure user is logged in as Customer
    header("Location: login.php");
    exit;
}

// Include necessary classes
include_once '../config/database.php';
include_once '../classes/Product.php';
include_once '../classes/Cart.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$products = $product->read(); // Fetch products for customer view

// Initialize the Cart
$cart = new Cart();

// Include header
include_once '../templates/header.php';
?>

<h1>Customer Dashboard</h1>
<h2>Welcome, <?php echo $_SESSION['user_id']; ?>!</h2>

<h3>Available Products</h3>
<table border="1">
    <tr>
        <th>Product Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($products as $row): ?>
        <tr>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td>
                <form method="POST" action="add_to_cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    <input type="number" name="quantity" value="1" min="1" required>
                    <button type="submit">Add to Cart</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="view_cart.php">View Cart</a>

<?php
// Include footer
include_once '../templates/footer.php';
?>
