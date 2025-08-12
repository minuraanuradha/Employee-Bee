<?php
// API proxy: your frontend calls this; it calls the HF Space

$projectRoot = dirname(__DIR__, 2);
require_once $projectRoot . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable($projectRoot);
$dotenv->load();

require_once $projectRoot . '/app/services/AiService.php';

header('Content-Type: application/json');

$skills = $_POST['skills'] ?? '';
$education = $_POST['education'] ?? '';
$current_role = $_POST['current_role'] ?? '';
$experience_years = isset($_POST['experience_years']) ? floatval($_POST['experience_years']) : 0;
$company_comment = $_POST['company_comment'] ?? '';

$svc = new AiService();
$res = $svc->callHuggingFaceModel($skills, $education, $current_role, $experience_years, $company_comment);

http_response_code($res['ok'] ? 200 : 502);
echo json_encode($res, JSON_PRETTY_PRINT);
