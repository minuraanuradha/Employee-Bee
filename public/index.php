<?php
session_start();

// Load environment variables
if (file_exists(__DIR__ . '/../.env')) {
    $lines = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value, " \t\n\r\0\x0B\"'");
            if (!array_key_exists($name, $_ENV)) {
                $_ENV[$name] = $value;
            }
        }
    }
}

// Get debug mode from environment
$debugMode = filter_var($_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOLEAN);

// Helper function: Logs messages to browser console for debugging
function console_log($message, $level = 'log') {
    // Access global debug mode setting
    global $debugMode;
    // Skip logging if debug mode is disabled
    if (!$debugMode) return;
    
    // Ensure level is valid
    $validLevels = ['log', 'warn', 'error', 'info'];
    $level = in_array($level, $validLevels) ? $level : 'log';
    
    // Output JavaScript console command
    echo "<script>console.{$level}(" . json_encode($message) . ");</script>";
}

// Error reporting based on debug mode
if ($debugMode) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
} else {
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
}

// Log file path for errors
ini_set('error_log', __DIR__ . '/../storage/logs/php_errors.log');

require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/UserController.php';
require_once '../app/controllers/CompanyController.php';
require_once '../app/controllers/BlockchainController.php';

// Get the requested path, defaulting to 'home'
$path = $_GET['path'] ?? 'home';
console_log("Requested path: {$path}", 'info');

// Initialize controllers
$authController = new AuthController();
$userController = new UserController();
$companyController = new CompanyController();
$blockchainController = new BlockchainController();

// Main routing logic
switch ($path) {
    case 'home':
        // Load home view or display error if file is missing
        $homeViewPath = '../resources/views/pages/home.php';
        if (file_exists($homeViewPath)) {
            require_once $homeViewPath;
        } else {
            console_log("Home view not found: {$homeViewPath}", 'error');
            echo "Home page not found.";
        }
        break;

    case 'companies':
        // Load companies view or display error if file is missing
        $companiesViewPath = '../resources/views/pages/companies.php';
        if (file_exists($companiesViewPath)) {
            require_once $companiesViewPath;
        } else {
            console_log("Companies view not found: {$companiesViewPath}", 'error');
            echo "Companies page not found.";
        }
        break;

    case 'about':
        require_once '../resources/views/pages/about.php';
        break;

    case 'help':
        require_once '../resources/views/pages/help.php';
        break;

    case 'login':
        $authController->showLogin();
        break;

    case 'auth':
        $authController->login();
        break;

    case 'logout':
        $authController->logout();
        break;

    case 'signup':
        require_once '../resources/views/auth/signup.php';
        break;

    case 'signup/employee':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->createEmployee();
        } else {
            require_once '../resources/views/auth/signup_employee.php';
        }
        break;

    case 'signup/company':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $companyController->createCompany();
        } else {
            require_once '../resources/views/auth/signup_company.php';
        }
        break;

    case 'profile':
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?path=login");
            exit();
        }
        $userController->showProfile();
        break;

    case 'profile/edit':
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?path=login");
            exit();
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userController->updateProfile();
        } else {
            $userController->showEditProfile();
        }
        break;

    case 'employee/insights':
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?path=login");
            exit();
        }
        require_once '../resources/views/employee/insights.php';
        break;

    case 'employee/history':
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?path=login");
            exit();
        }
        require_once '../resources/views/employee/history.php';
        break;

    case 'employee/settings':
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?path=login");
            exit();
        }
        require_once '../resources/views/employee/settings.php';
        break;

    case 'employee/download-resume':
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?path=login");
            exit();
        }
        $userController->downloadResume();
        break;

    case 'employee/view-resume':
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?path=login");
            exit();
        }
        $userController->viewResume();
        break;

    case 'company/profile':
        if (!isset($_SESSION['company_id'])) {
            header("Location: ?path=login");
            exit();
        }
        $companyController->showProfile();
        break;

    case 'company/profile/edit':
        if (!isset($_SESSION['company_id'])) {
            header("Location: ?path=login");
            exit();
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $companyController->updateProfile();
        } else {
            $companyController->showEditProfile();
        }
        break;

    case 'company/employees/active':
        if (!isset($_SESSION['company_id'])) {
            header("Location: ?path=login");
            exit();
        }
        require_once '../resources/views/company/employee_management/active-employees.php';
        break;

    case 'company/employees/inactive':
        if (!isset($_SESSION['company_id'])) {
            header("Location: ?path=login");
            exit();
        }
        require_once '../resources/views/company/employee_management/inactive-employees.php';
        break;

    case 'company/employees/search':
        if (!isset($_SESSION['company_id'])) {
            header("Location: ?path=login");
            exit();
        }
        require_once '../resources/views/company/employee_management/search-employees.php';
        break;

    case 'company/records/skills':
        if (!isset($_SESSION['company_id'])) {
            header("Location: ?path=login");
            exit();
        }
        require_once '../resources/views/company/records/skills.php';
        break;

    case 'company/records/achievements':
        if (!isset($_SESSION['company_id'])) {
            header("Location: ?path=login");
            exit();
        }
        require_once '../resources/views/company/records/achievements.php';
        break;

    case 'company/records/add-update':
        if (!isset($_SESSION['company_id'])) {
            header("Location: ?path=login");
            exit();
        }
        require_once '../resources/views/company/records/add-update-records.php';
        break;

    case 'company/settings/account':
        if (!isset($_SESSION['company_id'])) {
            header("Location: ?path=login");
            exit();
        }
        require_once '../resources/views/company/settings/account-settings.php';
        break;

    case 'company/settings/export':
        if (!isset($_SESSION['company_id'])) {
            header("Location: ?path=login");
            exit();
        }
        require_once '../resources/views/company/settings/export-data.php';
        break;

    case 'blockchain/test':
        if ($debugMode) {
            require_once '../resources/views/test/blockchain_test.php';
        } else {
            echo "Access denied.";
        }
        break;

    case 'test':
        if ($debugMode) {
            require_once '../resources/views/test/test.php';
        } else {
            echo "Access denied.";
        }
        break;

    case 'error':
    case '404':
        require_once '../resources/views/pages/404.php';
        break;

    default:
        // Log session details for debugging
        console_log("Session data - User ID: " . ($_SESSION['user_id'] ?? 'none') . ", Company ID: " . ($_SESSION['company_id'] ?? 'none'), 'info');
        require_once '../resources/views/pages/404.php';
        break;
}
?>