<?php
/**
 * Environment Configuration Helper
 * This script will help you set up your .env file
 */

echo "🔧 Employee Bee Environment Configuration\n";
echo "=========================================\n\n";

// Check if .env exists
if (file_exists('.env')) {
    $envContent = file_get_contents('.env');
    if (empty(trim($envContent))) {
        echo "⚠️  Your .env file is empty. Let's configure it!\n\n";
    } else {
        echo "✅ .env file exists and has content.\n\n";
    }
} else {
    echo "📝 Creating .env file...\n\n";
}

// Get user input
echo "Please provide the following information:\n\n";

// Get blockchain network
echo "1. Blockchain Network:\n";
echo "   Options: sepolia, goerli, mainnet, localhost\n";
echo "   Enter network (default: sepolia): ";
$network = trim(fgets(STDIN)) ?: 'sepolia';

// Get RPC URL
echo "\n2. RPC URL:\n";
echo "   Example: https://sepolia.infura.io/v3/YOUR_PROJECT_ID\n";
echo "   Enter RPC URL: ";
$rpcUrl = trim(fgets(STDIN));

// Get private key
echo "\n3. Private Key (from MetaMask):\n";
echo "   ⚠️  WARNING: Never share your private key!\n";
echo "   Enter private key (starts with 0x): ";
$privateKey = trim(fgets(STDIN));

// Get contract address
echo "\n4. Contract Address:\n";
echo "   From Remix IDE (default: 0xa4ee796134437692Ac0F93F2f813DFfdfA107CE4): ";
$contractAddress = trim(fgets(STDIN)) ?: '0xa4ee796134437692Ac0F93F2f813DFfdfA107CE4';

// Create .env content
$envContent = "# Database Configuration\n";
$envContent .= "DB_HOST=localhost\n";
$envContent .= "DB_NAME=employee_bee_db\n";
$envContent .= "DB_USER=root\n";
$envContent .= "DB_PASS=\n\n";

$envContent .= "# Application Configuration\n";
$envContent .= "APP_NAME=Employee-Bee\n";
$envContent .= "APP_ENV=development\n";
$envContent .= "APP_DEBUG=true\n";
$envContent .= "APP_URL=http://localhost/Employee-Bee\n";
$envContent .= "APP_KEY=your_app_secret_key_here_change_this_in_production\n\n";

$envContent .= "# Blockchain Configuration\n";
$envContent .= "BLOCKCHAIN_NETWORK=$network\n";
$envContent .= "BLOCKCHAIN_RPC_URL=$rpcUrl\n";
$envContent .= "BLOCKCHAIN_PRIVATE_KEY=$privateKey\n";
$envContent .= "EMPLOYMENT_RECORD_CONTRACT_ADDRESS=$contractAddress\n\n";

$envContent .= "# AI Service Configuration\n";
$envContent .= "AI_SERVICE_ENABLED=true\n";
$envContent .= "AI_API_KEY=your_ai_api_key_here\n";
$envContent .= "AI_SERVICE_URL=https://api.openai.com/v1\n\n";

$envContent .= "# Security Configuration\n";
$envContent .= "SESSION_SECURE=false\n";
$envContent .= "SESSION_HTTP_ONLY=true\n\n";

$envContent .= "# File Upload Configuration\n";
$envContent .= "UPLOAD_MAX_SIZE=10485760\n";
$envContent .= "ALLOWED_FILE_TYPES=jpg,jpeg,png,pdf,doc,docx\n\n";

$envContent .= "# Logging Configuration\n";
$envContent .= "LOG_LEVEL=debug\n";
$envContent .= "LOG_CHANNEL=file\n\n";

$envContent .= "# Node.js Bridge Configuration\n";
$envContent .= "BRIDGE_PORT=3001\n";

// Write to .env file
file_put_contents('.env', $envContent);

echo "\n✅ .env file configured successfully!\n\n";

echo "📋 Configuration Summary:\n";
echo "========================\n";
echo "Network: $network\n";
echo "RPC URL: $rpcUrl\n";
echo "Contract Address: $contractAddress\n";
echo "Private Key: " . substr($privateKey, 0, 10) . "...\n\n";

echo "🚀 Next Steps:\n";
echo "==============\n";
echo "1. Install Node.js dependencies:\n";
echo "   cd blockchain/bridge\n";
echo "   npm install\n\n";

echo "2. Start the bridge service:\n";
echo "   cd blockchain/bridge\n";
echo "   npm start\n\n";

echo "3. Create database tables:\n";
echo "   mysql -u your_username -p your_database < database/blockchain_transactions.sql\n\n";

echo "4. Test the integration:\n";
echo "   Visit: http://localhost/Employee-Bee/public/?path=test/blockchain_test\n\n";

echo "🎉 Your blockchain integration is ready!\n";
?> 