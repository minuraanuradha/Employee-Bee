<?php
// AI Service Test - Custom Data Input
require_once __DIR__ . '/../../../vendor/autoload.php';

// Load environment variables
$projectRoot = dirname(dirname(dirname(__DIR__)));
$dotenv = Dotenv\Dotenv::createImmutable($projectRoot);
$dotenv->load();

// Include the AiService class
require_once $projectRoot . '/app/services/AiService.php';

// Initialize variables
$skills = "";
$education = "";
$current_role = "";
$experience_years = "";
$company_comment = "";
$result = null;
$error = "";

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $skills = trim($_POST['skills'] ?? '');
    $education = trim($_POST['education'] ?? '');
    $current_role = trim($_POST['current_role'] ?? '');
    $experience_years = trim($_POST['experience_years'] ?? '');
    $company_comment = trim($_POST['company_comment'] ?? '');
    
    // Validate required fields
    if (empty($skills) || empty($education) || empty($current_role) || empty($experience_years) || empty($company_comment)) {
        $error = "All fields are required.";
    } else {
        // Validate experience years is numeric
        if (!is_numeric($experience_years)) {
            $error = "Experience years must be a number.";
        } else {
            try {
                $aiService = new AiService();
                
                // Call the AI service
                $result = $aiService->callAiModel(
                    $skills,
                    $education,
                    $current_role,
                    (float)$experience_years,
                    $company_comment
                );
            } catch (Exception $e) {
                $error = "Exception occurred: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🤖 AI Service Test - Custom Data</title>
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
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #ff6b35;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            background-color: #2a2a2a;
            border: 1px solid #444;
            border-radius: 5px;
            color: white;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
            resize: vertical;
        }
        button {
            background-color: #ff6b35;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        button:hover {
            background-color: #e55a2b;
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
        <h1>🤖 AI Service Test - Custom Data</h1>
        
        <!-- Custom Data Input Form -->
        <div class="test-section">
            <h2>Custom Test Data</h2>
            <?php if ($error): ?>
                <div class="status error">
                    ❌ Error: <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label for="skills">Skills:</label>
                    <input type="text" id="skills" name="skills" value="<?php echo htmlspecialchars($skills); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="education">Education:</label>
                    <input type="text" id="education" name="education" value="<?php echo htmlspecialchars($education); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="current_role">Current Role:</label>
                    <input type="text" id="current_role" name="current_role" value="<?php echo htmlspecialchars($current_role); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="experience_years">Experience (years):</label>
                    <input type="number" id="experience_years" name="experience_years" step="0.1" value="<?php echo htmlspecialchars($experience_years); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="company_comment">Company Comment:</label>
                    <textarea id="company_comment" name="company_comment" required><?php echo htmlspecialchars($company_comment); ?></textarea>
                </div>
                
                <button type="submit">Test AI Model</button>
            </form>
        </div>
        
        <!-- AI Service Test Result -->
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$error && $result !== null): ?>
            <div class="test-section">
                <h2>AI Service Test Result</h2>
                <?php if ($result['ok']): ?>
                    <div class="status success">
                        ✅ Successfully connected to local AI service!
                    </div>
                    <h3>Response Data</h3>
                    <pre><?php echo htmlspecialchars(json_encode($result['data'], JSON_PRETTY_PRINT)); ?></pre>
                <?php else: ?>
                    <div class="status error">
                        ❌ Failed to connect to AI service:<br>
                        Error: <?php echo htmlspecialchars($result['error']); ?><br>
                        <?php if (isset($result['http'])): ?>
                            HTTP Code: <?php echo htmlspecialchars($result['http']); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <a href="test_home.php" class="btn">Back to Tests</a>
    </div>
</body>
</html>