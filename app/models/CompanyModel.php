<?php
require_once '../app/config/database.php';

class CompanyModel {
    private $pdo;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function createCompany($data) {
        $stmt = $this->pdo->prepare("INSERT INTO company_profile (
            company_name, email, password, industry, location, company_size, description, website_url, linkedin_url, contact_person, phone_number, business_registration_number, logo_path
        ) VALUES (
            :company_name, :email, :password, :industry, :location, :company_size, :description, :website_url, :linkedin_url, :contact_person, :phone_number, :business_registration_number, :logo_path
        )");
        $stmt->execute([
            ':company_name' => $data['company_name'],
            ':email' => $data['email'],
            ':password' => $data['password'],
            ':industry' => $data['industry'] ?? null,
            ':location' => $data['location'] ?? null,
            ':company_size' => $data['company_size'] ?? null,
            ':description' => $data['description'] ?? null,
            ':website_url' => $data['website_url'] ?? null,
            ':linkedin_url' => $data['linkedin_url'] ?? null,
            ':contact_person' => $data['contact_person'] ?? null,
            ':phone_number' => $data['phone_number'] ?? null,
            ':business_registration_number' => $data['business_registration_number'] ?? null,
            ':logo_path' => $data['logo_path'] ?? null
        ]);
        return $this->pdo->lastInsertId();
    }

    public function getCompanyByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM company_profile WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getById($companyId) {
        $stmt = $this->pdo->prepare("SELECT * FROM company_profile WHERE id = :id");
        $stmt->execute(['id' => $companyId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE company_profile SET
            company_name = :company_name,
            email = :email,
            industry = :industry,
            location = :location,
            company_size = :company_size,
            description = :description,
            website_url = :website_url,
            linkedin_url = :linkedin_url,
            contact_person = :contact_person,
            phone_number = :phone_number,
            business_registration_number = :business_registration_number,
            logo_path = :logo_path
            WHERE id = :id
        ");
        $stmt->execute([
            ':company_name' => $data['company_name'],
            ':email' => $data['email'],
            ':industry' => $data['industry'],
            ':location' => $data['location'],
            ':company_size' => $data['company_size'],
            ':description' => $data['description'],
            ':website_url' => $data['website_url'],
            ':linkedin_url' => $data['linkedin_url'],
            ':contact_person' => $data['contact_person'],
            ':phone_number' => $data['phone_number'],
            ':business_registration_number' => $data['business_registration_number'],
            ':logo_path' => $data['logo_path'],
            ':id' => $id
        ]);
    }
}
?>
