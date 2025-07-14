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
                'company_name' => $_POST['company_name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? '',
                'password_confirm' => $_POST['password_confirm'] ?? '',
                'industry' => $_POST['industry'] ?? '',
                'location' => $_POST['location'] ?? '',
                'company_size' => $_POST['company_size'] ?? '',
                'description' => $_POST['description'] ?? '',
                'website_url' => $_POST['website_url'] ?? '',
                'linkedin_url' => $_POST['linkedin_url'] ?? '',
                'contact_person' => $_POST['contact_person'] ?? '',
                'phone_number' => $_POST['phone_number'] ?? '',
                'business_registration_number' => $_POST['business_registration_number'] ?? ''
            ];

            // Password confirmation
            if ($data['password'] !== $data['password_confirm']) {
                $_SESSION['signup_error'] = "Passwords do not match";
                header("Location: ?path=signup/company");
                exit();
            }

            // Email validation
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['signup_error'] = "Invalid email format";
                header("Location: ?path=signup/company");
                exit();
            }

            // Handle logo upload (optional)
            $logoPath = null;
            if (isset($_FILES['logo_path']) && $_FILES['logo_path']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../storage/uploads/company/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $fileName = uniqid('logo_') . '_' . basename($_FILES['logo_path']['name']);
                $targetFile = $uploadDir . $fileName;
                if (move_uploaded_file($_FILES['logo_path']['tmp_name'], $targetFile)) {
                    $logoPath = 'storage/uploads/company/' . $fileName;
                }
            }
            $data['logo_path'] = $logoPath;

            // Hash password
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            unset($data['password_confirm']);

            try {
                $company_id = $this->model->createCompany($data);
                $_SESSION['signup_success'] = "Company account created successfully! You can now log in.";
                header("Location: ?path=login");
                exit();
            } catch (PDOException $e) {
                $_SESSION['signup_error'] = "Error creating company account: " . $e->getMessage();
                header("Location: ?path=signup/company");
                exit();
            }
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