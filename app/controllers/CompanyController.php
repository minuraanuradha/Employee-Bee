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
        $companyId = $_SESSION['company_id'] ?? 1;
        $companyModel = new CompanyModel();
        $company = $companyModel->getById($companyId);
    
        if (!$company) {
            // Handle case where company is not found
            $_SESSION['error'] = "Company profile not found.";
            header("Location: ?path=error"); // Redirect to an error page or login
            exit();
        }
    
        require '../resources/views/company/profile-overview.php';
    }

    public function editProfile() {
        $companyId = $_SESSION['company_id'] ?? 1;
        $companyModel = new CompanyModel();
        $company = $companyModel->getById($companyId);
    
        if (!$company) {
            $_SESSION['error'] = "Company profile not found.";
            header("Location: ?path=error");
            exit();
        }
    
        require '../resources/views/company/edit-profile.php';
    }

    public function searchEmployees() {
        $query = $_GET['q'] ?? '';
        $company_id = $_SESSION['company_id'] ?? null;
        $userModel = new UserModel();
        $results = $userModel->searchEmployees($query, $company_id);
        header('Content-Type: application/json');
        echo json_encode($results);
        exit();
    }

    public function updateProfile() {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            header("Location: ?path=company/profile");
            exit();
        }

        $companyId = $_SESSION['company_id'] ?? 1;
        
        // Validate required fields
        if (empty($_POST['company_name']) || empty($_POST['email'])) {
            $_SESSION['error'] = "Company name and email are required.";
            header("Location: ?path=company/edit-profile");
            exit();
        }

        // Email validation
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Invalid email format.";
            header("Location: ?path=company/edit-profile");
            exit();
        }

        // Get current company data to preserve existing logo if no new one is uploaded
        $currentCompany = $this->model->getById($companyId);
        
        $data = [
            'company_name' => trim($_POST['company_name']),
            'email' => trim($_POST['email']),
            'industry' => trim($_POST['industry'] ?? ''),
            'location' => trim($_POST['location'] ?? ''),
            'company_size' => $_POST['company_size'] ?? '',
            'description' => trim($_POST['description'] ?? ''),
            'website_url' => trim($_POST['website_url'] ?? ''),
            'linkedin_url' => trim($_POST['linkedin_url'] ?? ''),
            'contact_person' => trim($_POST['contact_person'] ?? ''),
            'phone_number' => trim($_POST['phone_number'] ?? ''),
            'business_registration_number' => trim($_POST['business_registration_number'] ?? ''),
            'logo_path' => $currentCompany['logo_path'] ?? null // Preserve existing logo
        ];

        // Handle logo upload
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../storage/uploads/company/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $fileName = uniqid('logo_') . '_' . basename($_FILES['logo']['name']);
            $targetFile = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['logo']['tmp_name'], $targetFile)) {
                $data['logo_path'] = 'storage/uploads/company/' . $fileName;
            }
        }

        try {
            $this->model->update($companyId, $data);
            
            // Update session with new logo path if logo was uploaded
            if (isset($data['logo_path']) && $data['logo_path'] !== ($currentCompany['logo_path'] ?? null)) {
                $_SESSION['logo_path'] = $data['logo_path'];
                $_SESSION['company_logo'] = $data['logo_path']; // For navbar
            }
            
            $_SESSION['success'] = "Company profile updated successfully!";
            header("Location: ?path=company/profile");
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = "Error updating profile: " . $e->getMessage();
            header("Location: ?path=company/edit-profile");
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = "Database error updating profile: " . $e->getMessage();
            header("Location: ?path=company/edit-profile");
            exit();
        }
    }

    public function addEmployeeAjax() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method not allowed']);
            exit();
        }
        header('Content-Type: application/json');
        $company_id = $_SESSION['company_id'] ?? null;
        if (!$company_id) {
            echo json_encode(['success' => false, 'message' => 'Not authorized.']);
            exit();
        }
        $unique_id = $_POST['unique_id'] ?? '';
        $role_title = trim($_POST['role_title'] ?? '');
        $skills_on_hire = trim($_POST['skills_on_hire'] ?? '');
        $start_date = trim($_POST['start_date'] ?? '');
        if (!$unique_id || !$role_title || !$start_date) {
            echo json_encode(['success' => false, 'message' => 'All fields are required.']);
            exit();
        }
        // Add employee to company (prevent duplicates)
        $userModel = new UserModel();
        $result = $userModel->addEmployeeToCompany($company_id, $unique_id, $role_title, $skills_on_hire, $start_date);
        echo json_encode($result);
        exit();
    }
}
?>

