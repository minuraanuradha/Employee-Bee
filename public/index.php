<?php
   require_once __DIR__ . '/../vendor/autoload.php';
   $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
   $dotenv->load();
// Start the session to manage user authentication state
session_start();

// Enable debug mode (set to false for production to disable logging)
$debugMode = true; //false

// Helper function: Logs messages to browser console for debugging
function console_log($message, $level = 'log')
{
    // Access global debug mode setting
    global $debugMode;
    // Skip logging if debug mode is disabled
    if (!$debugMode) return;
    // Get current timestamp for log
    $timestamp = date('Y-m-d H:i:s');
    // Validate log level, default to 'log' if invalid
    $validLevels = ['log', 'warn', 'error', 'info'];
    $level = in_array($level, $validLevels) ? $level : 'log';
    // Output JavaScript console log with timestamp
    echo "<script>console.{$level}('[{$timestamp}] {$message}');</script>";
}

// Remove or comment out all console_log() calls before AJAX/JSON endpoints
// Parse and clean the request URI path
$rawPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = '/' . trim($rawPath, '/');

// Get the base path of the application (e.g., /Employee-Bee/public)
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
// Store base path for URL construction
$baseURL = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'); // gives: /Employee-Bee/public

// Remove base path from the URL to get the route
if (stripos($path, $basePath) === 0) {
    $path = substr($path, strlen($basePath));
    $path = trim($path, '/');
}

// Override path with query parameter if provided
if (isset($_GET['path'])) {
    $path = $_GET['path'];
    // REMOVE: console_log("Overridden path from query: {$path}", 'debug');
} else {
    // REMOVE: console_log("Using default path: {$path}", 'debug');
}

// Initialize variables for page title, content, and layout
$title = '';
$content = '';
$layout = 'main'; // Default layout

// Include required models and controllers
require_once __DIR__ . '/../app/config/database.php';
require_once __DIR__ . '/../app/models/UserModel.php';
require_once __DIR__ . '/../app/models/CompanyModel.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/UserController.php';
require_once __DIR__ . '/../app/controllers/CompanyController.php';

// Instantiate controllers for handling requests
$authController = new AuthController();
$userController = new UserController();
$companyController = new CompanyController();

