<?php
class Order {
    private $conn;
    private $table_name = "orders"; 

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new order
    public function create($customer_id, $total_amount) {
        $query = "INSERT INTO " . $this->table_name . " (customer_id, total_amount) VALUES (:customer_id, :total_amount)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':customer_id', $customer_id);
        $stmt->bindParam(':total_amount', $total_amount);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId(); // Return the last inserted order ID
        }
        return false; // Return false if there was an error
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE order_id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $customer_id, $total_amount) {
        $query = "UPDATE " . $this->table_name . " SET customer_id = :customer_id, total_amount = :total_amount WHERE order_id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':customer_id', $customer_id);
        $stmt->bindParam(':total_amount', $total_amount);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE order_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function addOrderItem($order_id, $product_id, $quantity, $price) {
        $query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':price', $price);
    
        return $stmt->execute();
    }
    
}
?>
