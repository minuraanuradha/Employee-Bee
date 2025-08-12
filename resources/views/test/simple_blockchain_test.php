<?php
// Simple blockchain test page
$config = require_once __DIR__ . '/../../../app/config/environment.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔗 Simple Blockchain Test - Employee Bee</title>
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
        <h1>🔗 Simple Blockchain Test</h1>
        
        <!-- Configuration Test -->
        <div class="test-section">
            <h2>Configuration Status</h2>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Network</div>
                    <div class="info-value"><?php echo htmlspecialchars($config['blockchain']['network'] ?? 'Not set'); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">RPC URL</div>
                    <div class="info-value"><?php echo htmlspecialchars($config['blockchain']['rpc_url'] ?? 'Not set'); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Contract Address</div>
                    <div class="info-value"><?php echo htmlspecialchars($config['blockchain']['contract_address'] ?? 'Not set'); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Private Key</div>
                    <div class="info-value"><?php echo $config['blockchain']['private_key'] ? substr($config['blockchain']['private_key'], 0, 10) . '...' : 'Not set'; ?></div>
                </div>
            </div>
        </div>

        <!-- Bridge Service Test -->
        <div class="test-section">
            <h2>Bridge Service Test</h2>
            <div id="bridgeStatus">
                <p>Testing bridge service connection...</p>
            </div>
            <button class="btn" onclick="testBridgeConnection()">Test Bridge Connection</button>
        </div>

        <!-- Blockchain Operations Test -->
        <div class="test-section">
            <h2>Blockchain Operations Test</h2>
            <button class="btn" onclick="testHireEmployee()">Test Hire Employee</button>
            <button class="btn" onclick="testGetRecords()">Test Get Records</button>
            <div id="testResults">
                <p>Click a test button above to see results here.</p>
            </div>
        </div>
    </div>

    <script>
        // Test bridge service connection
        async function testBridgeConnection() {
            const statusDiv = document.getElementById('bridgeStatus');
            statusDiv.innerHTML = '<p>Testing connection...</p>';
            
            try {
                const response = await fetch('http://localhost:3001/health');
                const data = await response.json();
                
                if (data.status === 'ok') {
                    statusDiv.innerHTML = `
                        <div class="status success">
                            ✅ Bridge service is running!<br>
                            Web3 Connected: ${data.web3Connected}<br>
                            Contract Loaded: ${data.contractLoaded}<br>
                            Network: ${data.network}
                        </div>
                    `;
                } else {
                    statusDiv.innerHTML = `
                        <div class="status error">
                            ❌ Bridge service error: ${data.error || 'Unknown error'}
                        </div>
                    `;
                }
            } catch (error) {
                statusDiv.innerHTML = `
                    <div class="status error">
                        ❌ Cannot connect to bridge service<br>
                        Make sure the bridge is running on port 3001<br>
                        Error: ${error.message}
                    </div>
                `;
            }
        }

        // Test hire employee
        async function testHireEmployee() {
            const resultsDiv = document.getElementById('testResults');
            resultsDiv.innerHTML = '<p>Testing hire employee...</p>';
            
            try {
                const response = await fetch('http://localhost:3001/blockchain', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        method: 'addEmploymentRecord',
                        params: {
                            employeeId: 'EMP_TEST_001',
                            companyId: 'COMP_TEST_001',
                            roleTitle: 'Software Developer',
                            skillsOnHire: 'PHP,JavaScript,MySQL',
                            startDate: Math.floor(Date.now() / 1000)
                        }
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    resultsDiv.innerHTML = `
                        <div class="status success">
                            ✅ Hire test successful!<br>
                            Transaction Hash: ${data.transaction_hash}<br>
                            Block Number: ${data.block_number}<br>
                            Gas Used: ${data.gas_used}
                        </div>
                    `;
                } else {
                    resultsDiv.innerHTML = `
                        <div class="status error">
                            ❌ Hire test failed: ${data.error}
                        </div>
                    `;
                }
            } catch (error) {
                resultsDiv.innerHTML = `
                    <div class="status error">
                        ❌ Network error: ${error.message}
                    </div>
                `;
            }
        }

        // Test get records
        async function testGetRecords() {
            const resultsDiv = document.getElementById('testResults');
            resultsDiv.innerHTML = '<p>Testing get records...</p>';
            
            try {
                const response = await fetch('http://localhost:3001/blockchain', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        method: 'getEmployeeRecords',
                        params: {
                            employeeId: 'EMP_TEST_001'
                        }
                    })
                });
                
                const data = await response.json();
                
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
            } catch (error) {
                resultsDiv.innerHTML = `
                    <div class="status error">
                        ❌ Network error: ${error.message}
                    </div>
                `;
            }
        }

        // Auto-test bridge connection on page load
        window.onload = function() {
            testBridgeConnection();
        };
    </script>
</body>
</html>