<?php

class BlockchainService {
    private $config;
    private $web3Url;
    private $contractAddress;
    private $privateKey;
    private $abiPath;

    public function __construct() {
        // Load blockchain configuration
        $this->config = require_once __DIR__ . '/../config/environment.php';
        $this->web3Url = $this->config['blockchain']['rpc_url'];
        $this->contractAddress = $this->config['blockchain']['contract_address'];
        $this->privateKey = $this->config['blockchain']['private_key'];
        $this->abiPath = __DIR__ . '/../../blockchain/abis/EmploymentRecord.json';
    }

    /**
     * Add a new employment record to the blockchain
     */
    public function addEmploymentRecord($employeeId, $companyId, $roleTitle, $skillsOnHire, $startDate) {
        try {
            $data = [
                'method' => 'addEmploymentRecord',
                'params' => [
                    'employeeId' => $employeeId,
                    'companyId' => $companyId,
                    'roleTitle' => $roleTitle,
                    'skillsOnHire' => $skillsOnHire,
                    'startDate' => $startDate
                ]
            ];

            $result = $this->callBlockchainMethod($data);
            
            if ($result['success']) {
                return [
                    'success' => true,
                    'transaction_hash' => $result['transaction_hash'],
                    'message' => 'Employment record added to blockchain successfully'
                ];
            } else {
                return [
                    'success' => false,
                    'error' => $result['error']
                ];
            }
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => 'Blockchain service error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Update an existing employment record
     */
    public function updateEmploymentRecord($employeeId, $recordIndex, $newRoleTitle, $newSkillsOnHire, $newStatus, $feedbackText) {
        try {
            $data = [
                'method' => 'updateEmploymentRecord',
                'params' => [
                    'employeeId' => $employeeId,
                    'recordIndex' => $recordIndex,
                    'newRoleTitle' => $newRoleTitle,
                    'newSkillsOnHire' => $newSkillsOnHire,
                    'newStatus' => $newStatus,
                    'feedbackText' => $feedbackText
                ]
            ];

            $result = $this->callBlockchainMethod($data);
            
            if ($result['success']) {
                return [
                    'success' => true,
                    'transaction_hash' => $result['transaction_hash'],
                    'message' => 'Employment record updated on blockchain successfully'
                ];
            } else {
                return [
                    'success' => false,
                    'error' => $result['error']
                ];
            }
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => 'Blockchain service error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Exit an employee (end employment)
     */
    public function exitEmploymentRecord($employeeId, $recordIndex, $endDate, $newStatus, $feedbackText, $newSkills) {
        try {
            $data = [
                'method' => 'exitEmploymentRecord',
                'params' => [
                    'employeeId' => $employeeId,
                    'recordIndex' => $recordIndex,
                    'endDate' => $endDate,
                    'newStatus' => $newStatus,
                    'feedbackText' => $feedbackText,
                    'newSkills' => $newSkills
                ]
            ];

            $result = $this->callBlockchainMethod($data);
            
            if ($result['success']) {
                return [
                    'success' => true,
                    'transaction_hash' => $result['transaction_hash'],
                    'message' => 'Employee exit recorded on blockchain successfully'
                ];
            } else {
                return [
                    'success' => false,
                    'error' => $result['error']
                ];
            }
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => 'Blockchain service error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Get all employment records for an employee
     */
    public function getEmployeeRecords($employeeId) {
        try {
            $data = [
                'method' => 'getEmployeeRecords',
                'params' => [
                    'employeeId' => $employeeId
                ]
            ];

            $result = $this->callBlockchainMethod($data, true); // true for read-only
            
            if ($result['success']) {
                return [
                    'success' => true,
                    'records' => $result['data'],
                    'count' => count($result['data'])
                ];
            } else {
                return [
                    'success' => false,
                    'error' => $result['error']
                ];
            }
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => 'Blockchain service error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Check if blockchain is connected and working
     */
    public function checkConnection() {
        try {
            // Simple connection test
            $response = $this->makeRequest('eth_blockNumber', []);
            
            if (isset($response['result'])) {
                return [
                    'success' => true,
                    'block_number' => hexdec($response['result']),
                    'message' => 'Blockchain connection successful'
                ];
            } else {
                return [
                    'success' => false,
                    'error' => 'Unable to connect to blockchain'
                ];
            }
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => 'Connection error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Get contract information
     */
    public function getContractInfo() {
        return [
            'contract_address' => $this->contractAddress,
            'network' => $this->config['blockchain']['network'],
            'rpc_url' => $this->web3Url
        ];
    }

    /**
     * Call blockchain method (write operations)
     */
    private function callBlockchainMethod($data, $readOnly = false) {
        if ($readOnly) {
            // For read operations, use direct RPC call
            return $this->callContractRead($data);
        } else {
            // For write operations, use Node.js service
            return $this->callContractWrite($data);
        }
    }

    /**
     * Call contract for read operations
     */
    private function callContractRead($data) {
        $method = $data['method'];
        $params = $data['params'];
        
        // Build the call data
        $callData = $this->encodeFunctionCall($method, $params);
        
        $rpcData = [
            'jsonrpc' => '2.0',
            'method' => 'eth_call',
            'params' => [
                [
                    'to' => $this->contractAddress,
                    'data' => $callData
                ],
                'latest'
            ],
            'id' => 1
        ];

        $response = $this->makeRequest('', $rpcData);
        
        if (isset($response['result'])) {
            // Decode the result
            $decoded = $this->decodeFunctionResult($method, $response['result']);
            return [
                'success' => true,
                'data' => $decoded
            ];
        } else {
            return [
                'success' => false,
                'error' => $response['error']['message'] ?? 'Unknown error'
            ];
        }
    }

    /**
     * Call contract for write operations
     */
    private function callContractWrite($data) {
        // Call the Node.js bridge service
        $bridgeUrl = 'http://localhost:3001/blockchain';
        
        $postData = [
            'method' => $data['method'],
            'params' => $data['params']
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $bridgeUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json'
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200) {
            $result = json_decode($response, true);
            if ($result && isset($result['success'])) {
                return $result;
            } else {
                return [
                    'success' => false,
                    'error' => 'Invalid response from blockchain bridge'
                ];
            }
        } else {
            return [
                'success' => false,
                'error' => "Bridge service error (HTTP $httpCode): $response"
            ];
        }
    }

    /**
     * Make HTTP request to blockchain RPC
     */
    private function makeRequest($method, $params) {
        $url = $this->web3Url;
        
        $postData = [
            'jsonrpc' => '2.0',
            'method' => $method,
            'params' => $params,
            'id' => 1
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200) {
            return json_decode($response, true);
        } else {
            throw new Exception("HTTP request failed with code: $httpCode");
        }
    }

    /**
     * Encode function call data (simplified)
     */
    private function encodeFunctionCall($method, $params) {
        // This is a simplified version. In production, you'd use a proper ABI encoder
        $methodSignature = $method . '(' . implode(',', array_fill(0, count($params), 'string')) . ')';
        $methodId = substr(hash('sha3-256', $methodSignature), 0, 8);
        
        // For now, return a placeholder
        return $methodId . '0000000000000000000000000000000000000000000000000000000000000000';
    }

    /**
     * Decode function result (simplified)
     */
    private function decodeFunctionResult($method, $result) {
        // This is a simplified version. In production, you'd use a proper ABI decoder
        return [
            'method' => $method,
            'raw_result' => $result,
            'decoded' => 'Placeholder decoded data'
        ];
    }

    /**
     * Get blockchain explorer URL for transaction
     */
    public function getExplorerUrl($transactionHash) {
        $network = $this->config['blockchain']['network'];
        
        switch ($network) {
            case 'mainnet':
                return "https://etherscan.io/tx/$transactionHash";
            case 'sepolia':
                return "https://sepolia.etherscan.io/tx/$transactionHash";
            case 'goerli':
                return "https://goerli.etherscan.io/tx/$transactionHash";
            case 'localhost':
                return "http://localhost:8545/tx/$transactionHash";
            default:
                return "#";
        }
    }
}
