<?php
require_once '../app/models/UserModel.php';

class UserController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function showSignup() {
        require_once '../resources/views/auth/signup_employee.php';
    }

    public function signup() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'full_name' => $_POST['fullName'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? '',
                'phone_number' => $_POST['phone_number'] ?? '',
                'national_id' => $_POST['national_id'] ?? '',
                'current_job_title' => $_POST['current_job_title'] ?? '',
                'current_employer' => $_POST['current_employer'] ?? '',
                'location' => $_POST['location'] ?? '',
                'professional_headline' => $_POST['professional_headline'] ?? '',
                'skills' => $_POST['skills'] ?? '',
                'linkedin_url' => $_POST['linkedin_url'] ?? '',
                'resume_path' => $_POST['resume_path'] ?? '',
                'education' => $_POST['education'] ?? '',
                'career_goals' => $_POST['career_goals'] ?? '',
                'portfolio_url' => $_POST['portfolio_url'] ?? '',
                'profile_picture' => '/public/images/default-user.png' // default for now
            ];
    
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                die("Invalid email format");
            }
    
            try {
                $lastId = $this->model->createUser($data);
                header("Location: ?path=login");
                exit();
            } catch (PDOException $e) {
                die("Error saving user: " . $e->getMessage());
            }
        }
    }
    

    public function profile() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employee') {
            header("Location: ?path=login");
            exit();
        }
        require_once '../resources/views/employee/index.php';
    }
}
?>