// Route handling based on the cleaned path
switch ($path) {
    // Home page routes
    case '':
    case 'home':
        $title = 'Home';
        // Load home view or display error if file is missing
        $homePath = __DIR__ . '/../resources/views/pages/home.php';
        $content = file_exists($homePath) ? include_and_capture($homePath) : '<h1>Home file not found</h1>';
        break;

    // Companies page
    case 'companies':
        $title = 'Companies';
        // Load companies view or display error if file is missing
        $homePath = __DIR__ . '/../resources/views/pages/Companies.php';
        $content = file_exists($homePath) ? include_and_capture($homePath) : '<h1>Companies file not found</h1>';
        break;

    // About Us page
    case 'about-us':
        $title = 'About Us';
        // Load About view or display error if file is missing
        $homePath = __DIR__ . '/../resources/views/pages/about.php';
        $content = file_exists($homePath) ? include_and_capture($homePath) : '<h1>About Us file not found</h1>';
        break;

    // Help page
    case 'help':
        $title = 'Help';
        // Load help view or display error if file is missing
        $homePath = __DIR__ . '/../resources/views/pages/help.php';
        $content = file_exists($homePath) ? include_and_capture($homePath) : '<h1>Help page file not found</h1>';
        break;

    // Blockchain test page
    case 'test/blockchain_test':
        $title = 'Blockchain Integration Test';
        $content = include_and_capture(__DIR__ . '/../resources/views/test/blockchain_test.php');
        $layout = 'simple';
        break;

    // Simple blockchain test page
    case 'test/simple_blockchain_test':
        $title = 'Simple Blockchain Test';
        $content = include_and_capture(__DIR__ . '/../resources/views/test/simple_blockchain_test.php');
        $layout = 'simple';
        break;

    // AI test page
    case 'test/ai_test':
        $title = 'AI Service Test';
        $content = include_and_capture(__DIR__ . '/../resources/views/test/ai_test.php');
        $layout = 'simple';
        break;

    // Test local AI model service
    case 'test/local_ai_service':
        $title = 'Test Local AI Model Service';
        $content = include_and_capture(__DIR__ . '/../test_local_ai_service.php');
        $layout = 'simple';
        break;

    // Login page
    case 'login':
        $title = 'Login';
        // Handle POST request for login or display login form
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $authController->login();
        } else {
            $content = include_and_capture(__DIR__ . '/../resources/views/auth/login.php');
            $layout = 'simple'; // Use simple layout for login
        }
        break;

    // Signup page
    case 'signup':
        $title = 'Sign Up';
        // Load signup view
        $content = include_and_capture(__DIR__ . '/../resources/views/auth/signup.php');
        $layout = 'simple'; // Use simple layout for signup
        break;

    // Employee signup page
    case 'signup/employee':
        $title = 'Sign Up - Employee';
        // Handle POST request for employee signup or display form
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userController->signup();
        } else {
            $content = include_and_capture(__DIR__ . '/../resources/views/auth/signup_employee.php');
            $layout = 'simple'; // Use simple layout for employee signup
        }
        break;

    // Company signup page
    case 'signup/company':
        $title = 'Sign Up - Company';
        // Handle POST request for company signup or display form
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $companyController->signup();
        } else {
            $content = include_and_capture(__DIR__ . '/../resources/views/auth/signup_company.php');
            $layout = 'simple'; // Use simple layout for company signup
        }
        break;

    // Employee dashboard
    case 'employee':
        // Restrict access to logged-in employees
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'employee' && isset($_SESSION['user_id'])) {
            $title = 'Employee Dashboard';
            // Get employee data for the view
            $userModel = new UserModel();
            $employee = $userModel->getEmployeeById($_SESSION['user_id']);
            if ($employee) {
                $employmentHistory = $userModel->getEmployeeHistory($employee['unique_id']);
                $careerStats = $userModel->getEmployeeCareerStats($employee['unique_id']);
            } else {
                // Initialize variables with default values if employee not found
                $employee = [];
                $employmentHistory = [];
                $careerStats = [];
            }
            // Debug: Print variables to see what's being passed
            error_log("Employee Dashboard - Employee: " . print_r($employee, true));
            error_log("Employee Dashboard - Employment History: " . print_r($employmentHistory, true));
            error_log("Employee Dashboard - Career Stats: " . print_r($careerStats, true));
            $content = include_and_capture(__DIR__ . '/../resources/views/employee/index.php');
            $layout = 'profile_dashboard';
        } else {
            // Redirect to login if not authorized
            header("Location: ?path=login");
            exit();
        }
        break;

        case 'employee/profile':
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'employee' && isset($_SESSION['user_id'])) {
                $title = 'Employee Profile';
                $userModel = new UserModel();
                $employee = $userModel->getEmployeeById($_SESSION['user_id']);
                ob_start();
                include __DIR__ . '/../resources/views/employee/profile-overview.php';
                $content = ob_get_clean();
                $layout = 'profile_dashboard';
            } else {
                header("Location: ?path=login"); exit();
            }
            break;

    // Navigation after login
    case 'profile':
        // Log session details for debugging
        // REMOVE: console_log("Checking session for profile: role=" . ($_SESSION['role'] ?? 'none') . ", user_id=" . ($_SESSION['user_id'] ?? 'none') . ", company_id=" . ($_SESSION['company_id'] ?? 'none'), 'debug');
        // Check if user is logged in
        if (isset($_SESSION['role'])) {
            // Handle employee profile
            if ($_SESSION['role'] == 'employee' && isset($_SESSION['user_id'])) {
                $title = 'Employee Profile';
                // Get employee data for the view
                $userModel = new UserModel();
                $employee = $userModel->getEmployeeById($_SESSION['user_id']);
                if ($employee) {
                    $employmentHistory = $userModel->getEmployeeHistory($employee['unique_id']);
                    $careerStats = $userModel->getEmployeeCareerStats($employee['unique_id']);
                } else {
                    // Initialize variables with default values if employee not found
                    $employee = [];
                    $employmentHistory = [];
                    $careerStats = [];
                }
                // Debug: Print variables to see what's being passed
                error_log("Employee Profile - Employee: " . print_r($employee, true));
                error_log("Employee Profile - Employment History: " . print_r($employmentHistory, true));
                error_log("Employee Profile - Career Stats: " . print_r($careerStats, true));
                $content = include_and_capture(__DIR__ . '/../resources/views/employee/index.php');
                $layout = 'profile_dashboard'; // Use dashboard layout for employee
            // Handle company profile
            } elseif ($_SESSION['role'] == 'company' && isset($_SESSION['company_id'])) {
                $title = 'Company Profile';
                $content = include_and_capture(__DIR__ . '/../resources/views/company/index.php');
                $layout = 'company_dashboard';
            } else {
                // Redirect to login if session data is invalid
                header("Location: ?path=login");
                exit();
            }
        } else {
            // Redirect to login if no session
            header("Location: ?path=login");
            exit();
        }
        break;

    // Employee history page
    case 'history':
        // Restrict access to logged-in employees
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'employee' && isset($_SESSION['user_id'])) {
            $title = 'Employee History';
            // Get employee data for the view
            $userModel = new UserModel();
            $employee = $userModel->getEmployeeById($_SESSION['user_id']);
            if ($employee) {
                $employmentHistory = $userModel->getEmployeeHistory($employee['unique_id']);
                $careerStats = $userModel->getEmployeeCareerStats($employee['unique_id']);
                $achievements = $userModel->getEmployeeAchievements($employee['unique_id']);
                $blockchainTransactions = $userModel->getEmployeeBlockchainTransactions($employee['unique_id']);
                
                // Get blockchain records
                require_once __DIR__ . '/../app/controllers/BlockchainController.php';
                $blockchainController = new BlockchainController();
                $blockchainRecords = $blockchainController->verifyEmploymentHistory($employee['unique_id']);
            }
            $content = include_and_capture(__DIR__ . '/../resources/views/employee/history.php');
            $layout = 'profile_dashboard';
        } else {
            // Redirect to login if not authorized
            header("Location: ?path=login");
            exit();
        }
        break;

    // Employee history AJAX data
    case 'employee/history-data':
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'employee' && isset($_SESSION['user_id'])) {
            $userController->getEmployeeHistoryAjax();
        } else {
            header('HTTP/1.1 403 Forbidden');
            echo json_encode(['success' => false, 'message' => 'Not authorized.']);
            exit();
        }
        break;

    // Employee blockchain verification AJAX
    case 'employee/blockchain-verification':
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'employee' && isset($_SESSION['user_id'])) {
            $userController->getBlockchainVerificationAjax();
        } else {
            header('HTTP/1.1 403 Forbidden');
            echo json_encode(['success' => false, 'message' => 'Not authorized.']);
            exit();
        }
        break;

    // Employee history export
    case 'employee/export-history':
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'employee' && isset($_SESSION['user_id'])) {
            $userController->exportEmployeeHistory();
        } else {
            header("Location: ?path=login");
            exit();
        }
        break;

    // Employee career insights page
    case 'insights':
        // Restrict access to logged-in employees
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'employee' && isset($_SESSION['user_id'])) {
            $title = 'Career Insights';
            $content = include_and_capture(__DIR__ . '/../resources/views/employee/insights.php');
            $layout = 'profile_dashboard';
        } else {
            // Redirect to login if not authorized
            header("Location: ?path=login");
            exit();
        }
        break;

    // Employee settings page
    case 'settings':
        // Restrict access to logged-in employees
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'employee' && isset($_SESSION['user_id'])) {
            $title = 'Settings';
            $content = include_and_capture(__DIR__ . '/../resources/views/employee/settings.php');
            $layout = 'profile_dashboard';
        } else {
            // Redirect to login if not authorized
            header("Location: ?path=login");
            exit();
        }
        break;

    // Employee profile overview page
    case 'profile-overview':
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'employee' && isset($_SESSION['user_id'])) {
            $title = 'My Profile';
            $userModel = new UserModel();
            $employee = $userModel->getEmployeeById($_SESSION['user_id']);
            ob_start();
            include __DIR__ . '/../resources/views/employee/profile-overview.php';
            $content = ob_get_clean();
            $layout = 'profile_dashboard';
        } else {
            header("Location: ?path=login");
            exit();
        }
        break;

    // Employee edit profile page
    case 'employee/edit-profile':
        // Restrict access to logged-in employees
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'employee' && isset($_SESSION['user_id'])) {
            $title = 'Edit Employee Profile';
            // Fetch employee data
            $userModel = new UserModel();
            $employee = $userModel->getEmployeeById($_SESSION['user_id']);
            // Capture edit profile view output
            ob_start();
            include __DIR__ . '/../resources/views/employee/edit-profile.php';
            $content = ob_get_clean();
            $layout = 'profile_dashboard';
        } else {
            // Redirect to login if not authorized
            header("Location: ?path=login");
            exit();
        }
        break;

    // Employee update profile
    case 'employee/updateProfile':
        // Restrict access to logged-in employees
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'employee' && isset($_SESSION['user_id'])) {
            // Handle POST request for profile update
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $userController->updateProfile();
            } else {
                // Redirect to profile if not a POST request
                header("Location: ?path=employee/profile-overview");
                exit();
            }
        } else {
            // Redirect to login if not authorized
            header("Location: ?path=login");
            exit();
        }
        break;

    // Update employee profile
    case 'update-profile':
        // Restrict access to logged-in employees
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'employee' && isset($_SESSION['user_id'])) {
            // Handle POST request for profile update
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $userController->updateProfile();
            } else {
                // Redirect to profile if not a POST request
                header("Location: ?path=profile-overview");
                exit();
            }
        } else {
            // Redirect to login if not authorized
            header("Location: ?path=login");
            exit();
        }
        break;

    // Employee resume download
    case 'employee/download-resume':
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'employee' && isset($_SESSION['user_id'])) {
            $userController->downloadResume();
        } else {
            header("Location: ?path=login");
            exit();
        }
        break;

    // Employee resume view
    case 'employee/view-resume':
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'employee' && isset($_SESSION['user_id'])) {
            $userController->viewResume();
        } else {
            header("Location: ?path=login");
            exit();
        }
        break;

    // Logout route
    case 'logout':
        // Destroy session and redirect to login
        session_destroy();
        header("Location: ?path=login");
        exit();
        break;

    // Company dashboard
    case 'company':
    case 'company/dashboard':
        // Restrict access to logged-in companies
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'company' && isset($_SESSION['company_id'])) {
            $title = 'Dashboard';
            // Get company stats
            $companyModel = new CompanyModel();
            $companyId = $_SESSION['company_id'];
            $totalEmployees = $companyModel->getTotalEmployeeCount($companyId);
            $activeEmployees = $companyModel->getActiveEmployeeCount($companyId);
            $inactiveEmployees = $companyModel->getInactiveEmployeeCount($companyId);
            $newEmployeesThisMonth = $companyModel->getNewEmployeesThisMonth($companyId);
            $mostCommonRoles = $companyModel->getMostCommonRoles($companyId);
            $employeeGrowthTrend = $companyModel->getEmployeeGrowthTrend($companyId);
            ob_start();
            include __DIR__ . '/../resources/views/company/index.php';
            $content = ob_get_clean();
            $layout = 'company_dashboard';
        } else {
            // Redirect to login if not authorized
            header("Location: ?path=login");
            exit();
        }
        break;

    // Company profile page
    case 'company/profile':
        // Restrict access to logged-in companies
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'company' && isset($_SESSION['company_id'])) {
            $title = 'Company Profile';
            // Fetch company data
            $companyModel = new CompanyModel();
            $companyId = $_SESSION['company_id'];
            $company = $companyModel->getById($companyId);
            // Fetch active and inactive employee counts
            $activeMembers = $companyModel->getActiveEmployeeCount($companyId);
            $inactiveMembers = $companyModel->getInactiveEmployeeCount($companyId);
            // Capture profile view output
            ob_start();
            include __DIR__ . '/../resources/views/company/profile-overview.php';
            $content = ob_get_clean();
            $layout = 'company_dashboard';
        } else {
            // Redirect to login if not authorized
            header("Location: ?path=login");
            exit();
        }
        break;

    // Company edit profile page
    case 'company/edit-profile':
        // Restrict access to logged-in companies
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'company' && isset($_SESSION['company_id'])) {
            $title = 'Edit Company Profile';
            // Fetch company data
            $companyModel = new CompanyModel();
            $company = $companyModel->getById($_SESSION['company_id']);
            // Capture edit profile view output
            ob_start();
            include __DIR__ . '/../resources/views/company/edit-profile.php';
            $content = ob_get_clean();
            $layout = 'company_dashboard';
        } else {
            // Redirect to login if not authorized
            header("Location: ?path=login");
            exit();
        }
        break;

    // Company update profile
    case 'company/updateProfile':
        // Restrict access to logged-in companies
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'company' && isset($_SESSION['company_id'])) {
            // Handle POST request for profile update
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $companyController->updateProfile();
            } else {
                // Redirect to profile if not a POST request
                header("Location: ?path=company/profile");
                exit();
            }
        } else {
            // Redirect to login if not authorized
            header("Location: ?path=login");
            exit();
        }
        break;

    // Company: Search employees
    case 'company/search-employees':
        // Restrict access to logged-in companies
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'company' && isset($_SESSION['company_id'])) {
            $title = 'Search Employees';
            $content = include_and_capture(__DIR__ . '/../resources/views/company/employee_management/search-employees.php');
            $layout = 'company_dashboard';
        } else {
            // Redirect to login if not authorized
            header("Location: ?path=login");
            exit();
        }
        break;

        case 'company/search-employees-ajax':
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'company' && isset($_SESSION['company_id'])) {
                $companyController->searchEmployees();
            } else {
                header("HTTP/1.1 403 Forbidden");
                exit();
            }
            break;

    // Company: Active employees
    case 'company/active-employees':
        // Restrict access to logged-in companies
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'company' && isset($_SESSION['company_id'])) {
            $title = 'Active Employees';
            $content = include_and_capture(__DIR__ . '/../resources/views/company/records/active-employees.php');
            $layout = 'company_dashboard';
        } else {
            // Redirect to login if not authorized
            header("Location: ?path=login");
            exit();
        }
        break;

    // Company: Inactive employees
    case 'company/inactive-employees':
        // Restrict access to logged-in companies
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'company' && isset($_SESSION['company_id'])) {
            $title = 'Inactive Employees';
            $content = include_and_capture(__DIR__ . '/../resources/views/company/records/inactive-employees.php');
            $layout = 'company_dashboard';
        } else {
            // Redirect to login if not authorized
            header("Location: ?path=login");
            exit();
        }
        break;

    // Company: Add/Update records
    case 'company/add-update-records':
        // Restrict access to logged-in companies
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'company' && isset($_SESSION['company_id'])) {
            $title = 'Add/Update Records';
            $content = include_and_capture(__DIR__ . '/../resources/views/company/records/add-update-records.php');
            $layout = 'company_dashboard';
        } else {
            // Redirect to login if not authorized
            header("Location: ?path=login");
            exit();
        }
        break;

    // Company: Achievements
    case 'company/achievements':
        // Restrict access to logged-in companies
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'company' && isset($_SESSION['company_id'])) {
            $title = 'Achievements';
            $content = include_and_capture(__DIR__ . '/../resources/views/company/records/achievements.php');
            $layout = 'company_dashboard';
        } else {
            // Redirect to login if not authorized
            header("Location: ?path=login");
            exit();
        }
        break;

    // Company: Skills
    case 'company/skills':
        // Restrict access to logged-in companies
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'company' && isset($_SESSION['company_id'])) {
            $title = 'Skills';
            $content = include_and_capture(__DIR__ . '/../resources/views/company/records/skills.php');
            $layout = 'company_dashboard';
        } else {
            // Redirect to login if not authorized
            header("Location: ?path=login");
            exit();
        }
        break;

    // Company: Account settings
    case 'company/account-settings':
        // Restrict access to logged-in companies
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'company' && isset($_SESSION['company_id'])) {
            $title = 'Account Settings';
            $content = include_and_capture(__DIR__ . '/../resources/views/company/settings/account-settings.php');
            $layout = 'company_dashboard';
        } else {
            // Redirect to login if not authorized
            header("Location: ?path=login");
            exit();
        }
        break;

    // Company: Export data
    case 'company/export-data':
        // Restrict access to logged-in companies
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'company' && isset($_SESSION['company_id'])) {
            $title = 'Export Data';
            $content = include_and_capture(__DIR__ . '/../resources/views/company/settings/export-data.php');
            $layout = 'company_dashboard';
        } else {
            // Redirect to login if not authorized
            header("Location: ?path=login");
            exit();
        }
        break;

    // Company: Add employee (AJAX)
    case 'company/add-employee':
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'company' && isset($_SESSION['company_id'])) {
            $companyController->addEmployeeAjax();
        } else {
            header('HTTP/1.1 403 Forbidden');
            echo json_encode(['success' => false, 'message' => 'Not authorized.']);
            exit();
        }
        break;

    // Company: Update employees
    case 'company/update-employees':
        // Restrict access to logged-in companies
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'company' && isset($_SESSION['company_id'])) {
            $title = 'Update Employees';
            $content = include_and_capture(__DIR__ . '/../resources/views/company/employee_management/update-employees.php');
            $layout = 'company_dashboard';
        } else {
            // Redirect to login if not authorized
            header("Location: ?path=login");
            exit();
        }
        break;

    // Company: Update employee (AJAX)
    case 'company/update-employee':
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'company' && isset($_SESSION['company_id'])) {
            $companyController->updateEmployeeAjax();
        } else {
            header('HTTP/1.1 403 Forbidden');
            echo json_encode(['success' => false, 'message' => 'Not authorized.']);
            exit();
        }
        break;

    // Company: Get employee for update (AJAX)
    case 'company/get-employee-for-update':
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'company' && isset($_SESSION['company_id'])) {
            $companyController->getEmployeeForUpdate();
        } else {
            header('HTTP/1.1 403 Forbidden');
            echo json_encode(['success' => false, 'message' => 'Not authorized.']);
            exit();
        }
        break;
        
    // Companies: Get all companies (AJAX)
    case 'companies-ajax':
        $companyController->getAllCompaniesAjax();
        break;

    // Companies: Get company details (AJAX)
    case 'company-details-ajax':
        $companyController->getCompanyDetailsAjax();
        break;

    // Handle unknown routes with 404 page
    default:
        $title = '404 - Not Found';
        // Load 404 view
        ob_start();
        include __DIR__ . '/../resources/views/pages/404.php';
        $content = ob_get_clean();
        break;
}

// Load the selected layout file
$layoutFile = __DIR__ . '/../resources/views/layouts/' . $layout . '.php';
if (file_exists($layoutFile)) {
    // Include layout if it exists
    include $layoutFile;
} else {
    // Fallback to raw content if layout file is missing
    echo $content;
}

// Helper function: Capture output of included PHP view file
function include_and_capture($filePath)
{
    ob_start();
    include $filePath;
    return ob_get_clean();
}
?>
