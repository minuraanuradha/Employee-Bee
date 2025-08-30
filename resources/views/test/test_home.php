<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🏠 Test Home - Employee Bee</title>
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
        .status.info {
            background-color: #3b82f6;
            color: white;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }
        .info-item {
            background-color: #2a2a2a;
            padding: 20px;
            border-radius: 5px;
            border-left: 4px solid #ff6b35;
            transition: transform 0.2s;
        }
        .info-item:hover {
            transform: translateY(-5px);
            background-color: #333;
        }
        .info-label {
            font-weight: 500;
            color: #ff6b35;
            margin-bottom: 10px;
            font-size: 1.2em;
        }
        .info-description {
            color: #ccc;
            margin-bottom: 15px;
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
        h1 {
            text-align: center;
            color: #ff6b35;
        }
        h2 {
            color: #ff6b35;
            border-bottom: 2px solid #ff6b35;
            padding-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🏠 Test Home</h1>
        
        <div class="test-section">
            <h2>Available Tests</h2>
            <p class="status info">Click on any test below to run it</p>
            
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">🤖 AI Service Test</div>
                    <div class="info-description">Test the AI service with static data</div>
                    <a href="ai_test.php" class="btn">Run Test</a>
                </div>
                
                <div class="info-item">
                    <div class="info-label">🤖 AI Service Test - Custom Data</div>
                    <div class="info-description">Test the AI service with your own custom data</div>
                    <a href="ai_custom_test.php" class="btn">Run Test</a>
                </div>
                
                <div class="info-item">
                    <div class="info-label">🔗 Simple Blockchain Test</div>
                    <div class="info-description">Test basic blockchain functionality</div>
                    <a href="simple_blockchain_test.php" class="btn">Run Test</a>
                </div>
                
                <div class="info-item">
                    <div class="info-label">🔗 Blockchain Test</div>
                    <div class="info-description">Comprehensive blockchain testing</div>
                    <a href="blockchain_test.php" class="btn">Run Test</a>
                </div>
                
                <div class="info-item">
                    <div class="info-label">🧪 Final Solution Test</div>
                    <div class="info-description">Complete end-to-end solution test</div>
                    <a href="final_solution_test.php" class="btn">Run Test</a>
                </div>
            </div>
        </div>
        
        <div class="test-section">
            <h2>About Testing</h2>
            <p>This testing hub provides access to all available tests for the Employee Bee system. Each test focuses on a specific component or functionality:</p>
            <ul>
                <li><strong>AI Tests</strong>: Validate the AI service integration and predictions</li>
                <li><strong>Blockchain Tests</strong>: Verify blockchain connectivity and operations</li>
                <li><strong>Final Solution Test</strong>: End-to-end testing of the complete system</li>
            </ul>
            <p>Use these tests to verify that all components are working correctly and to troubleshoot any issues.</p>
        </div>
    </div>
</body>
</html>