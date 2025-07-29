# 🔗 Employee-Bee Blockchain Setup Guide

This guide walks you through setting up the blockchain infrastructure for the Employee-Bee platform, which uses Ethereum smart contracts to store immutable employment records.

## 📋 Prerequisites

- Node.js (v14+ recommended)
- npm or yarn package manager
- Git
- Basic understanding of Ethereum and smart contracts

## 🛠️ Development Environment Setup

### 1. Install Dependencies

Navigate to the blockchain directory and install dependencies:

```bash
cd blockchain/bridge
npm install
```

### 2. Install Blockchain Development Tools

Install essential blockchain development tools globally:

```bash
# Install Hardhat (Ethereum development environment)
npm install -g hardhat

# Install Ganache CLI (local blockchain for testing)
npm install -g ganache-cli

# Optional: Install Truffle Suite
npm install -g truffle
```

### 3. Set Up Local Blockchain Network

#### Option A: Using Ganache CLI (Recommended for development)

Start a local blockchain with deterministic accounts:

```bash
ganache-cli --deterministic --accounts 10 --host 0.0.0.0 --port 8545
```

This will:
- Create 10 test accounts with 100 ETH each
- Run on `http://127.0.0.1:8545`
- Use deterministic addresses for consistent testing

#### Option B: Using Hardhat Network

```bash
cd blockchain
npx hardhat node
```

### 4. Configure Environment Variables

Update your `.env` file with blockchain configuration:

```env
# Blockchain Configuration
BLOCKCHAIN_NETWORK=localhost
BLOCKCHAIN_RPC_URL=http://127.0.0.1:8545
BLOCKCHAIN_PRIVATE_KEY=0x4f3edf983ac636a65a842ce7c78d9aa706d3b113bce9c46f30d7d21715b23b1d
EMPLOYMENT_RECORD_CONTRACT_ADDRESS=
```

**Important**: The private key above is from Ganache's first deterministic account. **NEVER use this in production!**

## 📄 Smart Contract Deployment

### 1. Compile Contracts

```bash
cd blockchain
npx hardhat compile
```

### 2. Deploy to Local Network

```bash
npx hardhat run scripts/deploy.js --network localhost
```

### 3. Update Contract Address

After deployment, update your `.env` file with the deployed contract address:

```env
EMPLOYMENT_RECORD_CONTRACT_ADDRESS=0x...deployed_address_here
```

## 🔧 Smart Contract Functions

The `EmploymentRecord.sol` contract provides these key functions:

### Core Functions

- `addEmploymentRecord()` - Store new employment record
- `updateEmploymentRecord()` - Modify existing record
- `getEmploymentRecord()` - Retrieve record by employee ID
- `verifyEmployment()` - Validate employment status
- `transferEmployment()` - Transfer employee between companies

### Access Control

- Only authorized companies can add/update records
- Employees can view their own records
- Public verification of employment status

## 🌐 Network Configurations

### Local Development
```javascript
// hardhat.config.js
networks: {
  localhost: {
    url: "http://127.0.0.1:8545",
    chainId: 1337
  }
}
```

### Testnet (Sepolia)
```javascript
sepolia: {
  url: "https://sepolia.infura.io/v3/YOUR_INFURA_KEY",
  accounts: ["YOUR_PRIVATE_KEY"],
  chainId: 11155111
}
```

### Mainnet (Production)
```javascript
mainnet: {
  url: "https://mainnet.infura.io/v3/YOUR_INFURA_KEY",
  accounts: ["YOUR_PRIVATE_KEY"],
  chainId: 1
}
```

## 🚀 Bridge Server Setup

The bridge server connects your PHP backend to the blockchain:

### 1. Configure Bridge Server

```bash
cd blockchain/bridge
cp package.json.example package.json
npm install
```

### 2. Start Bridge Server

```bash
node server.js
```

The bridge server will run on `http://localhost:3001` by default.

### 3. PHP Integration

The `BlockchainService.php` communicates with the bridge server:

```php
// Example usage
$blockchainService = new BlockchainService();
$result = $blockchainService->addEmploymentRecord($employeeData);
```

## 🔒 Security Best Practices

### 1. Private Key Management

- **Never** commit private keys to version control
- Use environment variables for sensitive data
- Consider using hardware wallets for production
- Implement multi-signature wallets for company accounts

### 2. Smart Contract Security

- Audit contracts before mainnet deployment
- Use established libraries (OpenZeppelin)
- Implement proper access controls
- Test extensively on testnets

### 3. Gas Optimization

- Optimize contract functions for gas efficiency
- Use events for off-chain data storage
- Implement batch operations where possible

## 🧪 Testing

### 1. Run Smart Contract Tests

```bash
cd blockchain
npx hardhat test
```

### 2. Test Bridge Integration

```bash
cd blockchain/bridge
npm test
```

### 3. End-to-End Testing

Test the complete flow from PHP backend through bridge to blockchain:

```bash
# Start local blockchain
ganache-cli --deterministic

# Deploy contracts
npx hardhat run scripts/deploy.js --network localhost

# Start bridge server
cd bridge && node server.js

# Run PHP tests
php resources/views/test/blockchain_test.php
```

## 🐛 Troubleshooting

### Common Issues

1. **Connection Refused**
   - Ensure Ganache/Hardhat node is running
   - Check RPC URL in configuration

2. **Gas Estimation Errors**
   - Increase gas limit in transactions
   - Check account has sufficient ETH

3. **Contract Not Deployed**
   - Verify deployment was successful
   - Check contract address in `.env`

4. **Bridge Server Issues**
   - Check Node.js version compatibility
   - Ensure all dependencies are installed

### Debug Mode

Enable detailed logging by setting:

```env
LOG_LEVEL=debug
```

## 📚 Additional Resources

- [Hardhat Documentation](https://hardhat.org/docs)
- [Ethereum Development Guide](https://ethereum.org/developers)
- [OpenZeppelin Contracts](https://openzeppelin.com/contracts)
- [Web3.js Documentation](https://web3js.readthedocs.io)

## 🆘 Support

For blockchain-specific issues:

1. Check the troubleshooting section above
2. Review contract events and logs
3. Test on local network first
4. Consult Ethereum community resources

---

**Note**: This setup is for development purposes. Production deployment requires additional security measures, gas optimization, and thorough testing.