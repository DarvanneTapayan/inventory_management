<?php
class User {
    private $conn;
    private $table_name = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new user
    public function create($username, $password, $email, $role_id) {
        $query = "INSERT INTO " . $this->table_name . " (username, password, email, role_id) VALUES (:username, :password, :email, :role_id)";
        $stmt = $this->conn->prepare($query);

        // Hash the password before storing
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role_id', $role_id);

        return $stmt->execute();
    }

    // User login
    public function login($username, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password'])) {
                return $row; // Return user data if login is successful
            }
        }
        return null; // Return null if login fails
    }

    // Check if user has a specific role
    public function hasRole($user_id, $role_name) {
        $query = "SELECT r.role_name FROM " . $this->table_name . " u
                  JOIN roles r ON u.role_id = r.role_id
                  WHERE u.user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $row['role_name'] === $role_name;
        }
        return false;
    }
    
    // Fetch a user by ID
    public function readById($user_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
