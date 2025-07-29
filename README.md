# 🐝 Employee-Bee

**Blockchain-Powered Employee Record Management Platform**

Employee-Bee is a revolutionary platform that combines traditional web technologies with blockchain innovation to create tamper-proof, verifiable employment records. Built with PHP backend, modern frontend, and Ethereum smart contracts.

![Main UI Colors](https://img.shields.io/badge/Colors-Orange%20%7C%20Black%20%7C%20White%20%7C%20Gray-orange)
![PHP](https://img.shields.io/badge/PHP-8.0%2B-blue)
![MySQL](https://img.shields.io/badge/MySQL-8.0%2B-orange)
![Blockchain](https://img.shields.io/badge/Blockchain-Ethereum-purple)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.4%2B-teal)

## 🌟 Features

### For Employees
- **Digital Profile Management** - Comprehensive profile with skills, achievements, and work history
- **Blockchain Verification** - Immutable employment records stored on blockchain
- **Resume Management** - Upload and manage professional documents
- **Career Insights** - Track career progression and achievements
- **Privacy Control** - Control what information is visible to employers

### for Companies
- **Employee Management** - Add, update, and manage employee records
- **Blockchain Integration** - Store employment records on blockchain for verification
- **Company Branding** - Custom logos and company profiles
- **Verification System** - Verify employee records across companies
- **Data Export** - Export employee data and reports

### Core Technology
- **Immutable Records** - Employment data stored on Ethereum blockchain
- **Smart Contracts** - Automated verification and transfer of employment records
- **AI Integration** - Optional AI-powered insights and recommendations
- **Modern UI** - Responsive design with Tailwind CSS
- **Security First** - Secure authentication and data protection

## 🚀 Quick Start

### Prerequisites

- **PHP 7.4+** with extensions: PDO, MySQL, JSON, mbstring, OpenSSL, cURL
- **MySQL 8.0+** or MariaDB 10.3+
- **Node.js 14+** (for blockchain features)
- **Web Server** (Apache/Nginx)
- **Composer** (PHP package manager)

### 1. Clone Repository

```bash
git clone https://github.com/yourusername/Employee-Bee.git
cd Employee-Bee
```

### 2. Environment Setup

```bash
# Copy environment template
cp env_template.txt .env

# Run setup script
php configure_env.php
```

### 3. Configure Environment

Edit `.env` file with your configuration:

```env
# Database Configuration
DB_HOST=localhost
DB_NAME=employee_bee_db
DB_USER=your_username
DB_PASS=your_password

# Application Settings
APP_URL=http://localhost/Employee-Bee
APP_KEY=your_secure_random_key_here
APP_DEBUG=false  # Set to false in production

# Blockchain (Optional)
BLOCKCHAIN_RPC_URL=http://127.0.0.1:8545
BLOCKCHAIN_PRIVATE_KEY=your_private_key
```

### 4. Database Setup

```bash
# Create database
mysql -u root -p -e "CREATE DATABASE employee_bee_db;"

# Import database schema
mysql -u root -p employee_bee_db < database/employee_bee_db.sql
```

### 5. Web Server Configuration

#### Apache Configuration

```apache
<VirtualHost *:80>
    DocumentRoot /path/to/Employee-Bee/public
    ServerName employeebee.local
    
    <Directory /path/to/Employee-Bee/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

#### Nginx Configuration

```nginx
server {
    listen 80;
    server_name employeebee.local;
    root /path/to/Employee-Bee/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?path=$uri&$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### 6. Build Assets

```bash
# Install Node.js dependencies
npm install

# Build CSS with Tailwind
npm run build

# Watch for changes during development
npm run watch
```

### 7. Blockchain Setup (Optional)

For blockchain features, follow the [Blockchain Setup Guide](BLOCKCHAIN_SETUP.md):

```bash
# Install blockchain tools
npm install -g ganache-cli hardhat

# Start local blockchain
ganache-cli --deterministic

# Deploy smart contracts
cd blockchain && npx hardhat run scripts/deploy.js --network localhost
```

## 📁 Project Structure

```
Employee-Bee/
├── 📁 app/                    # Application Core
│   ├── 📁 config/            # Configuration files
│   ├── 📁 controllers/       # MVC Controllers
│   ├── 📁 models/           # Data Models
│   └── 📁 services/         # Business Logic Services
├── 📁 blockchain/            # Blockchain Infrastructure
│   ├── 📁 contracts/        # Smart Contracts
│   ├── 📁 bridge/           # PHP-Blockchain Bridge
│   └── 📁 scripts/          # Deployment Scripts
├── 📁 database/              # Database Files
│   ├── employee_bee_db.sql  # Database Schema
│   └── 📁 backups/         # Database Backups
├── 📁 public/                # Web Root
│   ├── index.php           # Entry Point
│   ├── 📁 assets/          # Static Assets
│   └── 📁 css/             # Compiled CSS
├── 📁 resources/             # Application Resources
│   ├── 📁 views/           # PHP Templates
│   ├── 📁 css/             # Source CSS
│   └── 📁 js/              # JavaScript Files
├── 📁 storage/               # Application Storage
│   ├── 📁 logs/            # Log Files
│   └── 📁 uploads/         # File Uploads
├── .env                      # Environment Configuration
├── configure_env.php         # Setup Script
└── README.md                 # This File
```

## 🎨 User Interface

The application features a modern, responsive design using [[memory:2893280]]:

- **Primary Colors**: Orange, Black, White
- **Secondary Colors**: Dark Gray, Light Gray
- **Framework**: Tailwind CSS 3.4+
- **Icons**: Custom SVG icon set
- **Typography**: Clean, professional fonts
- **Responsive**: Mobile-first design approach

## 🔧 API Endpoints

### Authentication
- `POST /auth/login` - User/Company login
- `POST /auth/logout` - Logout
- `POST /auth/signup/employee` - Employee registration
- `POST /auth/signup/company` - Company registration

### Employee Management
- `GET /employee/profile` - Get employee profile
- `PUT /employee/profile` - Update employee profile
- `POST /employee/upload/resume` - Upload resume
- `GET /employee/history` - Employment history

### Company Management  
- `GET /company/dashboard` - Company dashboard
- `GET /company/employees` - List employees
- `POST /company/employee/add` - Add employee
- `PUT /company/employee/{id}` - Update employee

### Blockchain Integration
- `POST /blockchain/record/add` - Add employment record to blockchain
- `GET /blockchain/record/{id}` - Verify employment record
- `POST /blockchain/record/transfer` - Transfer employee between companies

## 🔒 Security Features

- **Password Hashing** - bcrypt with salt
- **Session Management** - Secure session handling
- **Input Validation** - Comprehensive input sanitization
- **File Upload Security** - Type and size restrictions
- **SQL Injection Protection** - Prepared statements
- **XSS Prevention** - Output escaping
- **CSRF Protection** - Token-based protection

## 🧪 Testing

```bash
# Run PHP tests
php resources/views/test/test.php

# Test database connection
php resources/views/test/test_db.php

# Test blockchain integration
php resources/views/test/blockchain_test.php
```

## 🚀 Deployment

### Production Checklist

- [ ] Set `APP_DEBUG=false` in .env
- [ ] Generate secure `APP_KEY`
- [ ] Configure production database
- [ ] Set up SSL certificates
- [ ] Configure web server security headers
- [ ] Set up backup systems
- [ ] Deploy smart contracts to mainnet
- [ ] Configure monitoring and logging

### Docker Deployment

```dockerfile
# Dockerfile example
FROM php:8.0-apache

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html/storage
```

## 🤝 Contributing

1. Fork the repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open Pull Request

### Development Guidelines

- Follow PSR-12 coding standards for PHP
- Use semantic commit messages
- Write tests for new features
- Update documentation
- Ensure blockchain integration works

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

- **Documentation**: Check this README and [Blockchain Setup Guide](BLOCKCHAIN_SETUP.md)
- **Issues**: Open a GitHub issue for bugs or feature requests
- **Community**: Join our Discord community
- **Email**: support@employeebee.com

## 🙏 Acknowledgements

- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS framework
- [Ethereum](https://ethereum.org) - Blockchain platform
- [Hardhat](https://hardhat.org) - Ethereum development environment
- [OpenZeppelin](https://openzeppelin.com) - Smart contract library

---

**Made with ❤️ by the Employee-Bee Team**

*Revolutionizing employment records with blockchain technology.*