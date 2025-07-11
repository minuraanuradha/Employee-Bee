<?php
// Enable session
session_start();

// Enable debug mode (set false for production)
$debugMode = true; //false

// Helper: console logging
function console_log($message, $level = 'log')
{
    global $debugMode;
    if (!$debugMode) return;
    $timestamp = date('Y-m-d H:i:s');
    $validLevels = ['log', 'warn', 'error', 'info'];
    $level = in_array($level, $validLevels) ? $level : 'log';
    echo "<script>console.{$level}('[{$timestamp}] {$message}');</script>";
}

// Get request path and clean it
$rawPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = '/' . trim($rawPath, '/');

// Dynamically get base path (e.g., /Employee-Bee/public)
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$baseURL = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'); // gives: /Employee-Bee/public

// Remove base path from URL
if (stripos($path, $basePath) === 0) {
    $path = substr($path, strlen($basePath));
    $path = trim($path, '/');
}

// Override path with query parameter if present
if (isset($_GET['path'])) {
    $path = $_GET['path'];
    console_log("Overridden path from query: {$path}", 'debug');
} else {
    console_log("Using default path: {$path}", 'debug');
}

// Route logic
$title = '';
$content = '';
$layout = 'main'; // Default layout

// Include models and controllers
require_once __DIR__ . '/../app/config/database.php';
require_once __DIR__ . '/../app/models/UserModel.php';
require_once __DIR__ . '/../app/models/CompanyModel.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/UserController.php';
require_once __DIR__ . '/../app/controllers/CompanyController.php';

$authController = new AuthController();
$userController = new UserController();
$companyController = new CompanyController();

switch ($path) {
    case '':
    case 'home':
        $title = 'Home';
        $homePath = __DIR__ . '/../resources/views/pages/home.php';
        $content = file_exists($homePath) ? include_and_capture($homePath) : '<h1>Home file not found</h1>';
        break;

    case 'companies':
        $title = 'Companies';
        $homePath = __DIR__ . '/../resources/views/pages/Companies.php';
        $content = file_exists($homePath) ? include_and_capture($homePath) : '<h1>Companies file not found</h1>';
        break;

    case 'about-us':
        $title = 'About Us';
        $content = '<h1>About Us</h1><p>Learn more about Employee Bee...</p>';
        break;

    case 'help':
        $title = 'Help';
        $content = '<h1>Help</h1><p>Get support here...</p>';
        break;

    case 'login':
        $title = 'Login';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $authController->login();
        } else {
            $content = include_and_capture(__DIR__ . '/../resources/views/auth/login.php');
            $layout = 'simple'; // Use a different layout for login
        }
        break;

    case 'signup':
        $title = 'Sign Up';
        $content = include_and_capture(__DIR__ . '/../resources/views/auth/signup.php');
        $layout = 'simple'; // Use a different layout for signup
        break;

    case 'signup/employee':
        $title = 'Sign Up - Employee';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userController->signup();
        } else {
            $content = include_and_capture(__DIR__ . '/../resources/views/auth/signup_employee.php');
            $layout = 'simple'; // Use a different layout for employee signup
        }
        break;

    case 'signup/company':
        $title = 'Sign Up - Company';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $companyController->signup();
        } else {
            $content = include_and_capture(__DIR__ . '/../resources/views/auth/signup_company.php');
            $layout = 'simple'; // Use a different layout for company signup
        }
        break;

    case 'profile':
        console_log("Checking session for profile: role=" . ($_SESSION['role'] ?? 'none') . ", user_id=" . ($_SESSION['user_id'] ?? 'none') . ", company_id=" . ($_SESSION['company_id'] ?? 'none'), 'debug');
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 'employee' && isset($_SESSION['user_id'])) {
                $title = 'Employee Profile';
                $content = include_and_capture(__DIR__ . '/../resources/views/employee/index.php');
                $layout = 'profile_dashboard'; // ✅ use the new dashboard layout
            } elseif ($_SESSION['role'] == 'company' && isset($_SESSION['company_id'])) {
                $title = 'Company Profile';
                $content = include_and_capture(__DIR__ . '/../resources/views/company/index.php');
            } else {
                header("Location: ?path=login");
                exit();
            }
        } else {
            header("Location: ?path=login");
            exit();
        }
        break;

    // Employee Dashboard Pages
    case 'profile-overview':
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'employee' && isset($_SESSION['user_id'])) {
            $title = 'My Profile';
            $content = include_and_capture(__DIR__ . '/../resources/views/employee/profile-overview.php');
            $layout = 'profile_dashboard';
        } else {
            header("Location: ?path=login");
            exit();
        }
        break;

    case 'history':
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'employee' && isset($_SESSION['user_id'])) {
            $title = 'Employee History';
            $content = include_and_capture(__DIR__ . '/../resources/views/employee/history.php');
            $layout = 'profile_dashboard';
        } else {
            header("Location: ?path=login");
            exit();
        }
        break;

    case 'insights':
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'employee' && isset($_SESSION['user_id'])) {
            $title = 'Career Insights';
            $content = include_and_capture(__DIR__ . '/../resources/views/employee/insights.php');
            $layout = 'profile_dashboard';
        } else {
            header("Location: ?path=login");
            exit();
        }
        break;

    case 'settings':
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'employee' && isset($_SESSION['user_id'])) {
            $title = 'Settings';
            $content = include_and_capture(__DIR__ . '/../resources/views/employee/settings.php');
            $layout = 'profile_dashboard';
        } else {
            header("Location: ?path=login");
            exit();
        }
        break;
    case 'logout':
        session_destroy();
        header("Location: ?path=login");
        exit();
        break;

    default:
        $title = '404 - Not Found';
        ob_start();
        include __DIR__ . '/../resources/views/pages/404.php';
        $content = ob_get_clean();
        break;
}

// Load selected layout
$layoutFile = __DIR__ . '/../resources/views/layouts/' . $layout . '.php';
if (file_exists($layoutFile)) {
    include $layoutFile;
} else {
    echo $content; // Fallback to raw content if layout file is missing
}

// Helper to capture included file output
function include_and_capture($filePath)
{
    ob_start();
    include $filePath;
    return ob_get_clean();
}
