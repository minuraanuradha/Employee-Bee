
const path = require('path');
require('dotenv').config({ path: path.join(__dirname, '../../.env') });
const express = require('express');
const { Web3 } = require('web3');
const cors = require('cors');
const fs = require('fs');

const app = express();
const PORT = process.env.PORT || 3001;

// Middleware
app.use(cors());
app.use(express.json());

// Load configuration
const config = {
    rpcUrl: process.env.BLOCKCHAIN_RPC_URL || 'http://127.0.0.1:8545',
    contractAddress: process.env.EMPLOYMENT_RECORD_CONTRACT_ADDRESS || '',
    privateKey: process.env.BLOCKCHAIN_PRIVATE_KEY || '',
    abiPath: path.join(__dirname, '../abis/EmploymentRecord.json')
};

// Debug: Log configuration (remove sensitive data)
console.log('Configuration loaded:');
console.log('RPC URL:', config.rpcUrl);
console.log('Contract Address:', config.contractAddress ? config.contractAddress.substring(0, 10) + '...' : 'Not set');
console.log('Private Key:', config.privateKey ? config.privateKey.substring(0, 10) + '...' : 'Not set');

// Initialize Web3
let web3;
let contract;

try {
    web3 = new Web3(config.rpcUrl);
    
    // Load contract ABI
    const abi = JSON.parse(fs.readFileSync(config.abiPath, 'utf8'));
    
    if (config.contractAddress) {
        contract = new web3.eth.Contract(abi, config.contractAddress);
    }
    
    console.log('Web3 initialized successfully');
} catch (error) {
    console.error('Failed to initialize Web3:', error);
}

// Health check endpoint
app.get('/health', (req, res) => {
    res.json({
        status: 'ok',
        web3Connected: !!web3,
        contractLoaded: !!contract,
        network: config.rpcUrl
    });
});

// Log all incoming requests to /blockchain for debugging
app.use('/blockchain', (req, res, next) => {
    console.log('Incoming /blockchain request:', JSON.stringify(req.body, null, 2));
    next();
});

// Blockchain interaction endpoint
app.post('/blockchain', async (req, res) => {
    try {
        const { method, params } = req.body;
        console.log('Method:', method);
        console.log('Params:', params);
        
        if (!web3 || !contract) {
            return res.status(500).json({
                success: false,
                error: 'Blockchain not initialized'
            });
        }
        
        let result;
        
        switch (method) {
            case 'addEmploymentRecord':
                result = await addEmploymentRecord(params);
                break;
                
            case 'updateEmploymentRecord':
                result = await updateEmploymentRecord(params);
                break;
                
            case 'exitEmploymentRecord':
                result = await exitEmploymentRecord(params);
                break;
                
            case 'getEmployeeRecords':
                result = await getEmployeeRecords(params);
                break;
                
            default:
                return res.status(400).json({
                    success: false,
                    error: 'Unknown method'
                });
        }
        
        res.json(result);
        
    } catch (error) {
        console.error('Blockchain operation error:', error);
        res.status(500).json({
            success: false,
            error: error.message,
            stack: error.stack
        });
    }
});

// Catch-all for unhandled promise rejections
process.on('unhandledRejection', (reason, promise) => {
    console.error('Unhandled Rejection at:', promise, 'reason:', reason);
});

function toStringIfBigInt(val) {
    return typeof val === 'bigint' ? val.toString() : val;
}

// Add employment record
async function addEmploymentRecord(params) {
    const { employeeId, companyId, roleTitle, skillsOnHire, startDate } = params;
    
    // Convert companyId and startDate to string to avoid Web3 validation errors
    const companyIdStr = companyId.toString();
    const startDateStr = startDate.toString();

    const data = contract.methods.addEmploymentRecord(
        employeeId,
        companyIdStr,
        roleTitle,
        skillsOnHire,
        startDateStr
    ).encodeABI();
    
    const account = web3.eth.accounts.privateKeyToAccount(config.privateKey);
    const gasEstimate = await contract.methods.addEmploymentRecord(
        employeeId,
        companyIdStr,
        roleTitle,
        skillsOnHire,
        startDateStr
    ).estimateGas({ from: account.address });

    // EIP-1559 gas fields
    const latestBlock = await web3.eth.getBlock('latest');
    const baseFee = latestBlock.baseFeePerGas ? BigInt(latestBlock.baseFeePerGas) : 0n;
    const maxPriorityFeePerGas = 2_000_000_000n; // 2 Gwei
    const maxFeePerGas = baseFee + maxPriorityFeePerGas * 2n;

    const transaction = {
        from: account.address,
        to: config.contractAddress,
        data: data,
        gas: Math.floor(Number(gasEstimate) * 1.2),
        maxPriorityFeePerGas: maxPriorityFeePerGas.toString(),
        maxFeePerGas: maxFeePerGas.toString()
    };
    
    const signedTx = await web3.eth.accounts.signTransaction(transaction, config.privateKey);
    const receipt = await web3.eth.sendSignedTransaction(signedTx.rawTransaction);
    
    return bigIntToString({
        success: true,
        transaction_hash: receipt.transactionHash,
        block_number: receipt.blockNumber,
        gas_used: receipt.gasUsed
    });
}

