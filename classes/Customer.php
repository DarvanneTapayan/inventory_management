<?php
class Customer {
    private $conn;
    private $table_name = "users"; // Assuming you have a users table for customers

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new user
    public function register($username, $password) {
        $query = "INSERT INTO " . $this->table_name . " (username, password) VALUES (:username, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT)); // Hashing the password

        return $stmt->execute();
    }

    // Fetch orders for the logged-in customer with product details
    public function fetchOrders($customer_id) {
        $query = "SELECT o.order_id, oi.quantity, oi.price, p.product_name, o.total_amount, o.order_date, o.status
                  FROM orders o
                  JOIN order_items oi ON o.order_id = oi.order_id
                  JOIN products p ON oi.product_id = p.product_id
                  WHERE o.customer_id = :customer_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':customer_id', $customer_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch all products
    public function viewProducts() {
        $query = "SELECT * FROM products"; // Assuming you have a products table
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Fetch all customers
    public function read() {
        $query = "SELECT user_id, username FROM " . $this->table_name . " WHERE role_id = 3"; // Assuming role_id = 3 is for customers
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch a specific customer by ID
    public function readById($user_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}
?>

