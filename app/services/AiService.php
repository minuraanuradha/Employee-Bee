<?php

require_once __DIR__ . '/../models/UserModel.php';

class AiService {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new UserModel();
    }
    
    /**
     * Generate career insights for an employee based on their career data
     * This is a placeholder implementation until the actual AI model is ready
     * 
     * @param string $employee_unique_id
     * @return array Career insights data
     */
    public function generateCareerInsights($employee_unique_id) {
        // Get employee data
        $employee = $this->userModel->getEmployeeByUniqueId($employee_unique_id);
        if (!$employee) {
            return ['error' => 'Employee not found'];
        }
        
        // Get employee history
        $history = $this->userModel->getEmployeeHistory($employee_unique_id);
        
        // Get employee career stats
        $stats = $this->userModel->getEmployeeCareerStats($employee_unique_id);
        
        // Get employee achievements
        $achievements = $this->userModel->getEmployeeAchievements($employee_unique_id);
        
        // For now, we'll return simulated data until the actual AI model is ready
        // In the future, this will call the trained model via API
        return $this->simulateAiInsights($employee, $history, $stats, $achievements);
    }
    
    /**
     * Simulate AI insights until the actual model is ready
     * 
     * @param array $employee
     * @param array $history
     * @param array $stats
     * @param array $achievements
     * @return array
     */
    private function simulateAiInsights($employee, $history, $stats, $achievements) {
        // Extract skills from history and current data
        $allSkills = [];
        if (!empty($employee['skills'])) {
            $allSkills = array_merge($allSkills, array_map('trim', explode(',', $employee['skills'])));
        }
        
        foreach ($history as $position) {
            if (!empty($position['skills_on_hire'])) {
                $allSkills = array_merge($allSkills, array_map('trim', explode(',', $position['skills_on_hire'])));
            }
            if (!empty($position['current_skills'])) {
                $allSkills = array_merge($allSkills, array_map('trim', explode(',', $position['current_skills'])));
            }
        }
        
        // Remove duplicates and empty values
        $allSkills = array_filter(array_unique($allSkills));
        
        // Simulate AI-generated insights
        $insights = [
            'employee_id' => $employee['unique_id'],
            'generated_at' => date('Y-m-d H:i:s'),
            'suggested_role' => $this->generateSuggestedRole($allSkills, $history),
            'skills_to_learn' => $this->generateSkillsToLearn($allSkills, $history),
            'action_plan' => $this->generateActionPlan($allSkills, $history),
            'career_insight' => $this->generateCareerInsight($history, $stats),
            'market_analysis' => $this->generateMarketAnalysis($allSkills),
            'performance_prediction' => $this->generatePerformancePrediction($stats, $achievements)
        ];
        
        return $insights;
    }
    
    /**
     * Generate a suggested role based on current skills and experience
     * 
     * @param array $skills
     * @param array $history
     * @return string
     */
    private function generateSuggestedRole($skills, $history) {
        // Simple rule-based suggestions for now
        $skillCount = count($skills);
        $positionsCount = count($history);
        
        if ($skillCount >= 8 && $positionsCount >= 3) {
            return "Senior Developer";
        } elseif ($skillCount >= 5 && $positionsCount >= 2) {
            return "Full Stack Developer";
        } elseif ($skillCount >= 3) {
            return "Frontend Developer";
        } else {
            return "Junior Developer";
        }
    }
    
    /**
     * Generate skills to learn based on current skills and career path
     * 
     * @param array $skills
     * @param array $history
     * @return string
     */
    private function generateSkillsToLearn($skills, $history) {
        // Simple rule-based suggestions for now
        $currentSkills = array_map('strtolower', $skills);
        
        if (in_array('react', $currentSkills) || in_array('javascript', $currentSkills)) {
            return "Node.js, Express, MongoDB";
        } elseif (in_array('python', $currentSkills)) {
            return "Django, Flask, SQL";
        } elseif (in_array('java', $currentSkills)) {
            return "Spring Boot, Hibernate, Microservices";
        } else {
            return "React, JavaScript, Node.js";
        }
    }
    
    /**
     * Generate an action plan based on skills and experience
     * 
     * @param array $skills
     * @param array $history
     * @return string
     */
    private function generateActionPlan($skills, $history) {
        $skillCount = count($skills);
        $positionsCount = count($history);
        
        if ($skillCount >= 5 && $positionsCount >= 2) {
            return "Apply for senior positions, build a portfolio project, network with industry professionals";
        } elseif ($skillCount >= 3) {
            return "Take advanced courses, contribute to open source projects, seek mentorship";
        } else {
            return "Complete online certifications, build personal projects, apply for internships";
        }
    }
    
    /**
     * Generate career insight based on history and stats
     * 
     * @param array $history
     * @param array $stats
     * @return string
     */
    private function generateCareerInsight($history, $stats) {
        $positionsCount = count($history);
        $experienceYears = $stats['total_experience_years'] ?? 0;
        
        if ($positionsCount >= 3 && $experienceYears >= 2) {
            return "You've shown consistent career growth with multiple role transitions. Most professionals with similar profiles become team leads within 1-2 years.";
        } elseif ($positionsCount >= 2) {
            return "You've gained experience across different roles. Consider specializing in a specific domain for accelerated growth.";
        } else {
            return "You're building a solid foundation. Focus on mastering core skills before moving to advanced topics.";
        }
    }
    
    /**
     * Generate market analysis based on skills
     * 
     * @param array $skills
     * @return string
     */
    private function generateMarketAnalysis($skills) {
        $currentSkills = array_map('strtolower', $skills);
        
        if (in_array('react', $currentSkills) && in_array('node.js', $currentSkills)) {
            return "Full-stack developers with React/Node.js skills are in high demand with 25% higher salary potential.";
        } elseif (in_array('python', $currentSkills)) {
            return "Python developers have excellent opportunities in data science and AI fields.";
        } elseif (in_array('java', $currentSkills)) {
            return "Java developers continue to have strong demand in enterprise applications.";
        } else {
            return "Frontend developers with modern framework skills have growing opportunities.";
        }
    }
    
    /**
     * Generate performance prediction based on stats and achievements
     * 
     * @param array $stats
     * @param array $achievements
     * @return string
     */
    private function generatePerformancePrediction($stats, $achievements) {
        $achievementsCount = count($achievements);
        $skillsAcquired = $stats['skills_acquired'] ?? 0;
        
        if ($achievementsCount >= 3 && $skillsAcquired >= 10) {
            return "Excellent performance trajectory. On track for leadership roles.";
        } elseif ($achievementsCount >= 1 && $skillsAcquired >= 5) {
            return "Good performance with steady skill growth. Continue current trajectory.";
        } else {
            return "Solid foundation. Focus on skill acquisition and achievement documentation.";
        }
    }
    
    /**
     * Save insights to database (placeholder for future implementation)
     * 
     * @param array $insights
     * @return bool
     */
    public function saveInsights($insights) {
        // In the future, we'll save insights to a database
        // For now, we'll just return true
        return true;
    }
    
    /**
     * Get saved insights for an employee (placeholder for future implementation)
     * 
     * @param string $employee_unique_id
     * @return array
     */
    public function getSavedInsights($employee_unique_id) {
        // In the future, we'll retrieve saved insights from a database
        // For now, we'll return empty array
        return [];
    }
}