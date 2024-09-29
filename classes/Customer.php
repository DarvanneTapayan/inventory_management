<?php
class Customer {
    private $conn;
    private $table_name = "customers"; // Assuming you have a customers table

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($username, $password) {
        $query = "INSERT INTO " . $this->table_name . " (username, password) VALUES (:username, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT)); // Hashing the password

        return $stmt->execute();
    }

    public function viewProducts() {
        $query = "SELECT * FROM products"; // Adjust this to your products table
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
