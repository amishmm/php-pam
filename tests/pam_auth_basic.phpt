--TEST--
pam_auth() function signature and parameter handling
--EXTENSIONS--
pam
--FILE--
<?php
// Test that function requires at least 2 parameters
try {
    pam_auth();
} catch (ArgumentCountError $e) {
    echo "No args: " . $e->getMessage() . "\n";
}

try {
    pam_auth("user");
} catch (ArgumentCountError $e) {
    echo "One arg: " . $e->getMessage() . "\n";
}

// Test with minimum parameters (will fail auth, but that's okay for this test)
$result = pam_auth("testuser", "testpass");
echo "With 2 args: " . var_export($result, true) . "\n";

// Test with status parameter
$status = null;
$result = pam_auth("testuser", "testpass", $status);
echo "With status: " . var_export($result, true) . "\n";
echo "Status type: " . gettype($status) . "\n";

// Test with all parameters
$status = null;
$result = pam_auth("testuser", "testpass", $status, false, "custom-service");
echo "With all args: " . var_export($result, true) . "\n";
?>
--EXPECT--
No args: pam_auth() expects at least 2 arguments, 0 given
One arg: pam_auth() expects at least 2 arguments, 1 given
With 2 args: false
With status: false
Status type: string
With all args: false
