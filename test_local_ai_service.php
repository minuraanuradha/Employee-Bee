<?php
// Test script to communicate with local AI model service

echo "<h1>Local AI Model Service Test</h1>\n";

// Test data
$testData = [
    "skills" => "ui ux",
    "education" => "",
    "current_role" => "Junior UI/UX Designer",
    "experience_years" => 2,
    "company_comment" => "Delivers clean, maintainable work. Excellent feedback from peers and clients."
];

echo "<h2>Test Data</h2>\n";
echo "<pre>" . htmlspecialchars(print_r($testData, true)) . "</pre>\n";

// Try to call the local AI model service
// We'll assume it's running on localhost:7860 (Gradio default)
$url = 'http://localhost:7860/api/predict';

// Prepare the data in the format expected by the Gradio API
$data = [
    "data" => [
        $testData['skills'],
        $testData['education'],
        $testData['current_role'],
        (int)$testData['experience_years'],
        $testData['company_comment']
    ]
];

$jsonData = json_encode($data);

echo "<h2>Request Data</h2>\n";
echo "<pre>" . htmlspecialchars($jsonData) . "</pre>\n";

// Initialize cURL
$ch = curl_init($url);

// Set cURL options
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $jsonData,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json'
    ],
    CURLOPT_TIMEOUT => 30,
    CURLOPT_CONNECTTIMEOUT => 10,
    // Use our SSL certificate for verification
    CURLOPT_CAINFO => __DIR__ . '/app/config/certs/cacert.pem',
    CURLOPT_SSL_VERIFYPEER => true,
    CURLOPT_SSL_VERIFYHOST => 2,
]);

echo "<h2>Sending Request to Local AI Model</h2>\n";
echo "<p>URL: " . htmlspecialchars($url) . "</p>\n";

// Execute the request
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

echo "<h3>Response</h3>\n";
echo "<ul>\n";
echo "<li><strong>HTTP Code:</strong> " . $httpCode . "</li>\n";
echo "<li><strong>cURL Error:</strong> " . htmlspecialchars($curlError) . "</li>\n";
echo "</ul>\n";

if ($response !== false) {
    echo "<h3>Response Body</h3>\n";
    echo "<pre>" . htmlspecialchars($response) . "</pre>\n";
    
    // Try to decode JSON
    $decoded = json_decode($response, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        echo "<h3>Decoded JSON</h3>\n";
        echo "<pre>" . htmlspecialchars(print_r($decoded, true)) . "</pre>\n";
    } else {
        echo "<p>Failed to decode JSON: " . json_last_error_msg() . "</p>\n";
    }
} else {
    echo "<p style='color: red;'>Failed to get response from local AI model service</p>\n";
    echo "<p>This might be because the AI model service is not running.</p>\n";
    echo "<p>To start the service, run:</p>\n";
    echo "<pre>cd ai/career-insight-predictor-v2 && python app.py</pre>\n";
}
?>