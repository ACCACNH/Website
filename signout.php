<?php
include 'header.php';
session_destroy();
session_unset();
unset($_SESSION["signed_in"]);
$_SESSION = array();
echo 'You have successfully logged out <a href="index.php"> home</a>.';
include 'footer.php';
?>