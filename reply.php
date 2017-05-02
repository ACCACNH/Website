<?php
require_once('class.forum.php');
$forum = new forum();
include 'header.php';
$forum->reply(); 
include 'footer.php';
?>