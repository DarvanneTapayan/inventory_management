<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class Cart {
    public function addToCart($product_id, $quantity) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] += $quantity;
        } else {
            $_SESSION['cart'][$product_id] = $quantity;
        }
    }

    public function viewCart() {
        return isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    }

    public function clearCart() {
        unset($_SESSION['cart']);
    }

    public function removeItem($product_id) {
        if (isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
        }
    }
}
?>
