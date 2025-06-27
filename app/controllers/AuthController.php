<?php
//session_start();
require_once '../app/models/UserModel.php';
require_once '../app/models/CompanyModel.php';
class AuthController {
    private $userModel;
    private $companyModel;

    public function __construct() {
        $this->userModel = new UserModel();
        $this->companyModel = new CompanyModel();
    }

    public function showLogin() {
        require_once '../resources/views/auth/login.php';
    }

    public function login() {
        // Clear existing session data to prevent role conflicts
        unset($_SESSION['user_id']);
        unset($_SESSION['company_id']);
        unset($_SESSION['role']);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                die("Invalid email format");
            }

            $user = $this->userModel->getUserByEmail($email);
            $company = $this->companyModel->getCompanyByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = 'employee';
                header("Location: ?path=profile");
                exit();
            } elseif ($company && password_verify($password, $company['password'])) {
                $_SESSION['company_id'] = $company['id'];
                $_SESSION['role'] = 'company';
                header("Location: ?path=profile");
                exit();
            } else {
                echo "Invalid email or password";
            }
        }
    }

    public function logout() {
        session_destroy();
        header("Location: ?path=login");
        exit();
    }
}
?>