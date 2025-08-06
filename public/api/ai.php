<?php

require_once __DIR__ . '/../../app/controllers/AiController.php';

header('Content-Type: application/json');

// Get the request method
$method = $_SERVER['REQUEST_METHOD'];

// Create AI controller instance
$aiController = new AiController();

// Route based on method
switch ($method) {
    case 'POST':
        // Generate new insights
        $aiController->generateInsights();
        break;
    case 'GET':
        // Get saved insights
        $aiController->getInsights();
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;
}