// Update employment record
async function updateEmploymentRecord(params) {
    const { employeeId, recordIndex, newRoleTitle, newSkillsOnHire, newStatus, feedbackText } = params;
    const data = contract.methods.updateEmploymentRecord(
        employeeId,
        recordIndex,
        newRoleTitle,
        newSkillsOnHire,
        newStatus,
        feedbackText
    ).encodeABI();
    const account = web3.eth.accounts.privateKeyToAccount(config.privateKey);
    const gasEstimate = await contract.methods.updateEmploymentRecord(
        employeeId,
        recordIndex,
        newRoleTitle,
        newSkillsOnHire,
        newStatus,
        feedbackText
    ).estimateGas({ from: account.address });
    const gasEstimateNum = Number(gasEstimate);
    // EIP-1559 gas fields
    const latestBlock = await web3.eth.getBlock('latest');
    const baseFee = latestBlock.baseFeePerGas ? BigInt(latestBlock.baseFeePerGas) : 0n;
    const maxPriorityFeePerGas = 2_000_000_000n; // 2 Gwei
    const maxFeePerGas = baseFee + maxPriorityFeePerGas * 2n;
    const transaction = {
        from: account.address,
        to: config.contractAddress,
        data: data,
        gas: Math.floor(gasEstimateNum * 1.2),
        maxPriorityFeePerGas: maxPriorityFeePerGas.toString(),
        maxFeePerGas: maxFeePerGas.toString()
    };
    const signedTx = await web3.eth.accounts.signTransaction(transaction, config.privateKey);
    const receipt = await web3.eth.sendSignedTransaction(signedTx.rawTransaction);
    return {
        success: true,
        transaction_hash: receipt.transactionHash,
        block_number: toStringIfBigInt(receipt.blockNumber),
        gas_used: toStringIfBigInt(receipt.gasUsed)
    };
}

// Exit employment record
async function exitEmploymentRecord(params) {
    const { employeeId, recordIndex, endDate, newStatus, feedbackText, newSkills } = params;
    const data = contract.methods.exitEmploymentRecord(
        employeeId,
        recordIndex,
        endDate,
        newStatus,
        feedbackText,
        newSkills
    ).encodeABI();
    const account = web3.eth.accounts.privateKeyToAccount(config.privateKey);
    const gasEstimate = await contract.methods.exitEmploymentRecord(
        employeeId,
        recordIndex,
        endDate,
        newStatus,
        feedbackText,
        newSkills
    ).estimateGas({ from: account.address });
    const gasEstimateNum = Number(gasEstimate);
    // EIP-1559 gas fields
    const latestBlock = await web3.eth.getBlock('latest');
    const baseFee = latestBlock.baseFeePerGas ? BigInt(latestBlock.baseFeePerGas) : 0n;
    const maxPriorityFeePerGas = 2_000_000_000n; // 2 Gwei
    const maxFeePerGas = baseFee + maxPriorityFeePerGas * 2n;
    const transaction = {
        from: account.address,
        to: config.contractAddress,
        data: data,
        gas: Math.floor(gasEstimateNum * 1.2),
        maxPriorityFeePerGas: maxPriorityFeePerGas.toString(),
        maxFeePerGas: maxFeePerGas.toString()
    };
    const signedTx = await web3.eth.accounts.signTransaction(transaction, config.privateKey);
    const receipt = await web3.eth.sendSignedTransaction(signedTx.rawTransaction);
    return {
        success: true,
        transaction_hash: receipt.transactionHash,
        block_number: toStringIfBigInt(receipt.blockNumber),
        gas_used: toStringIfBigInt(receipt.gasUsed)
    };
}

// Get employee records (read-only)
async function getEmployeeRecords(params) {
    const { employeeId } = params;
    
    const records = await contract.methods.getEmployeeRecords(employeeId).call();
    // Convert all BigInt values to strings for JSON serialization
    const recordsSafe = bigIntToString(records);
    return {
        success: true,
        data: recordsSafe,
        count: recordsSafe.length
    };
}

function bigIntToString(obj) {
    if (typeof obj === 'bigint') return obj.toString();
    if (Array.isArray(obj)) return obj.map(bigIntToString);
    if (obj && typeof obj === 'object') {
        return Object.fromEntries(
            Object.entries(obj).map(([k, v]) => [k, bigIntToString(v)])
        );
    }
    return obj;
}

// Start server
app.listen(PORT, () => {
    console.log(`Blockchain bridge server running on port ${PORT}`);
    console.log(`RPC URL: ${config.rpcUrl}`);
    console.log(`Contract Address: ${config.contractAddress || 'Not set'}`);
}); 