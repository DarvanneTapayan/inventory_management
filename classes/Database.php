<?php
class Database {
    private $conn;

    public function __construct($db_connection) {
        $this->conn = $db_connection; 
    }

    public function execute($query, $params = []) {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetchAll($query, $params = []) {
        $stmt = $this->execute($query, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchOne($query, $params = []) {
        $stmt = $this->execute($query, $params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function executeUpdate($query, $params = []) {
        $stmt = $this->execute($query, $params);
        return $stmt->rowCount(); 
    }
}
?>
