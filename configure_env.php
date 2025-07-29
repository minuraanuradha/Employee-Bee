<?php
/**
 * Employee-Bee Environment Configuration Script
 * 
 * This script helps set up the development environment by:
 * - Creating .env file from template if it doesn't exist
 * - Creating necessary directories
 * - Setting appropriate permissions
 * - Validating the setup
 */

echo "🐝 Employee-Bee Environment Setup\n";
echo "================================\n\n";

$projectRoot = __DIR__;
$envFile = $projectRoot . '/.env';
$envTemplate = $projectRoot . '/env_template.txt';

// Check if .env already exists
if (file_exists($envFile)) {
    echo "✅ .env file already exists\n";
    $size = filesize($envFile);
    if ($size === 0) {
        echo "⚠️  Warning: .env file is empty. Consider copying from env_template.txt\n";
    }
} else {
    // Copy template to .env
    if (file_exists($envTemplate)) {
        if (copy($envTemplate, $envFile)) {
            echo "✅ Created .env file from template\n";
        } else {
            echo "❌ Failed to create .env file\n";
            exit(1);
        }
    } else {
        echo "❌ env_template.txt not found\n";
        exit(1);
    }
}

// Create necessary directories
$directories = [
    'storage/logs',
    'storage/uploads/company',
    'storage/uploads/employee',
    'storage/uploads/employee/resumes',
    'database/backups',
    'database/seeds'
];

echo "\nCreating directories...\n";
foreach ($directories as $dir) {
    $fullPath = $projectRoot . '/' . $dir;
    if (!file_exists($fullPath)) {
        if (mkdir($fullPath, 0755, true)) {
            echo "✅ Created directory: $dir\n";
        } else {
            echo "❌ Failed to create directory: $dir\n";
        }
    } else {
        echo "✅ Directory exists: $dir\n";
    }
}

// Set permissions (Unix/Linux systems only)
if (PHP_OS_FAMILY !== 'Windows') {
    echo "\nSetting permissions...\n";
    $writableDirectories = ['storage', 'storage/logs', 'storage/uploads'];
    foreach ($writableDirectories as $dir) {
        $fullPath = $projectRoot . '/' . $dir;
        if (file_exists($fullPath)) {
            if (chmod($fullPath, 0755)) {
                echo "✅ Set permissions for: $dir\n";
            } else {
                echo "⚠️  Could not set permissions for: $dir\n";
            }
        }
    }
}

// Validate setup
echo "\nValidating setup...\n";

// Check PHP version
$phpVersion = PHP_VERSION;
echo "PHP Version: $phpVersion\n";
if (version_compare($phpVersion, '7.4.0', '<')) {
    echo "⚠️  Warning: PHP 7.4+ recommended\n";
} else {
    echo "✅ PHP version OK\n";
}

// Check required PHP extensions
$requiredExtensions = ['pdo', 'pdo_mysql', 'json', 'mbstring', 'openssl', 'curl'];
$missingExtensions = [];

foreach ($requiredExtensions as $extension) {
    if (!extension_loaded($extension)) {
        $missingExtensions[] = $extension;
    }
}

if (empty($missingExtensions)) {
    echo "✅ All required PHP extensions are loaded\n";
} else {
    echo "❌ Missing PHP extensions: " . implode(', ', $missingExtensions) . "\n";
    echo "   Please install these extensions to run the application\n";
}

// Check .env configuration
echo "\nEnvironment Configuration:\n";
if (file_exists($envFile)) {
    $envContent = file_get_contents($envFile);
    $hasDbConfig = strpos($envContent, 'DB_HOST') !== false;
    $hasAppKey = strpos($envContent, 'APP_KEY=your_app_secret_key') === false;
    
    if ($hasDbConfig) {
        echo "✅ Database configuration found\n";
    } else {
        echo "❌ Database configuration missing\n";
    }
    
    if ($hasAppKey) {
        echo "✅ Application key configured\n";
    } else {
        echo "⚠️  Warning: Change APP_KEY from default value\n";
    }
}

echo "\n🎉 Setup complete!\n";
echo "\nNext steps:\n";
echo "1. Update .env file with your database credentials\n";
echo "2. Create the database: employee_bee_db\n";
echo "3. Import database/employee_bee_db.sql\n";
echo "4. Configure your web server to point to the public/ directory\n";
echo "5. Set up blockchain environment (see BLOCKCHAIN_SETUP.md)\n";

?>