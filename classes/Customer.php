<?php
class Customer {
    private $conn;
    private $table_name = "customers"; 

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($username, $password, $email) {
        $query = "INSERT INTO " . $this->table_name . " (username, password, email) VALUES (:username, :password, :email)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT)); 
        $stmt->bindParam(':email', $email);

        return $stmt->execute();
    }

    public function fetchOrders($customer_id) {
        $query = "SELECT * FROM orders WHERE customer_id = :customer_id ORDER BY order_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':customer_id', $customer_id);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function viewProducts() {
        $query = "SELECT * FROM products"; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
