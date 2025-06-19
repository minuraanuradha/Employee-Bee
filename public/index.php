<?php
// /public/index.php

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

console_log("Cleaned path: {$path}", 'debug');

// Route logic
$title = '';
$content = '';

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

    default:
        $title = '404 - Not Found';
        ob_start();
        include __DIR__ . '/../resources/views/pages/404.php';
        $content = ob_get_clean();
        break;
}

// Load main layout
include __DIR__ . '/../resources/views/layouts/main.php';

// Helper to capture included file output
function include_and_capture($filePath)
{
    ob_start();
    include $filePath;
    return ob_get_clean();
}
