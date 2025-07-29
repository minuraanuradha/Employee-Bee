# 🔗 Blockchain Integration Setup Guide

This guide will help you set up and connect your blockchain with the Employee Bee application.

## 📋 Prerequisites

1. **Node.js** (v16 or higher)
2. **PHP** (v7.4 or higher)
3. **MySQL** database
4. **Blockchain Network** (Ethereum testnet or local network)

## 🚀 Quick Setup

### Step 1: Install Node.js Dependencies

```bash
cd blockchain/bridge
npm install
```

### Step 2: Set Up Environment Variables

Create a `.env` file in your project root:

```env
# Blockchain Configuration
BLOCKCHAIN_NETWORK=sepolia
BLOCKCHAIN_RPC_URL=https://sepolia.infura.io/v3/YOUR_INFURA_PROJECT_ID
BLOCKCHAIN_PRIVATE_KEY=your_private_key_here
EMPLOYMENT_RECORD_CONTRACT_ADDRESS=your_deployed_contract_address

# Node.js Bridge Configuration
BRIDGE_PORT=3001
```

### Step 3: Deploy Smart Contract

1. **Compile the contract:**
   ```bash
   cd blockchain
   npx hardhat compile
   ```

2. **Deploy to network:**
   ```bash
   npx hardhat run scripts/deploy.js --network sepolia
   ```

3. **Update contract address** in your `.env` file

### Step 4: Start the Bridge Service

```bash
cd blockchain/bridge
npm start
```

### Step 5: Create Database Tables

Run the SQL script:
```bash
mysql -u your_username -p your_database < database/blockchain_transactions.sql
```

### Step 6: Test the Integration

Visit: `http://your-domain/Employee-Bee/public/?path=test/blockchain_test`

## 🔧 Configuration Options

### Blockchain Networks

| Network | RPC URL | Explorer |
|---------|---------|----------|
| **Local** | `http://127.0.0.1:8545` | `http://localhost:8545` |
| **Sepolia** | `https://sepolia.infura.io/v3/YOUR_ID` | `https://sepolia.etherscan.io` |
| **Goerli** | `https://goerli.infura.io/v3/YOUR_ID` | `https://goerli.etherscan.io` |
| **Mainnet** | `https://mainnet.infura.io/v3/YOUR_ID` | `https://etherscan.io` |

### Environment Variables

| Variable | Description | Example |
|----------|-------------|---------|
| `BLOCKCHAIN_NETWORK` | Network name | `sepolia` |
| `BLOCKCHAIN_RPC_URL` | RPC endpoint | `https://sepolia.infura.io/v3/...` |
| `BLOCKCHAIN_PRIVATE_KEY` | Private key for transactions | `0x1234...` |
| `EMPLOYMENT_RECORD_CONTRACT_ADDRESS` | Deployed contract address | `0xabcd...` |

## 🧪 Testing

### 1. Connection Test
```php
$blockchainController = new BlockchainController();
$result = $blockchainController->testConnection();
```

### 2. Hire Employee
```php
$result = $blockchainController->hireEmployee(
    'EMP_001',
    'COMP_001', 
    'Software Developer',
    'PHP,JavaScript,MySQL',
    time()
);
```

### 3. Update Employee
```php
$result = $blockchainController->updateEmploymentRecord(
    'EMP_001',
    0,
    'Senior Developer',
    'PHP,JavaScript,MySQL,React',
    'promoted',
    'Excellent performance'
);
```

### 4. Get Records
```php
$result = $blockchainController->getEmployeeRecords('EMP_001');
```

## 🔍 Troubleshooting

### Common Issues

1. **Bridge service not starting**
   - Check if port 3001 is available
   - Verify Node.js installation
   - Check console for error messages

2. **Blockchain connection failed**
   - Verify RPC URL is correct
   - Check network connectivity
   - Ensure Infura project is active

3. **Contract not deployed**
   - Verify private key has enough ETH for gas
   - Check deployment script
   - Verify contract address in .env

4. **Database errors**
   - Run the SQL script again
   - Check database permissions
   - Verify table structure

### Debug Mode

Enable debug logging in `app/config/environment.php`:
```php
'logging' => [
    'level' => 'debug',
    'channel' => 'file',
],
```

## 📊 Monitoring

### Transaction History
View all blockchain transactions:
```php
$history = $blockchainController->getTransactionHistory();
```

### Contract Information
Get contract details:
```php
$info = $blockchainController->getContractInfo();
```

## 🔐 Security Considerations

1. **Private Key Security**
   - Never commit private keys to version control
   - Use environment variables
   - Consider using a hardware wallet for production

2. **Network Security**
   - Use HTTPS for RPC endpoints
   - Implement rate limiting
   - Monitor for suspicious activity

3. **Data Validation**
   - Validate all inputs before blockchain operations
   - Implement proper error handling
   - Log all transactions

## 🚀 Production Deployment

1. **Use a production blockchain network**
2. **Set up proper monitoring and logging**
3. **Implement backup and recovery procedures**
4. **Use a managed blockchain service (Infura, Alchemy)**
5. **Set up automated testing**

## 📞 Support

If you encounter issues:

1. Check the troubleshooting section above
2. Review the test page at `/test/blockchain_test`
3. Check the application logs
4. Verify all configuration settings

## 🔄 Updates

To update the blockchain integration:

1. Pull the latest code
2. Update dependencies: `npm install`
3. Restart the bridge service
4. Test the integration
5. Update documentation if needed 