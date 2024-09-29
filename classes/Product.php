<?php
class Product {
    private $conn;
    private $table_name = "products"; // Your actual table name

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($product_name, $category_id, $description, $sku, $price, $quantity_in_stock, $reorder_level, $supplier_id) {
        $query = "INSERT INTO " . $this->table_name . " (product_name, category_id, description, sku, price, quantity_in_stock, reorder_level, supplier_id) VALUES (:product_name, :category_id, :description, :sku, :price, :quantity_in_stock, :reorder_level, :supplier_id)";
        
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':quantity_in_stock', $quantity_in_stock);
        $stmt->bindParam(':reorder_level', $reorder_level);
        $stmt->bindParam(':supplier_id', $supplier_id);

        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE product_id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $product_name, $description, $sku, $price, $quantity_in_stock, $reorder_level, $supplier_id) {
        $query = "UPDATE " . $this->table_name . " SET product_name = :product_name, description = :description, sku = :sku, price = :price, quantity_in_stock = :quantity_in_stock, reorder_level = :reorder_level, supplier_id = :supplier_id WHERE product_id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':quantity_in_stock', $quantity_in_stock);
        $stmt->bindParam(':reorder_level', $reorder_level);
        $stmt->bindParam(':supplier_id', $supplier_id);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE product_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
?>
