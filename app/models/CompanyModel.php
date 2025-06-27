<?php
require_once '../app/config/database.php';

class CompanyModel {
    private $pdo;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function createCompany($data) {
        $stmt = $this->pdo->prepare("INSERT INTO companies (company_name, email, password, industry, location, contact_person, phone_number) VALUES (:company_name, :email, :password, :industry, :location, :contact_person, :phone_number)");
        $stmt->execute([
            ':company_name' => $data['company_name'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':industry' => $data['industry'] ?? null,
            ':location' => $data['location'] ?? null,
            ':contact_person' => $data['contact_person'] ?? null,
            ':phone_number' => $data['phone_number'] ?? null
        ]);
        return $this->pdo->lastInsertId();
    }

    public function getCompanyByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM companies WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>