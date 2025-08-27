<?php
require_once __DIR__ . '/../config/database.php';

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
    
    // Get all companies with optional search
    public function getAllCompanies($search = null) {
        $sql = "SELECT * FROM company_profile";
        $params = [];
        
        if ($search) {
            $sql .= " WHERE company_name LIKE :search OR industry LIKE :search OR location LIKE :search";
            $params[':search'] = '%' . $search . '%';
        }
        
        $sql .= " ORDER BY company_name ASC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Get company statistics (active/inactive members count)
    public function getCompanyStats($companyId) {
        $stmt = $this->pdo->prepare("
            SELECT
                COUNT(CASE WHEN status = 'active' THEN 1 END) as active_members,
                COUNT(CASE WHEN status IN ('inactive', 'resigned', 'terminated') THEN 1 END) as inactive_members
            FROM company_employees
            WHERE company_id = :company_id
        ");
        $stmt->execute([':company_id' => $companyId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Get total employee count for a company
    public function getTotalEmployeeCount($companyId) {
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*) as total_employees
            FROM company_employees
            WHERE company_id = :company_id
        ");
        $stmt->execute([':company_id' => $companyId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_employees'] ?? 0;
    }
    
    // Get active employee count for a company
    public function getActiveEmployeeCount($companyId) {
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*) as active_employees
            FROM company_employees
            WHERE company_id = :company_id AND status = 'active'
        ");
        $stmt->execute([':company_id' => $companyId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['active_employees'] ?? 0;
    }
    
    // Get inactive employee count for a company
    public function getInactiveEmployeeCount($companyId) {
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*) as inactive_employees
            FROM company_employees
            WHERE company_id = :company_id AND status IN ('inactive', 'resigned', 'terminated')
        ");
        $stmt->execute([':company_id' => $companyId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['inactive_employees'] ?? 0;
    }
    
    // Get new employees count for this month for a company
    public function getNewEmployeesThisMonth($companyId) {
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*) as new_employees
            FROM company_employees
            WHERE company_id = :company_id
            AND YEAR(start_date) = YEAR(CURDATE())
            AND MONTH(start_date) = MONTH(CURDATE())
        ");
        $stmt->execute([':company_id' => $companyId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['new_employees'] ?? 0;
    }
    
    // Get most common roles for a company
    public function getMostCommonRoles($companyId) {
        $stmt = $this->pdo->prepare("
            SELECT role_title, COUNT(*) as count
            FROM company_employees
            WHERE company_id = :company_id
            GROUP BY role_title
            ORDER BY count DESC
            LIMIT 10
        ");
        $stmt->execute([':company_id' => $companyId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Get employee growth trend data (monthly count for last 6 months)
    public function getEmployeeGrowthTrend($companyId) {
        $stmt = $this->pdo->prepare("
            SELECT
                DATE_FORMAT(start_date, '%Y-%m') as month,
                COUNT(*) as count
            FROM company_employees
            WHERE company_id = :company_id
            AND start_date >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
            GROUP BY DATE_FORMAT(start_date, '%Y-%m')
            ORDER BY month ASC
        ");
        $stmt->execute([':company_id' => $companyId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
