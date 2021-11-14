<?php
$password = 'ladonnaemobile lara la LAAA lalaaaaa';
echo "Password: " . $password . "<br>";

if (CRYPT_STD_DES == 1) {
    echo 'Standard DES: ' . crypt($password, 'dl') . "\n";
    echo "<br>";
}
if (CRYPT_EXT_DES == 1) {
    echo 'Standard DES: ' . crypt($password, '_H9..escr') . "\n";
    echo "<br>";
}
if (CRYPT_MD5 == 1) {
    echo 'MD5:          ' . crypt($password, '$1
$escribeloquequieras$') . "\n";
    echo "<br>";
}
if (CRYPT_BLOWFISH == 1) {
    echo 'Blowfish:     ' . crypt($password, '$2a$07
$escribeloquequieras$') . "\n";
    echo "<br>";
}
if (CRYPT_SHA256 == 1) {
    echo 'SHA-256:      ' . crypt($password, '$5
$rounds=5000$escribeloquequieras$') . "\n";
    echo "<br>";
}
if (CRYPT_SHA512 == 1) {
    echo 'SHA-512:      ' . crypt($password, '$6
$rounds=5000$escribeloquequieras$') . "\n";
    echo "<br>";
}