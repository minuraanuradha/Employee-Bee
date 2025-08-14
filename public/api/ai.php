<?php
// API proxy: your frontend calls this; it calls the AI service

$projectRoot = dirname(__DIR__, 2);
require_once $projectRoot . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable($projectRoot);
$dotenv->load();

require_once $projectRoot . '/app/controllers/AiController.php';

header('Content-Type: application/json');

// Handle GET requests to get saved insights
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Create AI controller
    $aiController = new AiController();
    
    // Call the getInsights method
    $aiController->getInsights();
    exit();
}

// Handle POST requests to generate new insights
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create AI controller
    $aiController = new AiController();
    
    // Call the generateInsights method
    $aiController->generateInsights();
    exit();
}

// If we reach here, it's an unsupported method
http_response_code(405);
echo json_encode(['error' => 'Method not allowed']);
