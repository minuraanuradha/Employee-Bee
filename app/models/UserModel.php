<?php
require_once '../app/config/database.php';

class UserModel {
    private $pdo;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function createUser($data) {
        $stmt = $this->pdo->prepare("INSERT INTO employees (full_name, email, password, phone_number, current_job_title, current_employer) VALUES (:full_name, :email, :password, :phone_number, :current_job_title, :current_employer)");
        $stmt->execute([
            ':full_name' => $data['full_name'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':phone_number' => $data['phone_number'] ?? null,
            ':current_job_title' => $data['current_job_title'] ?? null,
            ':current_employer' => $data['current_employer'] ?? null
        ]);
        return $this->pdo->lastInsertId();
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM employees WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>