<?php
require_once '../app/models/CompanyModel.php';

class CompanyController {
    private $model;

    public function __construct() {
        $this->model = new CompanyModel();
    }

    public function showSignup() {
        require_once '../views/signup_company.php';
    }

    public function signup() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'company_name' => $_POST['companyName'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? '',
                'industry' => $_POST['industry'] ?? '',
                'location' => $_POST['location'] ?? '',
                'contact_person' => $_POST['contact_person'] ?? '',
                'phone_number' => $_POST['phone_number'] ?? ''
            ];

            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                die("Invalid email format");
            }

            $this->model->createCompany($data);
            header("Location: ?controller=auth&action=showLogin");
            exit();
        }
    }

    public function profile() {
        if (!isset($_SESSION['company_id']) || $_SESSION['role'] !== 'company') {
            header("Location: ?controller=auth&action=showLogin");
            exit();
        }
        echo "Company Profile Page - Company ID: " . $_SESSION['company_id']; // Replace with actual profile view
    }
}
?>