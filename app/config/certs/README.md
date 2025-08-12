# SSL Certificate Bundle

If you encounter SSL certificate problems when calling the Hugging Face API from localhost, you have two options:

## Option 1: Download cacert.pem (Recommended for Production)

1. Download the cacert.pem file from https://curl.se/docs/caextract.html
2. Place it in this directory (app/config/certs/)
3. Update app/config/environment.php to point to the file:
   ```php
   'ca_cert' => __DIR__ . '/certs/cacert.pem',
   ```

## Option 2: Disable SSL Verification (Development Only)

For development purposes, SSL verification can be disabled by setting:
```php
'ca_cert' => '', // Disabled for development
```

**Warning**: Never disable SSL verification in production environments as it makes your application vulnerable to man-in-the-middle attacks.

## Current Status

SSL verification is currently disabled for development. To enable it:
1. Download cacert.pem and place it in this directory
2. Update the ca_cert path in app/config/environment.php