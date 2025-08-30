<?php

require_once __DIR__ . '/../services/AiService.php';
require_once __DIR__ . '/../models/UserModel.php';

class AiController {
    private $aiService;
    private $userModel;
    
    public function __construct() {
        $this->aiService = new AiService();
        $this->userModel = new UserModel();
    }
    
    /**
     * Generate career insights for the current user
     *
     * @return void
     */
    public function generateInsights() {
        // Check if user is logged in
        session_start();
        $user_id = $_SESSION['user_id'] ?? null;
        
        if (!$user_id) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }
        
        // Get user details
        $user = $this->userModel->getEmployeeById($user_id);
        
        if (!$user) {
            http_response_code(404);
            echo json_encode(['error' => 'User not found']);
            return;
        }
        
        // Generate insights
        $insights = $this->aiService->generateCareerInsights($user['unique_id']);
        
        if (isset($insights['error'])) {
            http_response_code(404);
            echo json_encode($insights);
            return;
        }
        
        // Save insights
        $this->aiService->saveInsights($insights);
        
        // Return insights
        header('Content-Type: application/json');
        echo json_encode($insights);
    }
    
    /**
     * Get saved insights for the current user
     *
     * @return void
     */
    public function getInsights() {
        // Check if user is logged in
        session_start();
        $user_id = $_SESSION['user_id'] ?? null;
        
        if (!$user_id) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }
        
        // Get user details
        $user = $this->userModel->getEmployeeById($user_id);
        if (!$user) {
            http_response_code(404);
            echo json_encode(['error' => 'User not found']);
            return;
        }
        
        // Get saved insights
        $insights = $this->aiService->getSavedInsights($user['unique_id']);
        
        header('Content-Type: application/json');
        echo json_encode($insights);
    }
}