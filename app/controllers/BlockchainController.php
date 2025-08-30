<?php
require_once '../app/services/BlockchainService.php';

class BlockchainController {
    private $blockchainService;

    public function __construct() {
        $this->blockchainService = new BlockchainService();
    }

    /**
     * Test blockchain connection
     */
    public function testConnection() {
        $result = $this->blockchainService->checkConnection();
        
        if ($result['success']) {
            return [
                'success' => true,
                'message' => 'Blockchain connection successful',
                'block_number' => $result['block_number']
            ];
        } else {
            return [
                'success' => false,
                'error' => $result['error']
            ];
        }
    }

    /**
     * Add employee to blockchain (called by company when hiring)
     */
    public function hireEmployee($employeeId, $companyId, $roleTitle, $skillsOnHire, $startDate) {
        // Validate inputs
        if (empty($employeeId) || empty($companyId) || empty($roleTitle)) {
            return [
                'success' => false,
                'error' => 'Missing required fields'
            ];
        }

        // Convert start date to timestamp if it's a string
        if (is_string($startDate)) {
            $startDate = strtotime($startDate);
        }

        $result = $this->blockchainService->addEmploymentRecord(
            $employeeId,
            $companyId,
            $roleTitle,
            $skillsOnHire,
            $startDate
        );

        if ($result['success']) {
            // Log the transaction
            $this->logBlockchainTransaction($employeeId, 'hire', $result['transaction_hash']);
            
            // Get the record index (assuming it's the last record for this employee)
            $records = $this->getEmployeeRecords($employeeId);
            if ($records['success'] && !empty($records['records'])) {
                $recordIndex = count($records['records']) - 1;
                $this->logBlockchainVerification($employeeId, $companyId, $recordIndex);
            }
        }

        return $result;
    }

    /**
     * Update employee record (promotion, role change, etc.)
     */
    public function updateEmployeeRecord($employeeId, $recordIndex, $newRoleTitle, $newSkillsOnHire, $newStatus, $feedbackText) {
        $result = $this->blockchainService->updateEmploymentRecord(
            $employeeId,
            $recordIndex,
            $newRoleTitle,
            $newSkillsOnHire,
            $newStatus,
            $feedbackText
        );

        if ($result['success']) {
            $this->logBlockchainTransaction($employeeId, 'update', $result['transaction_hash']);
        }

        return $result;
    }

    /**
     * End employee employment
     */
    public function endEmployment($employeeId, $recordIndex, $endDate, $newStatus, $feedbackText, $newSkills) {
        // Convert end date to timestamp if it's a string
        if (is_string($endDate)) {
            $endDate = strtotime($endDate);
        }

        $result = $this->blockchainService->exitEmploymentRecord(
            $employeeId,
            $recordIndex,
            $endDate,
            $newStatus,
            $feedbackText,
            $newSkills
        );

        if ($result['success']) {
            $this->logBlockchainTransaction($employeeId, 'exit', $result['transaction_hash']);
        }

        return $result;
    }

    /**
     * Get employee's blockchain records
     */
    public function getEmployeeRecords($employeeId) {
        return $this->blockchainService->getEmployeeRecords($employeeId);
    }

    /**
     * Get blockchain contract information
     */
    public function getContractInfo() {
        return $this->blockchainService->getContractInfo();
    }

    /**
     * Get blockchain explorer URL for a transaction
     */
    public function getTransactionUrl($transactionHash) {
        return $this->blockchainService->getExplorerUrl($transactionHash);
    }

    /**
     * Verify employee employment history
     */
    public function verifyEmploymentHistory($employeeId) {
        $records = $this->getEmployeeRecords($employeeId);
        
        if (!$records['success']) {
            return [
                'success' => false,
                'error' => 'Unable to fetch blockchain records',
                'verified' => false
            ];
        }

        $verifiedRecords = [];
        $totalExperience = 0;

        foreach ($records['records'] as $record) {
            $startDate = $record['startDate'];
            $endDate = $record['endDate'] ?: time(); // If no end date, use current time
            
            $duration = $endDate - $startDate;
            $totalExperience += $duration;

            $verifiedRecords[] = [
                'company_id' => $record['companyId'],
                'role_title' => $record['roleTitle'],
                'skills_on_hire' => $record['skillsOnHire'],
                'new_skills' => $record['newSkills'],
                'start_date' => date('Y-m-d', $startDate),
                'end_date' => $endDate ? date('Y-m-d', $endDate) : 'Present',
                'status' => $record['status'],
                'feedback' => $record['feedbackText'],
                'duration_days' => floor($duration / 86400), // Convert to days
                'block_timestamp' => date('Y-m-d H:i:s', $record['blockTimestamp'])
            ];
        }

        return [
            'success' => true,
            'verified' => true,
            'total_records' => count($verifiedRecords),
            'total_experience_days' => floor($totalExperience / 86400),
            'total_experience_years' => round($totalExperience / (86400 * 365), 1),
            'records' => $verifiedRecords
        ];
    }

    /**
     * Log blockchain transaction to database
     */
    private function logBlockchainTransaction($employeeId, $action, $transactionHash) {
        try {
            $database = new Database();
            $pdo = $database->getConnection();
            
            $stmt = $pdo->prepare("INSERT INTO blockchain_transactions (
                employee_id, action, transaction_hash, created_at
            ) VALUES (
                :employee_id, :action, :transaction_hash, NOW()
            )");
            
            $stmt->execute([
                ':employee_id' => $employeeId,
                ':action' => $action,
                ':transaction_hash' => $transactionHash
            ]);
            
        } catch (Exception $e) {
            // Log error but don't fail the main operation
            error_log("Failed to log blockchain transaction: " . $e->getMessage());
        }
    }

    /**
     * Get blockchain transaction history
     */
    public function getTransactionHistory($employeeId = null, $limit = 50) {
        try {
            $database = new Database();
            $pdo = $database->getConnection();
            
            $sql = "SELECT * FROM blockchain_transactions";
            $params = [];
            
            if ($employeeId) {
                $sql .= " WHERE employee_id = :employee_id";
                $params[':employee_id'] = $employeeId;
            }
            
            $sql .= " ORDER BY created_at DESC LIMIT :limit";
            $params[':limit'] = $limit;
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            
            return [
                'success' => true,
                'transactions' => $stmt->fetchAll(PDO::FETCH_ASSOC)
            ];
            
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => 'Failed to fetch transaction history: ' . $e->getMessage()
            ];
        }
    }
    
    /**
     * Log blockchain verification record
     */
    private function logBlockchainVerification($employeeId, $companyId, $recordIndex) {
        try {
            $database = new Database();
            $pdo = $database->getConnection();
            
            $stmt = $pdo->prepare("INSERT INTO blockchain_verification (
                employee_id, company_id, record_index, is_verified, verification_date
            ) VALUES (
                :employee_id, :company_id, :record_index, 1, NOW()
            ) ON DUPLICATE KEY UPDATE
                is_verified = 1,
                verification_date = NOW(),
                last_updated = NOW()");
            
            $stmt->execute([
                ':employee_id' => $employeeId,
                ':company_id' => $companyId,
                ':record_index' => $recordIndex
            ]);
            
        } catch (Exception $e) {
            // Log error but don't fail the main operation
            error_log("Failed to log blockchain verification: " . $e->getMessage());
        }
    }
}