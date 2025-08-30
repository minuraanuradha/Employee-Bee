EMPLOYEE-BEE README

==================================

Project Name : EMPLOYEE-BEE 
Developer : Minura Anuradha Amarasiri Jayasingha 
Student ID: 2433277
Unit Name : Undegraduate Project
Unit Code : CIS017-3
Git Hub Link: https://github.com/minuraanuradha/Employee-Bee

==================================

Application Overview
--------------------

Employee-Bee is a comprehensive blockchain-powered employee record management platform designed to provide secure, transparent, and verifiable employment history tracking. The system allows both employees and companies to maintain detailed career records that are stored on the blockchain for immutability and verification.

The platform offers features for:
- Employee profile management with skills, education, and career history
- Company dashboard for managing employee records
- Blockchain-based employment verification
- AI-powered career insights and recommendations
- Secure authentication and data management

The application is built using PHP for the backend with a MySQL database for primary storage, while leveraging blockchain technology for immutable record keeping. The frontend uses HTML, CSS (with Tailwind), and JavaScript for a responsive user interface.

Installation Instructions
--------------------------

1. Clone or download the Employee-Bee repository to your local machine.

2. Set up your web server environment:
   - Install Apache or Nginx web server
   - Install PHP 8.0 or higher
   - Install MySQL 8.0 or higher

3. Configure the database:
   - Create a MySQL database named 'employee_bee_db'
   - Import the database schema from 'database/employee_bee_db.sql'
   - Update database credentials in 'app/config/database.php' if needed

4. Set up environment variables:
   - Copy 'env_template.txt' to '.env'
   - Update the values in '.env' according to your environment
   - Configure database, blockchain, and AI service settings

5. Install PHP dependencies:
   - Run 'composer install' in the project root directory

6. Install Node.js dependencies:
   - Run 'npm install' in the project root directory

7. Set up the blockchain components:
   - Install Node.js and npm
   - Navigate to 'blockchain/bridge/' directory
   - Run 'npm install' to install bridge dependencies
   - Configure blockchain settings in '.env' file

8. Set up the AI service:
   - Navigate to 'ai/career-insight-predictor-v2/' directory
   - Install Python dependencies from 'requirements.txt'
   - Run the AI service using the instructions in the AI module README

9. Configure file permissions:
   - Ensure the 'storage/' directory is writable by the web server
   - Ensure the 'public/' directory is accessible by the web server

10. Access the application:
    - Point your web browser to the application URL
    - Default login credentials can be found in the database

Key Features
------------

1. Employee Management:
   - Comprehensive employee profiles with personal information, skills, and education
   - Career history tracking with companies, roles, and duration
   - Resume upload and management
   - Profile picture and portfolio management

2. Company Management:
   - Company profiles with business information
   - Employee management dashboard
   - Active and inactive employee tracking
   - Employee search and filtering capabilities

3. Blockchain Integration:
   - Immutable employment record storage on blockchain
   - Employment verification through blockchain records
   - Transparent career history tracking
   - Transaction history for all blockchain operations

4. AI-Powered Career Insights:
   - Personalized career recommendations based on skills and experience
   - Suggested learning paths and skill development
   - Role progression predictions
   - Actionable career development plans

5. Data Export and Reporting:
   - Employee history export functionality
   - Company data export capabilities
   - Analytics dashboard for companies
   - Career statistics and insights

6. Security Features:
   - Secure user authentication
   - Password hashing for data protection
   - Session management
   - SSL support for secure communication

Requirements
------------

System Requirements:
- Web Server: Apache 2.4+ or Nginx
- PHP: 8.0 or higher
- MySQL: 8.0 or higher
- Node.js: 16.0 or higher
- Python: 3.8 or higher (for AI components)
- Composer: Latest version
- npm: Latest version

Browser Compatibility:
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
