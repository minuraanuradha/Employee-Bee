<?php
// predict.php — call your HF Space Interface endpoint from PHP

$SPACE_API = 'https://minura-jayasingha-01-career-insight-predictor-v2.hf.space/api/predict/';

// Collect user input (or test values)
$skills = $_POST['skills'] ?? 'Interaction Design, Adobe XD';
$education = $_POST['education'] ?? 'BEng Software Engineering';
$current_role = $_POST['current_role'] ?? 'UI/UX Designer';
$experience_years = floatval($_POST['experience_years'] ?? 2);
$company_comment = $_POST['company_comment'] ?? 'Delivers clean, maintainable work.';

// Build payload in Gradio Interface format
$payload = json_encode([
  "data" => [
    $skills,
    $education,
    $current_role,
    $experience_years,
    $company_comment
  ]
]);

$ch = curl_init($SPACE_API);
curl_setopt_array($ch, [
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => $payload,
  CURLOPT_HTTPHEADER => [
    'Content-Type: application/json'
    // If your Space is PRIVATE, add:
    // 'Authorization: Bearer ' . getenv('HF_API_TOKEN')
  ],
  CURLOPT_TIMEOUT => 30
]);

$response = curl_exec($ch);
$http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$err = curl_error($ch);
curl_close($ch);

// Pass through
http_response_code($http ?: 200);
header('Content-Type: application/json');

if ($response === false) {
  echo json_encode(["error" => $err ?: "Unknown error"]);
  exit;
}

// Gradio Interface returns {"data": ["<json string>", ...]}
$out = json_decode($response, true);
if (isset($out['data'][0]) && is_string($out['data'][0])) {
  // the model returned JSON string; forward as JSON object
  $decoded = json_decode($out['data'][0], true);
  if (json_last_error() === JSON_ERROR_NONE) {
    echo json_encode($decoded, JSON_PRETTY_PRINT);
    exit;
  }
}

// fallback: return raw
echo $response;
