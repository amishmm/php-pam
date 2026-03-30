# PAM Extension Tests

This directory contains `.phpt` tests for the PHP PAM extension.

## Prerequisites

Before building and testing the extension, you need:

1. **PHP development files** (usually from `php-dev` or `php8.x-dev` package)
2. **PAM development libraries**:
   ```bash
   sudo apt-get install libpam0g-dev  # Debian/Ubuntu
   sudo yum install pam-devel          # RHEL/CentOS
   ```

## Building the Extension

```bash
cd /path/to/php-pam
phpize
./configure
make
```

## Running Tests

Run all tests:
```bash
php run-tests.php tests/
```

Run a specific test:
```bash
php run-tests.php tests/pam_extension_loaded.phpt
```

Run tests with the built extension (before installation):
```bash
php -d extension=modules/pam.so run-tests.php tests/
```

## Test Files

### Basic Tests
- **pam_extension_loaded.phpt** - Verifies extension loads and functions exist
- **pam_info.phpt** - Checks phpinfo() output for PAM section
- **pam_ini_basic.phpt** - Tests INI settings (pam.servicename, pam.force_servicename)

### Function Tests
- **pam_auth_basic.phpt** - Tests pam_auth() parameter handling
- **pam_chpass_basic.phpt** - Tests pam_chpass() parameter handling

## Test Naming Conventions

Following PHP's test naming conventions:

- `functionname_basic.phpt` - Basic functionality tests
- `functionname_error.phpt` - Error condition tests
- `functionname_variation.phpt` - Edge cases and variations
- `bug12345.phpt` - Regression tests for specific bugs

## Writing New Tests

See https://php.github.io/php-src/miscellaneous/writing-tests.html

Basic template:
```phpt
--TEST--
Description of what this test does
--EXTENSIONS--
pam
--FILE--
<?php
// Your test code here
?>
--EXPECT--
Expected output here
```

Use `--EXPECTF--` for formatted output with placeholders like `%s`, `%d`, `%i`.

## Note on Actual PAM Testing

Most tests here check function signatures and parameter handling rather than actual PAM authentication, since:

1. PAM authentication requires proper system configuration (`/etc/pam.d/php` or similar)
2. Tests may need root privileges to read shadow files
3. CI/CD environments may not have PAM properly configured

For actual authentication tests, you would need:
- A test PAM service configuration
- Test user accounts or mock authentication
- Proper permissions (potentially root)

## PHP 8.5 Compatibility

These tests are designed to work with PHP 8.0+, including PHP 8.5. They use modern syntax:
- Type hints in stub files
- `ArgumentCountError` exceptions (PHP 8.0+)
- Modern reflection API
