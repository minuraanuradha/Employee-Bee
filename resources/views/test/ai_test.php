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
    
    // Call the AI service
    $result = $aiService->callAiModel(
        $skills,
        $education,
        $current_role,
        $experience_years,
        $company_comment
    );
} catch (Exception $e) {
    $error = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🤖 AI Service Test - Local Model</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto Flex', sans-serif;
            background-color: #000;
            color: #fff;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .test-section {
            background-color: #1a1a1a;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #ff6b35;
        }
        .status {
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }
        .status.success {
            background-color: #22c55e;
            color: white;
        }
        .status.error {
            background-color: #ef4444;
            color: white;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin: 15px 0;
        }
        .info-item {
            background-color: #2a2a2a;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #ff6b35;
        }
        .info-label {
            font-weight: 500;
            color: #ff6b35;
            margin-bottom: 5px;
        }
        .info-value {
            color: #fff;
        }
        .btn {
            background-color: #ff6b35;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn:hover {
            background-color: #e55a2b;
        }
        pre {
            background-color: #2a2a2a;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🤖 AI Service Test - Local Model</h1>
        
        <!-- Test Data Section -->
        <div class="test-section">
            <h2>Test Data</h2>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Skills</div>
                    <div class="info-value"><?php echo htmlspecialchars($skills); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Education</div>
                    <div class="info-value"><?php echo htmlspecialchars($education); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Current Role</div>
                    <div class="info-value"><?php echo htmlspecialchars($current_role); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Experience</div>
                    <div class="info-value"><?php echo htmlspecialchars($experience_years); ?> years</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Company Comment</div>
                    <div class="info-value"><?php echo htmlspecialchars($company_comment); ?></div>
                </div>
            </div>
        </div>
        
        <!-- AI Service Test Result -->
        <div class="test-section">
            <h2>AI Service Test Result</h2>
            <?php if (isset($error)): ?>
                <div class="status error">
                    ❌ Exception occurred: <?php echo htmlspecialchars($error); ?>
                </div>
            <?php elseif ($result['ok']): ?>
                <div class="status success">
                    ✅ Successfully connected to local AI service!
                </div>
                <h3>Response Data</h3>
                <pre><?php echo htmlspecialchars(json_encode($result['data'], JSON_PRETTY_PRINT)); ?></pre>
            <?php else: ?>
                <div class="status error">
                    ❌ Failed to connect to AI service:<br>
                    Error: <?php echo htmlspecialchars($result['error']); ?><br>
                    HTTP Code: <?php echo htmlspecialchars($result['http']); ?>
                </div>
            <?php endif; ?>
        </div>
        
        <a href="test_home.php" class="btn">Back to Tests</a>
    </div>
</body>
</html>