--TEST--
pam_chpass() function signature and parameter handling
--EXTENSIONS--
pam
--FILE--
<?php
// Test that function requires at least 3 parameters
try {
    pam_chpass();
} catch (ArgumentCountError $e) {
    echo "No args: " . $e->getMessage() . "\n";
}

try {
    pam_chpass("user", "oldpass");
} catch (ArgumentCountError $e) {
    echo "Two args: " . $e->getMessage() . "\n";
}

// Test with minimum parameters (will fail, but that's okay for this test)
$result = pam_chpass("testuser", "oldpass", "newpass");
echo "With 3 args: " . var_export($result, true) . "\n";

// Test with status parameter
$status = null;
$result = pam_chpass("testuser", "oldpass", "newpass", $status);
echo "With status: " . var_export($result, true) . "\n";
echo "Status type: " . gettype($status) . "\n";

// Test with all parameters
$status = null;
$result = pam_chpass("testuser", "oldpass", "newpass", $status, "custom-service");
echo "With all args: " . var_export($result, true) . "\n";
?>
--EXPECT--
No args: pam_chpass() expects at least 3 arguments, 0 given
Two args: pam_chpass() expects at least 3 arguments, 2 given
With 3 args: false
With status: false
Status type: string
With all args: false
