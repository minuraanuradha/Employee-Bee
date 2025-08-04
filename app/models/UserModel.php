<?php
require_once __DIR__ . '/../config/database.php';

class UserModel {
    private $pdo;

    // Connect to the database
    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    // Create a new employee (signup)
    public function createEmployee($data) {
        try {
            $this->pdo->beginTransaction();
            
            // Generate unique ID using the new method
            $unique_id = $this->generateUniqueID($data);
            
            // Insert into employee_auth table
            $stmt = $this->pdo->prepare("INSERT INTO employee_auth (
                unique_id, email, password, nic_or_national_id, country, birthdate
            ) VALUES (
                :unique_id, :email, :password, :nic_or_national_id, :country, :birthdate
            )");
            
            $stmt->execute([
                ':unique_id' => $unique_id,
                ':email' => $data['email'],
                ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
                ':nic_or_national_id' => $data['nic_or_national_id'] ?? null,
                ':country' => $data['country'] ?? 'SL',
                ':birthdate' => $data['birthdate'] ?? null
            ]);
            
            $employee_id = $this->pdo->lastInsertId();
            
            // Insert into employee_profile table
            $stmt = $this->pdo->prepare("INSERT INTO employee_profile (
                employee_id, full_name, email, phone_number, profile_picture, location, 
                linkedin_url, portfolio_url, resume_path
            ) VALUES (
                :employee_id, :full_name, :email, :phone_number, :profile_picture, :location,
                :linkedin_url, :portfolio_url, :resume_path
            )");
            
            $stmt->execute([
                ':employee_id' => $employee_id,
                ':full_name' => $data['full_name'],
                ':email' => $data['email'],
                ':phone_number' => $data['phone_number'] ?? null,
                ':profile_picture' => $data['profile_picture'] ?? null,
                ':location' => $data['location'] ?? null,
                ':linkedin_url' => $data['linkedin_url'] ?? null,
                ':portfolio_url' => $data['portfolio_url'] ?? null,
                ':resume_path' => $data['resume_path'] ?? null
            ]);
            
            // Insert into employee_career_data table
            $stmt = $this->pdo->prepare("INSERT INTO employee_career_data (
                employee_id, skills, education
            ) VALUES (
                :employee_id, :skills, :education
            )");
            
            $stmt->execute([
                ':employee_id' => $employee_id,
                ':skills' => $data['skills'] ?? null,
                ':education' => $data['education'] ?? null
            ]);
            
            $this->pdo->commit();
            return $employee_id;
            
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }
    
    // Get employee by email (for login)
    public function getEmployeeByEmail($email) {
        $stmt = $this->pdo->prepare("
            SELECT ea.*, ep.full_name, ep.phone_number, ep.profile_picture, ep.location,
                   ep.linkedin_url, ep.portfolio_url, ep.resume_path,
                   ecd.skills, ecd.education
            FROM employee_auth ea
            LEFT JOIN employee_profile ep ON ea.id = ep.employee_id
            LEFT JOIN employee_career_data ecd ON ea.id = ecd.employee_id
            WHERE ea.email = :email
        ");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get employee by ID
    public function getEmployeeById($id) {
        $stmt = $this->pdo->prepare("
            SELECT ea.*, ep.full_name, ep.phone_number, ep.profile_picture, ep.location,
                   ep.linkedin_url, ep.portfolio_url, ep.resume_path,
                   ecd.skills, ecd.education
            FROM employee_auth ea
            LEFT JOIN employee_profile ep ON ea.id = ep.employee_id
            LEFT JOIN employee_career_data ecd ON ea.id = ecd.employee_id
            WHERE ea.id = :id
        ");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Get employee by unique_id
    public function getEmployeeByUniqueId($unique_id) {
        $stmt = $this->pdo->prepare("
            SELECT ea.*, ep.full_name, ep.phone_number, ep.profile_picture, ep.location,
                   ep.linkedin_url, ep.portfolio_url, ep.resume_path,
                   ecd.skills, ecd.education
            FROM employee_auth ea
            LEFT JOIN employee_profile ep ON ea.id = ep.employee_id
            LEFT JOIN employee_career_data ecd ON ea.id = ecd.employee_id
            WHERE ea.unique_id = :unique_id
        ");
        $stmt->execute([':unique_id' => $unique_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Update employee profile
    public function updateEmployeeProfile($employee_id, $data) {
        try {
            $this->pdo->beginTransaction();
            
            // Update employee_auth if needed
            if (isset($data['email']) || isset($data['nic_or_national_id']) || isset($data['country']) || isset($data['birthdate'])) {
                $authFields = [];
                $authParams = [':employee_id' => $employee_id];
                
                if (isset($data['email'])) {
                    $authFields[] = 'email = :email';
                    $authParams[':email'] = $data['email'];
                }
                if (isset($data['nic_or_national_id'])) {
                    $authFields[] = 'nic_or_national_id = :nic_or_national_id';
                    $authParams[':nic_or_national_id'] = $data['nic_or_national_id'];
                }
                if (isset($data['country'])) {
                    $authFields[] = 'country = :country';
                    $authParams[':country'] = $data['country'];
                }
                if (isset($data['birthdate'])) {
                    $authFields[] = 'birthdate = :birthdate';
                    $authParams[':birthdate'] = $data['birthdate'];
                }
                
                $stmt = $this->pdo->prepare("UPDATE employee_auth SET " . implode(', ', $authFields) . " WHERE id = :employee_id");
                $stmt->execute($authParams);
            }
            
            // Update employee_profile
            $profileFields = [];
            $profileParams = [':employee_id' => $employee_id];
            
            $profileColumns = ['full_name', 'email', 'phone_number', 'profile_picture', 'location', 'linkedin_url', 'portfolio_url', 'resume_path'];
            foreach ($profileColumns as $column) {
                if (isset($data[$column])) {
                    $profileFields[] = "$column = :$column";
                    $profileParams[":$column"] = $data[$column];
                }
            }
            
            if (!empty($profileFields)) {
                $stmt = $this->pdo->prepare("UPDATE employee_profile SET " . implode(', ', $profileFields) . " WHERE employee_id = :employee_id");
                $stmt->execute($profileParams);
            }
            
            // Update employee_career_data
            $careerFields = [];
            $careerParams = [':employee_id' => $employee_id];
            
            $careerColumns = ['skills', 'education'];
            foreach ($careerColumns as $column) {
                if (isset($data[$column])) {
                    $careerFields[] = "$column = :$column";
                    $careerParams[":$column"] = $data[$column];
                }
            }
            
            if (!empty($careerFields)) {
                $stmt = $this->pdo->prepare("UPDATE employee_career_data SET " . implode(', ', $careerFields) . " WHERE employee_id = :employee_id");
                $stmt->execute($careerParams);
            }
            
            $this->pdo->commit();
            return true;
            
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    // Generate unique ID using your method
    private function generateUniqueID($data) {
        $nic = $data['nic_or_national_id'] ?? '';
        $country = strtoupper($data['country'] ?? 'SL'); // Default to SL
        $last4 = substr(preg_replace('/[^0-9]/', '', $nic), -4); // Extract last 4 digits only
        $unique_id = 'BEE-' . $country . $last4;
        
        // Check if unique_id already exists and add a random suffix if needed
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM employee_auth WHERE unique_id = :unique_id");
        $stmt->execute([':unique_id' => $unique_id]);
        
        if ($stmt->fetchColumn() > 0) {
            $suffix = rand(100, 999);
            $unique_id = $unique_id . '-' . $suffix;
        }
        
        return $unique_id;
    }
    
    // Check if email already exists
    public function emailExists($email) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM employee_auth WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn() > 0;
    }
    
    // Check if NIC already exists
    public function nicExists($nic) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM employee_auth WHERE nic_or_national_id = :nic");
        $stmt->execute([':nic' => $nic]);
        return $stmt->fetchColumn() > 0;
    }

    // Search employees for company add (AJAX), include status for this company
    public function searchEmployees($query, $company_id = null) {
        $sql = "
            SELECT ep.employee_id, ep.full_name, ep.email, ea.unique_id, ep.profile_picture,
                   ce.status
            FROM employee_profile ep
            JOIN employee_auth ea ON ep.employee_id = ea.id
            LEFT JOIN company_employees ce
                ON ce.employee_unique_id = ea.unique_id
                AND ce.company_id = :company_id
            WHERE ep.full_name LIKE :q OR ep.email LIKE :q OR ea.unique_id LIKE :q
            LIMIT 10
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':q' => '%' . $query . '%',
            ':company_id' => $company_id
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add employee to company, prevent duplicates, with role, skills, start_date
    public function addEmployeeToCompany($company_id, $unique_id, $role_title, $skills_on_hire, $start_date) {
        // Check if already added
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM company_employees WHERE company_id = ? AND employee_unique_id = ?");
        $stmt->execute([$company_id, $unique_id]);
        if ($stmt->fetchColumn() > 0) {
            return ['success' => false, 'message' => 'Employee already added!'];
        }
        // Insert
        $stmt = $this->pdo->prepare("INSERT INTO company_employees (company_id, employee_unique_id, role_title, skills_on_hire, start_date, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$company_id, $unique_id, $role_title, $skills_on_hire, $start_date, 'active']);
        return ['success' => true, 'message' => 'Employee added successfully!'];
    }

    public function getActiveEmployees($company_id) {
        $sql = "
            SELECT ep.full_name, ep.email, ep.profile_picture,
                ce.role_title, ce.start_date, ce.end_date, ce.status
            FROM company_employees ce
            LEFT JOIN employee_auth ea ON ce.employee_unique_id = ea.unique_id
            LEFT JOIN employee_profile ep ON ep.employee_id = ea.id
            WHERE ce.company_id = :company_id AND ce.status = 'active'
            ORDER BY ce.start_date DESC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':company_id' => $company_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getInactiveEmployees($company_id) {
    $sql = "
        SELECT ep.full_name, ep.email, ep.profile_picture,
               ce.role_title, ce.start_date, ce.end_date, ce.status
        FROM company_employees ce
        LEFT JOIN employee_auth ea ON ce.employee_unique_id = ea.unique_id
        LEFT JOIN employee_profile ep ON ep.employee_id = ea.id
        WHERE ce.company_id = :company_id AND ce.status = 'inactive'
        ORDER BY ce.end_date DESC
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':company_id' => $company_id]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // Update employee status and add feedback/skills
    public function updateEmployeeStatus($company_id, $employee_unique_id, $data) {
        try {
            $this->pdo->beginTransaction();
            
            // Update company_employees table
            $updateFields = [];
            $updateParams = [':company_id' => $company_id, ':employee_unique_id' => $employee_unique_id];
            
            if (isset($data['status'])) {
                $updateFields[] = 'status = :status';
                $updateParams[':status'] = $data['status'];
            }
            
            if (isset($data['role_title'])) {
                $updateFields[] = 'role_title = :role_title';
                $updateParams[':role_title'] = $data['role_title'];
            }
            
            if (isset($data['end_date']) && $data['end_date']) {
                $updateFields[] = 'end_date = :end_date';
                $updateParams[':end_date'] = $data['end_date'];
            }
            
            if (!empty($updateFields)) {
                $stmt = $this->pdo->prepare("UPDATE company_employees SET " . implode(', ', $updateFields) . " WHERE company_id = :company_id AND employee_unique_id = :employee_unique_id");
                $stmt->execute($updateParams);
            }
            
            // Get the company_employee record ID for feedback
            $stmt = $this->pdo->prepare("SELECT id FROM company_employees WHERE company_id = :company_id AND employee_unique_id = :employee_unique_id");
            $stmt->execute([':company_id' => $company_id, ':employee_unique_id' => $employee_unique_id]);
            $companyEmployeeId = $stmt->fetchColumn();
            
            // Add feedback record if provided
            if ($companyEmployeeId && (isset($data['feedback_text']) || isset($data['new_skills']))) {
                $feedbackType = 'comment';
                if (isset($data['role_title']) && $data['role_title']) {
                    $feedbackType = 'promotion';
                }
                
                $stmt = $this->pdo->prepare("INSERT INTO employee_feedback (
                    company_employee_id, feedback_type, feedback_text, updated_role, new_skills
                ) VALUES (
                    :company_employee_id, :feedback_type, :feedback_text, :updated_role, :new_skills
                )");
                
                $stmt->execute([
                    ':company_employee_id' => $companyEmployeeId,
                    ':feedback_type' => $feedbackType,
                    ':feedback_text' => $data['feedback_text'] ?? '',
                    ':updated_role' => $data['role_title'] ?? null,
                    ':new_skills' => $data['new_skills'] ?? null
                ]);
            }
            
            $this->pdo->commit();
            return ['success' => true, 'message' => 'Employee updated successfully!'];
            
        } catch (Exception $e) {
            $this->pdo->rollBack();
            return ['success' => false, 'message' => 'Error updating employee: ' . $e->getMessage()];
        }
    }
    
    // Get employee details for update form
    public function getEmployeeForUpdate($company_id, $employee_unique_id) {
        $stmt = $this->pdo->prepare("
            SELECT ce.*, ea.unique_id, ep.full_name, ep.email, ep.profile_picture,
                   ecd.skills, ecd.education
            FROM company_employees ce
            LEFT JOIN employee_auth ea ON ce.employee_unique_id = ea.unique_id
            LEFT JOIN employee_profile ep ON ea.id = ep.employee_id
            LEFT JOIN employee_career_data ecd ON ea.id = ecd.employee_id
            WHERE ce.company_id = :company_id AND ce.employee_unique_id = :employee_unique_id
        ");
        $stmt->execute([
            ':company_id' => $company_id,
            ':employee_unique_id' => $employee_unique_id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Get employee feedback history
    public function getEmployeeFeedback($company_id, $employee_unique_id) {
        $stmt = $this->pdo->prepare("
            SELECT ef.*, ce.role_title as current_role
            FROM employee_feedback ef
            JOIN company_employees ce ON ef.company_employee_id = ce.id
            WHERE ce.company_id = :company_id AND ce.employee_unique_id = :employee_unique_id
            ORDER BY ef.date_recorded DESC
        ");
        $stmt->execute([
            ':company_id' => $company_id,
            ':employee_unique_id' => $employee_unique_id
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
        // Get employee's complete employment history
        public function getEmployeeHistory($employee_unique_id) {
            $stmt = $this->pdo->prepare("
                SELECT ce.*, cp.company_name, cp.industry, cp.logo_path,
                       ef.feedback_text, ef.new_skills, ef.feedback_type, ef.date_recorded
                FROM company_employees ce
                LEFT JOIN company_profile cp ON ce.company_id = cp.id
                LEFT JOIN employee_feedback ef ON ce.id = ef.company_employee_id
                WHERE ce.employee_unique_id = :employee_unique_id
                ORDER BY ce.start_date DESC, ef.date_recorded DESC
            ");
            $stmt->execute([':employee_unique_id' => $employee_unique_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        // Get employee career statistics
        public function getEmployeeCareerStats($employee_unique_id) {
            // Get basic employment stats
            $stmt = $this->pdo->prepare("
                SELECT
                    COUNT(DISTINCT ce.company_id) as companies_worked,
                    COUNT(DISTINCT ce.id) as total_positions,
                    MIN(ce.start_date) as career_start,
                    MAX(CASE WHEN ce.status = 'active' THEN ce.start_date ELSE ce.end_date END) as last_activity
                FROM company_employees ce
                WHERE ce.employee_unique_id = :employee_unique_id
            ");
            $stmt->execute([':employee_unique_id' => $employee_unique_id]);
            $basicStats = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Calculate total experience in days
            $totalExperience = 0;
            $stmt = $this->pdo->prepare("
                SELECT start_date, end_date, status
                FROM company_employees
                WHERE employee_unique_id = :employee_unique_id
            ");
            $stmt->execute([':employee_unique_id' => $employee_unique_id]);
            $positions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($positions as $position) {
                $startDate = new DateTime($position['start_date']);
                $endDate = $position['end_date'] ? new DateTime($position['end_date']) : new DateTime();
                $diff = $startDate->diff($endDate);
                $totalExperience += $diff->days;
            }
            
            // Get unique skills count
            $stmt = $this->pdo->prepare("
                SELECT GROUP_CONCAT(DISTINCT ef.new_skills) as all_skills
                FROM employee_feedback ef
                JOIN company_employees ce ON ef.company_employee_id = ce.id
                WHERE ce.employee_unique_id = :employee_unique_id AND ef.new_skills IS NOT NULL
            ");
            $stmt->execute([':employee_unique_id' => $employee_unique_id]);
            $skillsData = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $uniqueSkills = 0;
            if ($skillsData['all_skills']) {
                $allSkills = explode(',', $skillsData['all_skills']);
                $uniqueSkills = count(array_unique(array_map('trim', $allSkills)));
            }
            
            return [
                'companies_worked' => $basicStats['companies_worked'] ?? 0,
                'total_positions' => $basicStats['total_positions'] ?? 0,
                'career_start' => $basicStats['career_start'],
                'total_experience_days' => $totalExperience,
                'total_experience_years' => round($totalExperience / 365, 1),
                'skills_acquired' => $uniqueSkills,
                'last_activity' => $basicStats['last_activity']
            ];
        }
        
        // Get employee feedback and achievements
        public function getEmployeeAchievements($employee_unique_id) {
            $stmt = $this->pdo->prepare("
                SELECT ef.*, ce.role_title, cp.company_name
                FROM employee_feedback ef
                JOIN company_employees ce ON ef.company_employee_id = ce.id
                JOIN company_profile cp ON ce.company_id = cp.id
                WHERE ce.employee_unique_id = :employee_unique_id
                ORDER BY ef.date_recorded DESC
            ");
            $stmt->execute([':employee_unique_id' => $employee_unique_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        // Get blockchain transaction history for employee
        public function getEmployeeBlockchainTransactions($employee_unique_id) {
            $stmt = $this->pdo->prepare("
                SELECT * FROM blockchain_transactions
                WHERE employee_id = :employee_unique_id
                ORDER BY created_at DESC
            ");
            $stmt->execute([':employee_unique_id' => $employee_unique_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
    }
    ?>