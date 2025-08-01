<?php
require_once '../../app/config/database.php';
require_once '../../app/models/UserModel.php';
require_once '../../app/controllers/CompanyController.php';

$action = $_GET['action'] ?? '';

$controller = new CompanyController();

switch ($action) {
    case 'active':
        $controller->fetchActiveEmployees();
        break;
    case 'inactive':
        $controller->fetchInactiveEmployees();
        break;
    default:
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Invalid action']);
        break;
    }
