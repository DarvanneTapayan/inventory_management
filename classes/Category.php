<?php
class Category {
    private $conn;
    private $table_name = "categories"; // Your actual table name

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($category_name, $description) {
        $query = "INSERT INTO " . $this->table_name . " (category_name, description) VALUES (:category_name, :description)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category_name', $category_name);
        $stmt->bindParam(':description', $description);

        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE category_id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $category_name, $description) {
        $query = "UPDATE " . $this->table_name . " SET category_name = :category_name, description = :description WHERE category_id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category_name', $category_name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE category_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
?>
