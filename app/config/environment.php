<?php

/**
 * Environment Configuration
 * Copy this file to .env and update the values
 */

return [
    // Database Configuration
    'database' => [
        'host' => $_ENV['DB_HOST'] ?? 'localhost',
        'name' => $_ENV['DB_NAME'] ?? 'employee_bee',
        'user' => $_ENV['DB_USER'] ?? 'root',
        'pass' => $_ENV['DB_PASS'] ?? '',
        'port' => $_ENV['DB_PORT'] ?? '3306',
    ],

    // Application Configuration
    'app' => [
        'name' => $_ENV['APP_NAME'] ?? 'Employee-Bee',
        'env' => $_ENV['APP_ENV'] ?? 'development',
        'debug' => $_ENV['APP_DEBUG'] ?? true,
        'url' => $_ENV['APP_URL'] ?? 'http://localhost/Employee-Bee',
        'key' => $_ENV['APP_KEY'] ?? 'your_app_secret_key_here',
    ],

    // Blockchain Configuration
    'blockchain' => [
        'network' => $_ENV['BLOCKCHAIN_NETWORK'] ?? 'localhost',
        'rpc_url' => $_ENV['BLOCKCHAIN_RPC_URL'] ?? 'http://127.0.0.1:8545',
        'private_key' => $_ENV['BLOCKCHAIN_PRIVATE_KEY'] ?? 'your_private_key_here',
        'contract_address' => $_ENV['EMPLOYMENT_RECORD_CONTRACT_ADDRESS'] ?? '',
    ],

    // AI Service Configuration
    'ai' => [
        'enabled' => $_ENV['AI_SERVICE_ENABLED'] ?? true,
        'api_key' => $_ENV['AI_API_KEY'] ?? 'your_ai_api_key_here',
        'service_url' => $_ENV['AI_SERVICE_URL'] ?? 'https://api.openai.com/v1',
    ],

    // Security Configuration
    'security' => [
        'session_secure' => $_ENV['SESSION_SECURE'] ?? false,
        'session_http_only' => $_ENV['SESSION_HTTP_ONLY'] ?? true,
    ],

    // File Upload Configuration
    'upload' => [
        'max_size' => $_ENV['UPLOAD_MAX_SIZE'] ?? 10485760, // 10MB
        'allowed_types' => $_ENV['ALLOWED_FILE_TYPES'] ?? 'jpg,jpeg,png,pdf,doc,docx',
    ],

    // Logging Configuration
    'logging' => [
        'level' => $_ENV['LOG_LEVEL'] ?? 'debug',
        'channel' => $_ENV['LOG_CHANNEL'] ?? 'file',
    ],
]; 