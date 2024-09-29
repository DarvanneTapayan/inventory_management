<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class Cart {
    public function addToCart($product_id, $quantity) {
        // If cart doesn't exist, create it
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // If product already exists in the cart, update the quantity
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
    
    public function calculateTotal($db) {
        $total = 0;
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                // Fetch product price from the database
                $query = "SELECT price FROM products WHERE product_id = :product_id";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':product_id', $product_id);
                $stmt->execute();
                $product = $stmt->fetch(PDO::FETCH_ASSOC);
    
                if ($product) {
                    $total += $product['price'] * $quantity;
                }
            }
        }
        return $total;
    }
    
}
?>
