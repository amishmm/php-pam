--TEST--
PAM INI settings have correct defaults
--EXTENSIONS--
pam
--FILE--
<?php
// Check default INI values
$servicename = ini_get('pam.servicename');
$force = ini_get('pam.force_servicename');

echo "pam.servicename: " . var_export($servicename, true) . "\n";
echo "pam.force_servicename: " . var_export($force, true) . "\n";

// Verify they can be changed at runtime
ini_set('pam.servicename', 'test-service');
ini_set('pam.force_servicename', '1');

echo "After ini_set:\n";
echo "pam.servicename: " . var_export(ini_get('pam.servicename'), true) . "\n";
echo "pam.force_servicename: " . var_export(ini_get('pam.force_servicename'), true) . "\n";
?>
--EXPECT--
pam.servicename: 'php'
pam.force_servicename: '0'
After ini_set:
pam.servicename: 'test-service'
pam.force_servicename: '1'
