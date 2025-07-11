<?php
require_once '../app/config/database.php';

class UserModel {
    private $pdo;

    // Connect to the database
    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    // Create a new user
    public function createUser($data) {
        // Generate BEE ID
        $bee_id = $this->generateBeeID($data['national_id']);
    
        $stmt = $this->pdo->prepare("INSERT INTO employees (
            bee_id, full_name, email, password, phone_number, national_id,
            current_job_title, current_employer, location, professional_headline,
            skills, linkedin_url, resume_path, education, career_goals, portfolio_url, profile_picture
        ) VALUES (
            :bee_id, :full_name, :email, :password, :phone_number, :national_id,
            :current_job_title, :current_employer, :location, :professional_headline,
            :skills, :linkedin_url, :resume_path, :education, :career_goals, :portfolio_url, :profile_picture
        )");
    
        $stmt->execute([
            ':bee_id' => $bee_id,
            ':full_name' => $data['full_name'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':phone_number' => $data['phone_number'] ?? null,
            ':national_id' => $data['national_id'] ?? null,
            ':current_job_title' => $data['current_job_title'] ?? null,
            ':current_employer' => $data['current_employer'] ?? null,
            ':location' => $data['location'] ?? null,
            ':professional_headline' => $data['professional_headline'] ?? null,
            ':skills' => $data['skills'] ?? null,
            ':linkedin_url' => $data['linkedin_url'] ?? null,
            ':resume_path' => $data['resume_path'] ?? null,
            ':education' => $data['education'] ?? null,
            ':career_goals' => $data['career_goals'] ?? null,
            ':portfolio_url' => $data['portfolio_url'] ?? null,
            ':profile_picture' => $data['profile_picture'] ?? null
        ]);
    
        return $this->pdo->lastInsertId();
    }
       
    // Get a user by email
    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM employees WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get a user by ID
    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM employees WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    // Generate BEE ID
    private function generateBeeID($national_id) {
        $nic_part = substr($national_id, -4);
        return 'BEE-SL' . $nic_part;
    }
}
?>