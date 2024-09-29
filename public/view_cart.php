<?php
session_start();
include_once '../classes/Cart.php';

$cart = new Cart();
$cart_items = $cart->viewCart();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
</head>
<body>
    <h1>Your Shopping Cart</h1>
    <table border="1">
        <tr>
            <th>Product ID</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        <?php if (empty($cart_items)): ?>
            <tr><td colspan="3">Your cart is empty.</td></tr>
        <?php else: ?>
            <?php foreach ($cart_items as $product_id => $quantity): ?>
                <tr>
                    <td><?php echo $product_id; ?></td>
                    <td><?php echo $quantity; ?></td>
                    <td>
                        <a href="delete_from_cart.php?product_id=<?php echo $product_id; ?>">Remove</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <a href="checkout.php">Proceed to Checkout</a>
</body>
</html>
