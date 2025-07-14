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
            // Validate required fields
            $required_fields = ['full_name', 'email', 'password', 'nic_or_national_id'];
            foreach ($required_fields as $field) {
                if (empty($_POST[$field])) {
                    die("Missing required field: $field");
                }
            }

            // Check if email already exists
            if ($this->model->emailExists($_POST['email'])) {
                die("Email already exists. Please use a different email.");
            }

            // Check if NIC already exists
            if ($this->model->nicExists($_POST['nic_or_national_id'])) {
                die("NIC/National ID already exists. Please check your information.");
            }

            $data = [
                'full_name' => $_POST['full_name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? '',
                'nic_or_national_id' => $_POST['nic_or_national_id'] ?? '',
                'country' => $_POST['country'] ?? 'SL',
                'birthdate' => $_POST['birthdate'] ?? null,
                'phone_number' => $_POST['phone_number'] ?? '',
                'location' => $_POST['location'] ?? '',
                'linkedin_url' => $_POST['linkedin_url'] ?? '',
                'portfolio_url' => $_POST['portfolio_url'] ?? '',
                'resume_path' => $_POST['resume_path'] ?? '',
                'skills' => $_POST['skills'] ?? '',
                'education' => $_POST['education'] ?? '',
                'profile_picture' => '/public/images/default-user.png' // default for now
            ];
    
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                die("Invalid email format");
            }
    
            try {
                $employee_id = $this->model->createEmployee($data);
                
                // Get the created employee data to show success message
                $employee = $this->model->getEmployeeById($employee_id);
                
                // Set success message in session
                $_SESSION['signup_success'] = "Account created successfully! Your unique ID is: " . $employee['unique_id'];
                
                header("Location: ?path=login");
                exit();
            } catch (PDOException $e) {
                die("Error creating account: " . $e->getMessage());
            }
        }
    }
    
    public function profile() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employee') {
            header("Location: ?path=login");
            exit();
        }
        $employee = $this->model->getEmployeeById($_SESSION['user_id']);
        include '../resources/views/employee/index.php';
    }
    
    public function updateProfile() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employee') {
            header("Location: ?path=login");
            exit();
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'full_name' => $_POST['full_name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'phone_number' => $_POST['phone_number'] ?? '',
                'location' => $_POST['location'] ?? '',
                'linkedin_url' => $_POST['linkedin_url'] ?? '',
                'portfolio_url' => $_POST['portfolio_url'] ?? '',
                'skills' => $_POST['skills'] ?? '',
                'education' => $_POST['education'] ?? ''
            ];
            
            try {
                $this->model->updateEmployeeProfile($_SESSION['user_id'], $data);
                $_SESSION['update_success'] = "Profile updated successfully!";
                header("Location: ?path=profile-overview");
                exit();
            } catch (PDOException $e) {
                die("Error updating profile: " . $e->getMessage());
            }
        }
    }
}
?>