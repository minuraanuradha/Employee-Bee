<?php
// Blockchain Integration Test
require_once __DIR__ . '/../../../app/controllers/BlockchainController.php';

$blockchainController = new BlockchainController();

// Test connection
$connectionTest = $blockchainController->testConnection();

// Get contract info
$contractInfo = $blockchainController->getContractInfo();

// Get transaction history
$transactionHistory = $blockchainController->getTransactionHistory(null, 10);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔗 Blockchain Integration Test - Employee Bee</title>
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
        .status.warning {
            background-color: #f59e0b;
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
        .transaction-list {
            max-height: 300px;
            overflow-y: auto;
        }
        .transaction-item {
            background-color: #2a2a2a;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border-left: 3px solid #ff6b35;
        }
        .btn {
            background-color: #ff6b35;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }
        .btn:hover {
            background-color: #e55a2b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔗 Blockchain Integration Test</h1>
        
        <!-- Connection Test -->
        <div class="test-section">
            <h2>Connection Status</h2>
            <?php if ($connectionTest['success']): ?>
                <div class="status success">
                    ✅ <?php echo $connectionTest['message']; ?>
                    <br>Block Number: <?php echo number_format($connectionTest['block_number']); ?>
                </div>
            <?php else: ?>
                <div class="status error">
                    ❌ <?php echo $connectionTest['error']; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Contract Information -->
        <div class="test-section">
            <h2>Contract Information</h2>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Network</div>
                    <div class="info-value"><?php echo htmlspecialchars($contractInfo['network']); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">RPC URL</div>
                    <div class="info-value"><?php echo htmlspecialchars($contractInfo['rpc_url']); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Contract Address</div>
                    <div class="info-value">
                        <?php if (!empty($contractInfo['contract_address'])): ?>
                            <?php echo htmlspecialchars($contractInfo['contract_address']); ?>
                        <?php else: ?>
                            <span style="color: #f59e0b;">⚠️ Not deployed</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction History -->
        <div class="test-section">
            <h2>Recent Blockchain Transactions</h2>
            <?php if ($transactionHistory['success'] && !empty($transactionHistory['transactions'])): ?>
                <div class="transaction-list">
                    <?php foreach ($transactionHistory['transactions'] as $tx): ?>
                        <div class="transaction-item">
                            <strong>Employee ID:</strong> <?php echo htmlspecialchars($tx['employee_id']); ?><br>
                            <strong>Action:</strong> <?php echo htmlspecialchars($tx['action']); ?><br>
                            <strong>Transaction Hash:</strong> 
                            <a href="<?php echo $blockchainController->getTransactionUrl($tx['transaction_hash']); ?>" target="_blank" style="color: #ff6b35;">
                                <?php echo htmlspecialchars(substr($tx['transaction_hash'], 0, 20) . '...'); ?>
                            </a><br>
                            <strong>Status:</strong> <?php echo htmlspecialchars($tx['status']); ?><br>
                            <strong>Date:</strong> <?php echo htmlspecialchars($tx['created_at']); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="status warning">
                    No blockchain transactions found yet.
                </div>
            <?php endif; ?>
        </div>

        <!-- Test Actions -->
        <div class="test-section">
            <h2>Test Actions</h2>
            <p>Use these buttons to test blockchain functionality:</p>
            
            <button class="btn" onclick="testHireEmployee()">Test Hire Employee</button>
            <button class="btn" onclick="testUpdateEmployee()">Test Update Employee</button>
            <button class="btn" onclick="testGetRecords()">Test Get Records</button>
            <button class="btn" onclick="refreshPage()">Refresh Page</button>
        </div>

        <!-- Test Results -->
        <div class="test-section">
            <h2>Test Results</h2>
            <div id="testResults">
                <p>Click a test button above to see results here.</p>
            </div>
        </div>
    </div>

    <script>
        function testHireEmployee() {
            const resultsDiv = document.getElementById('testResults');
            resultsDiv.innerHTML = '<p>Testing hire employee...</p>';
            
            // Simulate API call
            fetch('?path=blockchain/test/hire', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    employeeId: 'EMP_TEST_001',
                    companyId: 'COMP_TEST_001',
                    roleTitle: 'Software Developer',
                    skillsOnHire: 'PHP,JavaScript,MySQL',
                    startDate: Math.floor(Date.now() / 1000)
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    resultsDiv.innerHTML = `
                        <div class="status success">
                            ✅ Hire test successful!<br>
                            Transaction Hash: ${data.transaction_hash}<br>
                            Message: ${data.message}
                        </div>
                    `;
                } else {
                    resultsDiv.innerHTML = `
                        <div class="status error">
                            ❌ Hire test failed: ${data.error}
                        </div>
                    `;
                }
            })
            .catch(error => {
                resultsDiv.innerHTML = `
                    <div class="status error">
                        ❌ Network error: ${error.message}
                    </div>
                `;
            });
        }

        function testUpdateEmployee() {
            const resultsDiv = document.getElementById('testResults');
            resultsDiv.innerHTML = '<p>Testing update employee...</p>';
            
            // Simulate API call
            fetch('?path=blockchain/test/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    employeeId: 'EMP_TEST_001',
                    recordIndex: 0,
                    newRoleTitle: 'Senior Developer',
                    newSkillsOnHire: 'PHP,JavaScript,MySQL,React',
                    newStatus: 'promoted',
                    feedbackText: 'Excellent performance, promoted to senior role'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    resultsDiv.innerHTML = `
                        <div class="status success">
                            ✅ Update test successful!<br>
                            Transaction Hash: ${data.transaction_hash}<br>
                            Message: ${data.message}
                        </div>
                    `;
                } else {
                    resultsDiv.innerHTML = `
                        <div class="status error">
                            ❌ Update test failed: ${data.error}
                        </div>
                    `;
                }
            })
            .catch(error => {
                resultsDiv.innerHTML = `
                    <div class="status error">
                        ❌ Network error: ${error.message}
                    </div>
                `;
            });
        }

        function testGetRecords() {
            const resultsDiv = document.getElementById('testResults');
            resultsDiv.innerHTML = '<p>Testing get records...</p>';
            
            // Simulate API call
            fetch('?path=blockchain/test/records&employeeId=EMP_TEST_001')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    resultsDiv.innerHTML = `
                        <div class="status success">
                            ✅ Get records test successful!<br>
                            Found ${data.count} records for employee EMP_TEST_001
                        </div>
                    `;
                } else {
                    resultsDiv.innerHTML = `
                        <div class="status error">
                            ❌ Get records test failed: ${data.error}
                        </div>
                    `;
                }
            })
            .catch(error => {
                resultsDiv.innerHTML = `
                    <div class="status error">
                        ❌ Network error: ${error.message}
                    </div>
                `;
            });
        }

        function refreshPage() {
            location.reload();
        }
    </script>
</body>
</html>