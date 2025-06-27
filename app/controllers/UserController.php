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
                'current_job_title' => $_POST['current_job_title'] ?? '',
                'current_employer' => $_POST['current_employer'] ?? ''
            ];

            console_log("Signup data: " . json_encode($data), 'debug');

            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                die("Invalid email format");
            }

            try {
                $lastId = $this->model->createUser($data);
                console_log("User created with ID: {$lastId}", 'info');
                header("Location: ?path=login");
                exit();
            } catch (PDOException $e) {
                console_log("Database error: " . $e->getMessage(), 'error');
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