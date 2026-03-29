--TEST--
PAM extension is loaded and functions are available
--EXTENSIONS--
pam
--FILE--
<?php
// Check extension is loaded
var_dump(extension_loaded('pam'));

// Check functions exist
var_dump(function_exists('pam_auth'));
var_dump(function_exists('pam_chpass'));

// Check function signature via reflection
$auth = new ReflectionFunction('pam_auth');
echo "pam_auth parameters: " . $auth->getNumberOfParameters() . "\n";
echo "pam_auth required: " . $auth->getNumberOfRequiredParameters() . "\n";

$chpass = new ReflectionFunction('pam_chpass');
echo "pam_chpass parameters: " . $chpass->getNumberOfParameters() . "\n";
echo "pam_chpass required: " . $chpass->getNumberOfRequiredParameters() . "\n";
?>
--EXPECT--
bool(true)
bool(true)
bool(true)
pam_auth parameters: 5
pam_auth required: 2
pam_chpass parameters: 5
pam_chpass required: 3
