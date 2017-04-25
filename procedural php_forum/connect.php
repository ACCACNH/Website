<?php
//connect.php
session_start();
$server = 'localhost';
$username   = 'root';
$password   = '';
$database   = 'php_forum';
$link=mysqli_connect($server, $username,  $password, $database);
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

?>