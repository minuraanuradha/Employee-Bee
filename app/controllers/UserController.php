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
                $_SESSION['signup_error'] = "Email already exists. Please use a different email.";
                header("Location: ?path=signup/employee");
                exit();
            }

            // Check if NIC already exists
            if ($this->model->nicExists($_POST['nic_or_national_id'])) {
                $_SESSION['signup_error'] = "NIC/National ID already exists. Please check your information.";
                header("Location: ?path=signup/employee");
                exit();
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
                // Handle profile picture upload (optional)
                'profile_picture' => null // Initialize as null
            ];
    
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                die("Invalid email format");
            }
    
            try {
                // Handle profile picture upload (optional)
                $profilePicPath = null;
                if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = __DIR__ . '/../../storage/uploads/employee/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    $fileName = uniqid('profile_') . '_' . basename($_FILES['profile_picture']['name']);
                    $targetFile = $uploadDir . $fileName;
                    if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFile)) {
                        $profilePicPath = 'storage/uploads/employee/' . $fileName;
                    }
                }
                $data['profile_picture'] = $profilePicPath ?? '/public/images/default-user.png';
                
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
            if (!$employee) {
                $_SESSION['error'] = "Employee profile not found.";
                header("Location: ?path=error");
                exit();
            }
            
            // Get employment history and career stats for the dashboard
            $employmentHistory = $this->model->getEmployeeHistory($employee['unique_id']);
            $careerStats = $this->model->getEmployeeCareerStats($employee['unique_id']);
            
            include '../resources/views/employee/index.php';
        }

    public function profileOverview() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employee') {
            header("Location: ?path=login");
            exit();
        }
        $employee = $this->model->getEmployeeById($_SESSION['user_id']);
        
        if (!$employee) {
            $_SESSION['error'] = "Employee profile not found.";
            header("Location: ?path=error");
            exit();
        }
        
        include '../resources/views/employee/profile-overview.php';
    }

    public function editProfile() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employee') {
            header("Location: ?path=login");
            exit();
        }
        $employee = $this->model->getEmployeeById($_SESSION['user_id']);
        
        if (!$employee) {
            $_SESSION['error'] = "Employee profile not found.";
            header("Location: ?path=error");
            exit();
        }
        
        include '../resources/views/employee/edit-profile.php';
    }
    
    public function updateProfile() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employee') {
            header("Location: ?path=login");
            exit();
        }
        
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            header("Location: ?path=employee/profile");
            exit();
        }

        // Validate required fields
        if (empty($_POST['full_name']) || empty($_POST['email'])) {
            $_SESSION['error'] = "Full name and email are required.";
            header("Location: ?path=employee/edit-profile");
            exit();
        }

        // Email validation
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Invalid email format.";
            header("Location: ?path=employee/edit-profile");
            exit();
        }

        // Get current employee data to preserve existing files if no new ones are uploaded
        $currentEmployee = $this->model->getEmployeeById($_SESSION['user_id']);
        
        $data = [
            'full_name' => trim($_POST['full_name']),
            'email' => trim($_POST['email']),
            'phone_number' => trim($_POST['phone_number'] ?? ''),
            'location' => trim($_POST['location'] ?? ''),
            'country' => $_POST['country'] ?? 'SL',
            'birthdate' => $_POST['birthdate'] ?? null,
            'nic_or_national_id' => trim($_POST['nic_or_national_id'] ?? ''),
            'linkedin_url' => trim($_POST['linkedin_url'] ?? ''),
            'portfolio_url' => trim($_POST['portfolio_url'] ?? ''),
            'skills' => trim($_POST['skills'] ?? ''),
            'education' => trim($_POST['education'] ?? ''),
            'profile_picture' => $currentEmployee['profile_picture'] ?? null,
            'resume_path' => $currentEmployee['resume_path'] ?? null
        ];

        // Handle profile picture upload
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../storage/uploads/employee/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $fileName = uniqid('profile_') . '_' . basename($_FILES['profile_picture']['name']);
            $targetFile = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFile)) {
                $data['profile_picture'] = 'storage/uploads/employee/' . $fileName;
            }
        }

        // Handle resume upload
        if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../storage/uploads/employee/resumes/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $fileName = uniqid('resume_') . '_' . basename($_FILES['resume']['name']);
            $targetFile = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['resume']['tmp_name'], $targetFile)) {
                $data['resume_path'] = 'storage/uploads/employee/resumes/' . $fileName;
            }
        }

        try {
            $this->model->updateEmployeeProfile($_SESSION['user_id'], $data);
            
            // Update session with new profile picture if uploaded
            if (isset($data['profile_picture']) && $data['profile_picture'] !== ($currentEmployee['profile_picture'] ?? null)) {
                $_SESSION['profile_picture'] = $data['profile_picture'];
            }
            
            $_SESSION['success'] = "Employee profile updated successfully!";
            header("Location: /Employee-Bee/public/?path=employee/profile");
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = "Error updating profile: " . $e->getMessage();
            header("Location: /Employee-Bee/public/?path=employee/edit-profile");
            exit();
        }
    }

    public function downloadResume() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employee') {
            header("Location: ?path=login");
            exit();
        }

        $employee = $this->model->getEmployeeById($_SESSION['user_id']);
        
        if (!$employee || empty($employee['resume_path'])) {
            $_SESSION['error'] = "Resume not found.";
            header("Location: ?path=employee/profile");
            exit();
        }

        $filePath = __DIR__ . '/../../' . $employee['resume_path'];
        
        if (!file_exists($filePath)) {
            $_SESSION['error'] = "Resume file not found on server.";
            header("Location: ?path=employee/profile");
            exit();
        }

        // Get file info
        $fileName = basename($employee['resume_path']);
        $fileSize = filesize($filePath);
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Set appropriate content type
        $contentTypes = [
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];

        $contentType = $contentTypes[$fileExtension] ?? 'application/octet-stream';

        // Set headers for download
        header('Content-Type: ' . $contentType);
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Content-Length: ' . $fileSize);
        header('Cache-Control: no-cache, must-revalidate');
        header('Pragma: no-cache');

        // Output file
        readfile($filePath);
        exit();
    }

    public function viewResume() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employee') {
            header("Location: ?path=login");
            exit();
        }

        $employee = $this->model->getEmployeeById($_SESSION['user_id']);
        
        if (!$employee || empty($employee['resume_path'])) {
            $_SESSION['error'] = "Resume not found.";
            header("Location: ?path=employee/profile");
            exit();
        }

        $filePath = __DIR__ . '/../../' . $employee['resume_path'];
        
        if (!file_exists($filePath)) {
            $_SESSION['error'] = "Resume file not found on server.";
            header("Location: ?path=employee/profile");
            exit();
        }

        // Get file info
        $fileName = basename($employee['resume_path']);
        $fileSize = filesize($filePath);
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Set appropriate content type
        $contentTypes = [
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];

        $contentType = $contentTypes[$fileExtension] ?? 'application/octet-stream';

        // Set headers for viewing (inline)
        header('Content-Type: ' . $contentType);
        header('Content-Disposition: inline; filename="' . $fileName . '"');
        header('Content-Length: ' . $fileSize);
        header('Cache-Control: no-cache, must-revalidate');
        header('Pragma: no-cache');

        // Output file
        readfile($filePath);
        exit();
    }

    // Get employee history data
    public function getEmployeeHistory() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employee') {
            header("Location: ?path=login");
            exit();
        }

        $employee = $this->model->getEmployeeById($_SESSION['user_id']);
        if (!$employee) {
            $_SESSION['error'] = "Employee profile not found.";
            header("Location: ?path=error");
            exit();
        }

        // Get employment history
        $employmentHistory = $this->model->getEmployeeHistory($employee['unique_id']);
        $careerStats = $this->model->getEmployeeCareerStats($employee['unique_id']);
        $achievements = $this->model->getEmployeeAchievements($employee['unique_id']);
        $blockchainTransactions = $this->model->getEmployeeBlockchainTransactions($employee['unique_id']);

        // Get blockchain records
        require_once __DIR__ . '/BlockchainController.php';
        $blockchainController = new BlockchainController();
        $blockchainRecords = $blockchainController->verifyEmploymentHistory($employee['unique_id']);

        // Pass data to view
        include '../resources/views/employee/history.php';
    }

    // AJAX endpoint to get employee history data
    public function getEmployeeHistoryAjax() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employee') {
            echo json_encode(['success' => false, 'message' => 'Not authorized']);
            exit();
        }

        header('Content-Type: application/json');

        $employee = $this->model->getEmployeeById($_SESSION['user_id']);
        if (!$employee) {
            echo json_encode(['success' => false, 'message' => 'Employee not found']);
            exit();
        }

        try {
            $employmentHistory = $this->model->getEmployeeHistory($employee['unique_id']);
            $careerStats = $this->model->getEmployeeCareerStats($employee['unique_id']);
            $achievements = $this->model->getEmployeeAchievements($employee['unique_id']);
            $blockchainTransactions = $this->model->getEmployeeBlockchainTransactions($employee['unique_id']);

            echo json_encode([
                'success' => true,
                'data' => [
                    'employment_history' => $employmentHistory,
                    'career_stats' => $careerStats,
                    'achievements' => $achievements,
                    'blockchain_transactions' => $blockchainTransactions
                ]
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error fetching history: ' . $e->getMessage()]);
        }
        exit();
    }

    // AJAX endpoint to get blockchain verification
    public function getBlockchainVerificationAjax() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employee') {
            echo json_encode(['success' => false, 'message' => 'Not authorized']);
            exit();
        }

        header('Content-Type: application/json');

        $employee = $this->model->getEmployeeById($_SESSION['user_id']);
        if (!$employee) {
            echo json_encode(['success' => false, 'message' => 'Employee not found']);
            exit();
        }

        try {
            require_once __DIR__ . '/BlockchainController.php';
            $blockchainController = new BlockchainController();
            $blockchainRecords = $blockchainController->verifyEmploymentHistory($employee['unique_id']);

            echo json_encode([
                'success' => true,
                'blockchain_data' => $blockchainRecords
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error fetching blockchain data: ' . $e->getMessage()]);
        }
        exit();
    }

    // Export employee history as JSON/PDF
    public function exportEmployeeHistory() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employee') {
            header("Location: ?path=login");
            exit();
        }

        $format = $_GET['format'] ?? 'json';
        $employee = $this->model->getEmployeeById($_SESSION['user_id']);
        
        if (!$employee) {
            $_SESSION['error'] = "Employee profile not found.";
            header("Location: ?path=history");
            exit();
        }

        $employmentHistory = $this->model->getEmployeeHistory($employee['unique_id']);
        $careerStats = $this->model->getEmployeeCareerStats($employee['unique_id']);
        $achievements = $this->model->getEmployeeAchievements($employee['unique_id']);

        $exportData = [
            'employee_info' => [
                'name' => $employee['full_name'],
                'email' => $employee['email'],
                'unique_id' => $employee['unique_id'],
                'export_date' => date('Y-m-d H:i:s')
            ],
            'career_stats' => $careerStats,
            'employment_history' => $employmentHistory,
            'achievements' => $achievements
        ];

        if ($format === 'json') {
            header('Content-Type: application/json');
            header('Content-Disposition: attachment; filename="employment_history_' . $employee['unique_id'] . '.json"');
            echo json_encode($exportData, JSON_PRETTY_PRINT);
        } else {
            // For now, fallback to JSON. PDF export can be implemented later
            header('Content-Type: application/json');
            header('Content-Disposition: attachment; filename="employment_history_' . $employee['unique_id'] . '.json"');
            echo json_encode($exportData, JSON_PRETTY_PRINT);
        }
        exit();
    }
}
?>