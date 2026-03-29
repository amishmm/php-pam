--TEST--
PAM extension info is displayed
--EXTENSIONS--
pam
--FILE--
<?php
ob_start();
phpinfo(INFO_MODULES);
$info = ob_get_clean();

// Check that PAM section exists
if (preg_match('/PAM support\s*=>\s*enabled/i', $info)) {
    echo "PAM support: enabled\n";
}

// Check for version
if (preg_match('/Extension version\s*=>\s*([\d.]+)/i', $info, $matches)) {
    echo "Extension version found: " . $matches[1] . "\n";
}

// Check for INI settings
if (preg_match('/pam\.servicename/i', $info)) {
    echo "INI setting pam.servicename exists\n";
}

if (preg_match('/pam\.force_servicename/i', $info)) {
    echo "INI setting pam.force_servicename exists\n";
}
?>
--EXPECTF--
PAM support: enabled
Extension version found: %s
INI setting pam.servicename exists
INI setting pam.force_servicename exists
