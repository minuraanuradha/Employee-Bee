<?php
require_once '../app/config/database.php';

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
}
?>