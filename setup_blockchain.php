<?php
/**
 * Blockchain Setup Script
 * Run this script to configure your blockchain integration
 */

echo "🔗 Employee Bee Blockchain Setup\n";
echo "================================\n\n";

// Check if .env file exists
if (!file_exists('.env')) {
    echo "📝 Creating .env file...\n";
    
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
    $envContent .= "APP_KEY=your_app_secret_key_here\n\n";
    
    $envContent .= "# Blockchain Configuration\n";
    $envContent .= "BLOCKCHAIN_NETWORK=sepolia\n";
    $envContent .= "BLOCKCHAIN_RPC_URL=https://sepolia.infura.io/v3/YOUR_INFURA_PROJECT_ID\n";
    $envContent .= "BLOCKCHAIN_PRIVATE_KEY=your_private_key_here\n";
    $envContent .= "EMPLOYMENT_RECORD_CONTRACT_ADDRESS=your_deployed_contract_address_here\n\n";
    
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
    
    file_put_contents('.env', $envContent);
    echo "✅ .env file created successfully!\n\n";
} else {
    echo "✅ .env file already exists\n\n";
}

echo "📋 Next Steps:\n";
echo "==============\n\n";

echo "1. 🔧 Configure your .env file:\n";
echo "   - Open .env file in your project root\n";
echo "   - Update these blockchain settings:\n";
echo "     * BLOCKCHAIN_NETWORK (sepolia, goerli, mainnet, or localhost)\n";
echo "     * BLOCKCHAIN_RPC_URL (your Infura/Alchemy endpoint)\n";
echo "     * BLOCKCHAIN_PRIVATE_KEY (your wallet private key)\n";
echo "     * EMPLOYMENT_RECORD_CONTRACT_ADDRESS (from Remix IDE)\n\n";

echo "2. 📄 Update your ABI file:\n";
echo "   - Go to Remix IDE → Compilation tab → Compilation Details → ABI\n";
echo "   - Copy the entire ABI\n";
echo "   - Replace the content in blockchain/abis/EmploymentRecord.json\n\n";

echo "3. 🚀 Install Node.js dependencies:\n";
echo "   cd blockchain/bridge\n";
echo "   npm install\n\n";

echo "4. 🔌 Start the bridge service:\n";
echo "   cd blockchain/bridge\n";
echo "   npm start\n\n";

echo "5. 🗄️ Create database tables:\n";
echo "   mysql -u your_username -p your_database < database/blockchain_transactions.sql\n\n";

echo "6. 🧪 Test the integration:\n";
echo "   Visit: http://your-domain/Employee-Bee/public/?path=test/blockchain_test\n\n";

echo "📚 For detailed instructions, see: BLOCKCHAIN_SETUP.md\n\n";

echo "❓ Need help? Check the troubleshooting section in BLOCKCHAIN_SETUP.md\n";
?> 