<?php
class Product {
    private $conn;
    private $table_name = "products";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new product
    public function create($product_name, $description, $sku, $price, $quantity_in_stock, $category_id) {
        $query = "INSERT INTO " . $this->table_name . " (product_name, description, sku, price, quantity_in_stock, category_id) 
                  VALUES (:product_name, :description, :sku, :price, :quantity_in_stock, :category_id)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':quantity_in_stock', $quantity_in_stock);
        $stmt->bindParam(':category_id', $category_id);

        return $stmt->execute();
    }

    // Read all products
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read one product by ID
    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE product_id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a product
    public function update($id, $product_name, $description, $sku, $price, $quantity_in_stock, $category_id) {
        $query = "UPDATE " . $this->table_name . " SET 
                  product_name = :product_name, 
                  description = :description, 
                  sku = :sku, 
                  price = :price, 
                  quantity_in_stock = :quantity_in_stock, 
                  category_id = :category_id 
                  WHERE product_id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':quantity_in_stock', $quantity_in_stock);
        $stmt->bindParam(':category_id', $category_id);

        return $stmt->execute();
    }

    // Delete a product
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE product_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
