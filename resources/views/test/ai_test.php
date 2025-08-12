<?php
// AI Service Test - Local Model
require_once __DIR__ . '/../../../vendor/autoload.php';

// Load environment variables
$projectRoot = dirname(dirname(dirname(__DIR__)));
$dotenv = Dotenv\Dotenv::createImmutable($projectRoot);
$dotenv->load();

// Include the AiService class
require_once $projectRoot . '/app/services/AiService.php';

try {
    $aiService = new AiService();
    
    // Test data
    $skills = "Interaction Design, Adobe XD";
    $education = "BEng Software Engineering";
    $current_role = "UI/UX Designer";
    $experience_years = 2;
    $company_comment = "Delivers clean, maintainable work. Excellent feedback from peers and clients.";
    
    echo "<h1>🤖 AI Service Test - Local Model</h1>\n";
    echo "<h2>Test Data</h2>\n";
    echo "<ul>\n";
    echo "<li><strong>Skills:</strong> " . htmlspecialchars($skills) . "</li>\n";
    echo "<li><strong>Education:</strong> " . htmlspecialchars($education) . "</li>\n";
    echo "<li><strong>Current Role:</strong> " . htmlspecialchars($current_role) . "</li>\n";
    echo "<li><strong>Experience:</strong> " . htmlspecialchars($experience_years) . " years</li>\n";
    echo "<li><strong>Company Comment:</strong> " . htmlspecialchars($company_comment) . "</li>\n";
    echo "</ul>\n";
    
    echo "<h2>AI Service Test</h2>\n";
    echo "<p>Calling local AI model with test data...</p>\n";
    
    // Call the AI service
    $result = $aiService->callAiModel(
        $skills,
        $education,
        $current_role,
        $experience_years,
        $company_comment
    );
    
    if ($result['ok']) {
        echo "<p style='color: green;'>✅ Successfully connected to local AI service!</p>\n";
        echo "<h3>Response Data</h3>\n";
        echo "<pre>" . htmlspecialchars(json_encode($result['data'], JSON_PRETTY_PRINT)) . "</pre>\n";
    } else {
        echo "<p style='color: red;'>❌ Failed to connect to AI service:</p>\n";
        echo "<p>Error: " . htmlspecialchars($result['error']) . "</p>\n";
        echo "<p>HTTP Code: " . htmlspecialchars($result['http']) . "</p>\n";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Exception occurred:</p>\n";
    echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>\n";
}

echo "<p><a href='./test.php' style='background-color: #ff6b35; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;'>Back to Tests</a></p>\n";
?>